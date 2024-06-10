<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Auth::loginUsingId($user->id);

        event(new Registered($user));
    }

    public function login(LoginRequest $request)
    {
        $user = User::query()
            ->where('email', $request->email)
            ->whereNotNull('email_verified_at')
            ->first();

        if(!empty($user) && Hash::check($request->password, $user->password)) {
            Auth::loginUsingId($user->id, (bool) $request->remember);
            return response()->json([
                'redirect' => route('admin.entry.index')
            ]);
        }

        return response()->json([], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
