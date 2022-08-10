<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Mail\ResetPasswordEMail;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|integer',
            'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:8',
        );

        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return array('status' => false, 'message' => $validator, 'error_code' => '100');
        }

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->mobile = $request->get('mobile');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return array('status' => true);
    }
    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );

        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return array('status' => false, 'message' => $validator, 'error_code' => '100');
        }

        $user = User::where('email', $request->get('email'))->first();
        if ($user) {
            if (Hash::check($request->get('password'), $user->password)) {
                $user->token = $this->generateRandomKey();
                if (env('OTP_VERIFY')) {
                    $otp = random_int(100000, 999999);
                    $user->otp = $otp;
                    $details = array(
                        'name' => $user->name,
                        'email' => $user->email,
                        'otp_code' => $otp,
                    );
                    Mail::to($user->email)->send(new OtpMail($details));
                }
                $user->save();
                return array('status' => true, 'user' => $user);
            } else {
                return array('status' => false, 'message' => 'Incorrect Password');
            }
        } else {
            return array('status' => false, 'message' => 'Not Registered User. Please Create account');
        }
    }

    public function generateRandomKey($length = 32)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function logout(Request $request)
    {
        $user = User::find($request->attributes->get('user_id'));
        if (!$user) {
            return array('status' => false, 'message' => 'Invalid User details');
        }
        User::where('id', $request->attributes->get('user_id'))->update(array(
            'token' => null,
        ));
        return array('status' => true);
    }

    public function forgotPasswordLink(Request $request)
    {
        $rules = array(
            'email' => 'required',
        );

        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return array('status' => false, 'message' => $validator, 'error_code' => '100');
        }

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return array('status' => false, 'message' => 'Invalid User details');
        }
        $passwordResetUser = PasswordReset::where('email', $user->email)->first();
        if ($passwordResetUser) {
            $token = $passwordResetUser->token;
        } else {
            $token = $this->generateRandomKey(10);
            $passwordResetUser = new PasswordReset();
            $passwordResetUser->email = $user->email;
            $passwordResetUser->token = $token;
            $passwordResetUser->created_at = Carbon::now();
            $passwordResetUser->save();
        }
        $url = url('reset-password', [$token]);
        $details = array(
            'name' => $user->name,
            'email' => $user->email,
            'url' => $url,
        );

        Mail::to($user->email)->send(new ResetPasswordEMail($details));
        return array('status' => true);
    }

    public function resetPassword(Request $request, $passwordResetToken)
    {
        $passwordReset = PasswordReset::where('token', $passwordResetToken)->first();
        if (!$passwordReset) {
            return array('status' => false, 'message' => 'invalid password reset link.');
        }
        return array('status' => true, 'email' => $passwordReset->email);
    }

    public function resetPasswordUpdate(Request $request, $passwordResetToken)
    {
        $rules = array(
            'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:8',
        );

        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return array('status' => false, 'message' => $validator, 'error_code' => '100');
        }
        $passwordReset = PasswordReset::where('token', $passwordResetToken)->first();
        if (!$passwordReset) {
            return array('status' => false, 'message' => 'invalid password reset link.');
        }

        User::where('email', $passwordReset->email)->update(array(
            'password' => Hash::make($request->get('password')),
        ));
        $passwordReset = PasswordReset::where('token', $passwordResetToken)->delete();
        return array('status' => true);
    }

    public function otpResend(Request $request)
    {
        $user = User::find($request->attributes->get('user_id'));
        $otp = random_int(100000, 999999);
        User::where('id', $user->id)->update(array(
            'otp' => $otp,
        ));
        $details = array(
            'name' => $user->name,
            'email' => $user->email,
            'otp_code' => $otp,
        );
        Mail::to($user->email)->send(new OtpMail($details));
        return array('status' => true);
    }

    public function otpVerification(Request $request){

        $rules = array(
            'digit1' => 'required|integer',
            'digit2' => 'required|integer',
            'digit3' => 'required|integer',
            'digit4' => 'required|integer',
            'digit5' => 'required|integer',
            'digit6' => 'required|integer',
        );

        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return array('status' => false, 'message' => $validator, 'error_code' => '100');
        }
        $otpDigitCombine = $request->get('digit1').$request->get('digit2').$request->get('digit3').$request->get('digit4').$request->get('digit5').$request->get('digit6');
        $user = User::where('id',$request->attributes->get('user_id'))->where('otp',$otpDigitCombine)->first();
        if(!$user){
            return array('status' => false, 'message' =>'Please enter valid OTP.');
        }
        return array('status' => true);
    }
}
