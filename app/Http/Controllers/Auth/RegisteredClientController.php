<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\PetOwner;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rules;

class RegisteredClientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:client_agents'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = PetOwner::create([
            'client_id' => auth()->user()->client_id,
            'name' => $request->name,
            'email' => $request->email,
            'photo' => "blank.png",
            'password' => Hash::make($request->password),
        ]);
        $user->sendEmailVerificationNotification();
        event(new Registered($user));
        return redirect()->back();
    }


}
