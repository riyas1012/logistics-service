<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Models\User;
use App\Models\UserServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function requestForm(Request $request)
    {
        if (env('OTP_VERIFY')) {
            if (!session()->has('otp_verified') && session()->get('otp_verified') != 1) {
                return view('pages.otp');
            }
        }
        return view('pages.request_form', [
            'storage_types' => $this->getStorageTypes(),
            'goods_preparation_types' => $this->getGoodsPreparationTypes(),
        ]);
    }

    public function requestFormCreate(Request $request)
    {
        $rules = array(
            'name'=>'required',
            'mobile'=> 'required|integer',
            'email'=> 'required|email',
            'service' => 'required|in:1,2,3',
        );
        $messages = array(
            'service.in' => 'Please choose valid service',
        );
        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $apiUserController = new ApiUserController;
        if ($request->get('service') == '1') {
            $warehouseStorageStatus = $apiUserController->warehouseStorages($request);
            if (!$warehouseStorageStatus['status']) {
                return back()->withErrors($warehouseStorageStatus['message'])->withInput();
            }
            return redirect()->route('request.form')->with('success','Successfully Added');
        } else if ($request->get('service') == '2') {

        } else if ($request->get('service') == '3') {

        } else {
            return back()->withErrors('Please choose valid service')->withInput();
        }
    }

    public function getServiceRequest(Request $request){
        return view('pages.request_list',[
            'user' => User::find($request->attributes->get('user_id'))
        ]);
    }

    public function getServiceRequestDetails(Request $request,$serviceRequestId){
        return view('pages.request_details',[
            'user_service_request' => UserServiceRequest::where('unique_id',$serviceRequestId)->first(),
            'storage_types' => $this->getStorageTypes(),
            'goods_preparation_types' => $this->getGoodsPreparationTypes(),
        ]);
    }
}
