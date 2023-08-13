<?php


namespace App\Helpers;

use App\Models\Attendance;
use App\Models\Device;
use App\Models\Discipline;
use App\Models\Evaluation;
use App\Models\Exercice;
use App\Models\Observation;
use App\Models\Punishment;
use App\Models\Pupil;
use App\Models\Registration;
use App\Models\Relative;
use App\Models\TimeTable;
use Exception;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Ixudra\Curl\Facades\Curl;

class Helper
{

    public static function passwordValidator($password)
    {

        return (strlen($password) < 4);
    }

    public static function generateApikey()
    {
        return md5(uniqid(rand(), true));
    }

    public static function getSqlWithBindings($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())
            ->map(function ($binding) {
                return is_numeric($binding) ? $binding : "'{$binding}'";
            })->toArray());
    }

    public static function validateRequest(Request $request, $param, $attributeNames = null)
    {
        $validator = Validator::make($request->all(), $param);
        if ($attributeNames != null) {
            $validator->setAttributeNames($attributeNames);
        }
        if ($validator->errors()->any()) {
            $text = "";
            foreach ($validator->errors()->all() as $error) {
                Log::debug($error);
                $text .= $error . "\n ";
            }

            return $text;
        }
        return null;
    }

    public static function throttleKey($request)
    {
        return Str::lower($request->get('email')) . '|' . $request->ip();
    }

    public static function ensureIsNotRateLimited(Request $request)
    {
        if (!RateLimiter::tooManyAttempts(Helper::throttleKey($request), 5)) {
            return null;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn(Helper::throttleKey($request));

        $response["error"] = true;
        $response["message"] = (ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ])->getMessage());
        return $response;
    }
}
