<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        return view('pages.index');
    }

    public function createAccount(Request $request)
    {
        return view('pages.create_account');
    }

    public function register(Request $request)
    {
        $apiUserController = new UserController;
        $registerStatus = $apiUserController->register($request);
        if (!$registerStatus['status']) {
            return back()->withErrors($registerStatus['message'])->withInput();
        }
        session()->flash('success', 'Successfully register.');
        return redirect()->route('index');
    }

    public function login(Request $request)
    {
        $apiUserController = new UserController;
        $loginStatus = $apiUserController->login($request);
        if (!$loginStatus['status']) {
            return back()->withErrors($loginStatus['message'])->withInput();
        }
        $user = $loginStatus['user'];
        session()->put('token', $user->token);
        if (env('OTP_VERIFY')) {
            if (session()->has('otp_verified') && session()->get('otp_verified') == 1) {
                return redirect()->route('request.form');
            } else {
                return redirect()->route('otp');
            }
        } else {
            return redirect()->route('request.form');
        }
    }

    public function logout(Request $request)
    {
        $apiUserController = new UserController;
        $logoutStatus = $apiUserController->logout($request);
        if (!$logoutStatus['status']) {
            return back()->withErrors($logoutStatus['message']);
        }
        session()->forget('token');
        session()->forget('otp_verified');
        return redirect()->route('index');
    }

    public function forgotPassword(Request $request)
    {
        return view('pages.forgot_password');
    }

    public function forgotPasswordLink(Request $request)
    {
        $apiUserController = new UserController;
        $forgotPasswordStatus = $apiUserController->forgotPasswordLink($request);
        if (!$forgotPasswordStatus['status']) {
            return back()->withErrors($forgotPasswordStatus['message'])->withInput();
        }
        return back()->with('success', 'Rest password link is sent to your email');
    }

    public function resetPassword(Request $request, $passwordResetToken)
    {
        $apiUserController = new UserController;
        $resetPasswordStatus = $apiUserController->resetPassword($request, $passwordResetToken);
        if (!$resetPasswordStatus['status']) {
            return redirect('/')->withErrors($resetPasswordStatus['message']);
        }
        return view('pages.reset_password', [
            'email' => $resetPasswordStatus['email'],
            'token' => $passwordResetToken,
        ]);
    }

    public function resetPasswordUpdate(Request $request, $passwordResetToken)
    {
        $apiUserController = new UserController;
        $resetPasswordStatus = $apiUserController->resetPasswordUpdate($request, $passwordResetToken);
        if (!$resetPasswordStatus['status']) {
            return back()->withErrors($resetPasswordStatus['message']);
        }
        return redirect('/')->with('success', 'Password Reset Successfully');
    }

    public function getOtpPage(Request $request)
    {
        if (env('OTP_VERIFY')) {
            if (session()->has('otp_verified') && session()->get('otp_verified') == 1) {
                return redirect()->route('request.form');
            } else {
                return view('pages.otp');
            }
        } else {
            return redirect()->route('request.form');
        }
    }

    public function otpResend(Request $request)
    {
        $apiUserController = new UserController;
        $resetPasswordStatus = $apiUserController->otpResend($request);
        if (!$resetPasswordStatus['status']) {
            return back()->withErrors($resetPasswordStatus['message']);
        }
        return back()->with('success', 'Otp Reset Successfully.');
    }

    public function otpVerification(Request $request)
    {
        $apiUserController = new UserController;
        $otpVarifiedStatus = $apiUserController->otpVerification($request);
        if (!$otpVarifiedStatus['status']) {
            return back()->withErrors($otpVarifiedStatus['message']);
        }
        session()->put('otp_verified', 1);
        return redirect()->route('request.form');
    }
}
