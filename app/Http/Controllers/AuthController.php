<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordUpdateRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware = ['guest'];
//    }

    public function registerAjax(RegisterRequest $request)
    {

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);
        Auth::login($user);
        return response()->json(['success' => true]);
    }

    public function loginAjax(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['phone', 'password']))) {

            return response()->json(['success' => true]);
        }
        throw ValidationException::withMessages([
            'password' => ['Телефон нөмір немесе құпия сөз қате']
        ]);
    }

    public function resetPassword($token)
    {
        return view('client.auth.password-reset', compact('token'));
    }

    public function resetPasswordUpdate(ResetPasswordUpdateRequest $request)
    {
        $token = $request->token;
        $user = User::where('uuid', $token)->whereNotNull('uuid')->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->uuid = null;
            $user->save();
            Auth::login($user);
            return redirect()->route('index');
        }
        return redirect()->back()->withErrors(['msg' => 'Сілтеме жарамсыз']);
    }

    public function resetPasswordSendEmail(ResetPasswordRequest $request)
    {
        $email = $request->email;

        $user = User::where('email', $email)->firstOr(function () {
            throw ValidationException::withMessages([
                'email' => ['Email табылмады']
            ]);
        });

        $user->uuid = Str::uuid();
        $user->save();

        Mail::to($user->email)->send(new ResetPassword($user->uuid));

        return response()->json(['data' => [
            'status' => true,
        ]]);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
