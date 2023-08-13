<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredUserController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['max:255', 'required', 'string'],
            'age' => ['required', 'numeric'],
            'genre' => ['max:255', 'required', 'string'],
            'password' => ['min:8', 'required', 'string'],
            'tel' => ['max:255', 'required', 'string'],
            'email' => ['email', 'required'],
        ]);

        if ($validator->errors()->any()) {
            $text = "";
            foreach ($validator->errors()->all() as $error) {
                $text = $error . "\n";
            }

            Alert::warning('Error', $text);
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->age = $request->age;
            $user->genre = $request->genre;
            $user->password = $request->password;
            $user->tel = $request->tel;
            if ($user->email != $request->email) {
                $user->email = $request->email;
                $user->email_verified_at = null;
            }
            $user->save();
            DB::commit();
            if ($user->email_verified_at == null) {
                $user->sendEmailVerificationNotification();

            }
            Alert::success('Success', "Votre utilisateur a été modifier avec succès !")->persistent("ok");
            return redirect()->back();

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre produit a été rejeter !")->persistent("ok");
            return redirect()->back();
        }
    }
}
