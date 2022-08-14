<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AccountActivateMail;
use App\Mail\OtpMail;
use App\Mail\ResetPasswordEMail;
use App\Models\OnVenueAssistance;
use App\Models\PasswordReset;
use App\Models\TransportationOfGoods;
use App\Models\User;
use App\Models\UserServiceRequest;
use App\Models\WarehouseStorage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        $accountActivationKey = $this->generateRandomKey(24);
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->mobile = $request->get('mobile');
        $user->password = Hash::make($request->get('password'));
        $user->activation_code = $accountActivationKey;
        $user->save();
        $url = url('account-verification', [$accountActivationKey]);
        $details = array(
            'name' => $user->name,
            'email' => $user->email,
            'url' => $url,
        );
        Mail::to($user->email)->send(new AccountActivateMail($details));
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
                if($user->is_activated == 1){
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
                }
                else{
                    return array('status' => false, 'message' => 'Account is not Activated.');
                }
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

    public function getUniqueId()
    {
        $uniqueId = $this->generateRandomKey(12);
        if (UserServiceRequest::where('unique_id', $uniqueId)->count() == 0) {
            return $uniqueId;
        } else {
            return $this->getUniqueId();
        }
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

    public function otpVerification(Request $request)
    {

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
        $otpDigitCombine = $request->get('digit1') . $request->get('digit2') . $request->get('digit3') . $request->get('digit4') . $request->get('digit5') . $request->get('digit6');
        $user = User::where('id', $request->attributes->get('user_id'))->where('otp', $otpDigitCombine)->first();
        if (!$user) {
            return array('status' => false, 'message' => 'Please enter valid OTP.');
        }
        return array('status' => true);
    }

    public function warehouseStorages(Request $request)
    {
        $rules = array(
            'description_of_material' => 'required',
            'storage_type_id' => 'required',
            'quantity_of_items' => 'required',
            'goods_preparation_type_id' => 'required',
            'no_of_packaged_goods' => 'required',
            'packaging_specifications' => 'required',
            'weight_of_goods' => 'required',
            'storage_start_date' => 'required|date',
            'storage_end_date' => 'required|date',
            'any_dangerous' => 'required',
            'dissolution_plan_place' => 'required',
            'special_handling_requirements' => 'required',
            'transport_to_deliver' => 'required',
            'venues_distribution' => 'required',
        );

        if ($request->get('any_dangerous') == 'Yes') {
            $rules['dangerous_details'] = 'required';
        }
        if ($request->get('dissolution_plan_place') == 'Yes') {
            $rules['dissolution_plan_details'] = 'required';
        }
        if ($request->get('special_handling_requirements') == 'Yes') {
            $rules['special_handling_details'] = 'required';
        }
        if ($request->get('transport_to_deliver') == 'Yes') {
            $rules['transport_to_deliver_details'] = 'required';
        }
        if ($request->get('transport_to_deliver') == 'No') {
            $rules['date_of_collection'] = 'required|date';
            $rules['location_of_collection'] = 'required';
            $rules['collection_contact_person'] = 'required|integer';
        }
        if ($request->get('venues_distribution') == 'Yes') {
            $rules['venues_distribution_date'] = 'required|date';
            $rules['venues_distribution_place'] = 'required';
            $rules['venues_distribution_contact'] = 'required|integer';
        }

        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return array('status' => false, 'message' => $validator, 'error_code' => '100');
        }

        DB::beginTransaction();
        try {
            $uniqueId = $this->getUniqueId();
            $userServiceRequest = new UserServiceRequest();
            $userServiceRequest->user_id = $request->attributes->get('user_id');
            $userServiceRequest->unique_id = $uniqueId;
            $userServiceRequest->service_id = $request->get('service');
            $userServiceRequest->name = $request->get('name');
            $userServiceRequest->email = $request->get('email');
            $userServiceRequest->mobile = $request->get('mobile');
            $userServiceRequest->project_functional_area = $request->get('project_functional_area');
            $userServiceRequest->job_title = $request->get('job_title');
            $userServiceRequest->save();

            $warehouseStorage = new WarehouseStorage();
            $warehouseStorage->user_id = $request->attributes->get('user_id');
            $warehouseStorage->user_service_request_id = $userServiceRequest->id;
            $warehouseStorage->description_of_materials = $request->get('description_of_materials');
            $warehouseStorage->storage_type_id = $request->get('storage_type_id');
            $warehouseStorage->quantity_of_items = $request->get('quantity_of_items');
            $warehouseStorage->goods_preparation_type_id = $request->get('goods_preparation_type_id');
            $warehouseStorage->no_of_packaged_goods = $request->get('no_of_packaged_goods');
            $warehouseStorage->packaging_specifications = $request->get('packaging_specifications');
            $warehouseStorage->weight_of_goods = $request->get('weight_of_goods');
            $warehouseStorage->storage_start_date = $request->get('storage_start_date');
            $warehouseStorage->storage_end_date = $request->get('storage_end_date');
            $warehouseStorage->any_dangerous = $request->get('any_dangerous');
            $warehouseStorage->dangerous_details = $request->get('dangerous_details');
            $warehouseStorage->dissolution_plan_place = $request->get('dissolution_plan_place');
            $warehouseStorage->dissolution_plan_details = $request->get('dissolution_plan_details');
            $warehouseStorage->special_handling_requirements = $request->get('special_handling_requirements');
            $warehouseStorage->special_handling_details = $request->get('special_handling_details');
            $warehouseStorage->transport_to_deliver = $request->get('transport_to_deliver');
            $warehouseStorage->transport_to_deliver_details = $request->get('transport_to_deliver_details');
            $warehouseStorage->date_of_collection = $request->get('date_of_collection');
            $warehouseStorage->location_of_collection = $request->get('location_of_collection');
            $warehouseStorage->collection_contact_person = $request->get('collection_contact_person');
            $warehouseStorage->venues_distribution = $request->get('venues_distribution');
            $warehouseStorage->venues_distribution_date = $request->get('venues_distribution_date');
            $warehouseStorage->venues_distribution_place = $request->get('venues_distribution_place');
            $warehouseStorage->venues_distribution_contact = $request->get('venues_distribution_contact');
            $warehouseStorage->save();

            DB::commit();
            return array('status' => true);
        } catch (Exception $e) {
            Log::info("error:" . json_encode($e->getMessage()));
            DB::rollBack();
            return array('status' => false, 'message' => 'something went wrong!!');
        }
    }

    public function transportationOfGoods(Request $request)
    {
        $rules = array(
            'transport_description_of_materials' => 'required',
            'transport_goods_preparation_type_id' => 'required',
            'transport_no_of_packaged_goods' => 'required',
            'transport_packaging_specifications' => 'required',
            'transport_weight_of_goods' => 'required',
            'transport_collection_dttm' => 'required|date',
            'transport_collection_location' => 'required',
            'transport_collection_contact_name' => 'required',
            'transport_collection_contact_number' => 'required',
            'transport_delivery_dttm' => 'required|date',
            'transport_delivery_location' => 'required',
            'transport_delivery_contact_name' => 'required',
            'transport_delivery_contact_number' => 'required',
            'transport_any_dangerous' => 'required',
            'transport_special_handling_requirements' => 'required',
        );

        if ($request->get('transport_any_dangerous') == 'Yes') {
            $rules['transport_dangerous_details'] = 'required';
        }
        if ($request->get('transport_special_handling_requirements') == 'Yes') {
            $rules['transport_special_handling_details'] = 'required';
        }

        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return array('status' => false, 'message' => $validator, 'error_code' => '100');
        }
        DB::beginTransaction();
        try {
            $uniqueId = $this->getUniqueId();
            $userServiceRequest = new UserServiceRequest();
            $userServiceRequest->user_id = $request->attributes->get('user_id');
            $userServiceRequest->unique_id = $uniqueId;
            $userServiceRequest->service_id = $request->get('service');
            $userServiceRequest->name = $request->get('name');
            $userServiceRequest->email = $request->get('email');
            $userServiceRequest->mobile = $request->get('mobile');
            $userServiceRequest->project_functional_area = $request->get('project_functional_area');
            $userServiceRequest->job_title = $request->get('job_title');
            $userServiceRequest->save();

            $transportationOfGoods = new TransportationOfGoods();
            $transportationOfGoods->user_id = $request->attributes->get('user_id');
            $transportationOfGoods->user_service_request_id = $userServiceRequest->id;
            $transportationOfGoods->description_of_materials = $request->get('transport_description_of_materials');
            $transportationOfGoods->goods_preparation_type_id = $request->get('transport_goods_preparation_type_id');
            $transportationOfGoods->no_of_packaged_goods = $request->get('transport_no_of_packaged_goods');
            $transportationOfGoods->packaging_specifications = $request->get('transport_packaging_specifications');
            $transportationOfGoods->weight_of_goods = $request->get('transport_weight_of_goods');
            $transportationOfGoods->collection_dttm = $request->get('transport_collection_dttm');
            $transportationOfGoods->collection_location = $request->get('transport_collection_location');
            $transportationOfGoods->collection_contact_name = $request->get('transport_collection_contact_name');
            $transportationOfGoods->collection_contact_number = $request->get('transport_collection_contact_number');
            $transportationOfGoods->delivery_dttm = $request->get('transport_delivery_dttm');
            $transportationOfGoods->delivery_location = $request->get('transport_delivery_location');
            $transportationOfGoods->delivery_contact_name = $request->get('transport_delivery_contact_name');
            $transportationOfGoods->delivery_contact_number = $request->get('transport_delivery_contact_number');
            $transportationOfGoods->any_dangerous = $request->get('transport_any_dangerous');
            $transportationOfGoods->dangerous_details = $request->get('transport_dangerous_details');
            $transportationOfGoods->special_handling_requirements = $request->get('transport_special_handling_requirements');
            $transportationOfGoods->special_handling_details = $request->get('transport_special_handling_details');
            $transportationOfGoods->save();

            DB::commit();
            return array('status' => true);
        } catch (Exception $e) {
            Log::info("error:" . json_encode($e->getMessage()));
            DB::rollBack();
            return array('status' => false, 'message' => 'something went wrong!!');
        }
    }

    public function onVenueAssitance(Request $request)
    {
        $rules = array(
            'crew_assistance' => 'required',
            'material_handling_equipment' => 'required',
            'logistics_assistance_venue' => 'required',
            'short_breif_activity' => 'required',
            'location' => 'required',
            'ova_contact_name' => 'required',
            'ova_contact_number' => 'required',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date',
            'end_time' => 'required',
        );

        if ($request->get('crew_assistance') == 'Yes') {
            $rules['crew_quantity'] = 'required_without:supervisor_quantity|integer';
            $rules['supervisor_quantity'] = 'required_without:crew_quantity|integer';
        }
        if ($request->get('material_handling_equipment') == 'Yes') {
            $rules['forklift_quantity'] = 'required_without:pallet_jack_quantity,trolley_quantity|integer';
            $rules['pallet_jack_quantity'] = 'required_without:forklift_quantity,trolley_quantity|integer';
            $rules['trolley_quantity'] = 'required_without:forklift_quantity,pallet_jack_quantity|integer';
        }
        if ($request->get('logistics_assistance_venue') == 'Yes') {
            $rules['logistics_assistance_venue_details'] = 'required';
        }

        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return array('status' => false, 'message' => $validator, 'error_code' => '100');
        }

        DB::beginTransaction();
        try {
            $uniqueId = $this->getUniqueId();
            $userServiceRequest = new UserServiceRequest();
            $userServiceRequest->user_id = $request->attributes->get('user_id');
            $userServiceRequest->unique_id = $uniqueId;
            $userServiceRequest->service_id = $request->get('service');
            $userServiceRequest->name = $request->get('name');
            $userServiceRequest->email = $request->get('email');
            $userServiceRequest->mobile = $request->get('mobile');
            $userServiceRequest->project_functional_area = $request->get('project_functional_area');
            $userServiceRequest->job_title = $request->get('job_title');
            $userServiceRequest->save();

            $onVenueAssistance = new OnVenueAssistance();
            $onVenueAssistance->user_id = $request->attributes->get('user_id');
            $onVenueAssistance->user_service_request_id = $userServiceRequest->id;
            $onVenueAssistance->crew_assistance = $request->get('crew_assistance');
            $onVenueAssistance->crew_quantity = $request->get('crew_quantity');
            $onVenueAssistance->supervisor_quantity = $request->get('supervisor_quantity');
            $onVenueAssistance->material_handling_equipment = $request->get('material_handling_equipment');
            $onVenueAssistance->forklift_quantity = $request->get('forklift_quantity');
            $onVenueAssistance->pallet_jack_quantity = $request->get('pallet_jack_quantity');
            $onVenueAssistance->trolley_quantity = $request->get('trolley_quantity');
            $onVenueAssistance->logistics_assistance_venue = $request->get('logistics_assistance_venue');
            $onVenueAssistance->logistics_assistance_venue_details = $request->get('logistics_assistance_venue_details');
            $onVenueAssistance->short_breif_activity = $request->get('short_breif_activity');
            $onVenueAssistance->location = $request->get('location');
            $onVenueAssistance->contact_name = $request->get('ova_contact_name');
            $onVenueAssistance->contact_number = $request->get('ova_contact_number');
            $onVenueAssistance->start_date = $request->get('start_date');
            $onVenueAssistance->start_time = $request->get('start_time');
            $onVenueAssistance->end_date = $request->get('end_date');
            $onVenueAssistance->end_time = $request->get('end_time');
            $onVenueAssistance->save();

            DB::commit();
            return array('status' => true);
        } catch (Exception $e) {
            Log::info("error:" . json_encode($e->getMessage()));
            DB::rollBack();
            return array('status' => false, 'message' => 'something went wrong!!');
        }
    }

    public function getServiceRequest(Request $request)
    {
        return UserServiceRequest::where('user_id', $request->attributes->get('user_id'))->get();
    }

    public function accountVerification(Request $request,$activationKey){
        $user = User::where('activation_code',$activationKey)->first();
        if (!$user) {
            return array('status' => false, 'message' => 'Invalid verification code');
        }

        if($user->is_activated == 1){
            return array('status' => false, 'message' => 'Account is already Activated');
        }

        User::where('id',$user->id)->update(array(
            'is_activated' => 1
        ));

        return array('status'=>true);
    }
}
