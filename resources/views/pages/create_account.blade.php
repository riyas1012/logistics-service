@extends('layouts.base')

@section('content')
    @include('layouts.header', ['header_name' => 'Logistics Service'])
    <main id="main" class="main-site left-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                    <div class=" main-content-area">
                        <div class="wrap-login-item " style="margin: 30px 0px !important;">
                            <div class="register-form form-item ">
                                <form class="form-stl" action="{{route('register')}}" name="frm-login" method="POST">
                                    @csrf
                                    <fieldset class="wrap-title">
                                        <h3 class="form-title">Create an account</h3>
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-reg-lname">Name<span style="color: red;">*</span></label>
                                        <input type="text" id="frm-reg-lname" name="name" value="{{old('name')}}"
                                            placeholder="Your Name..." autocomplete="name" autofocus>
                                            @error('name')
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-reg-email">Email Address<span style="color: red;">*</span></label>
                                        <input type="email" id="frm-reg-email" name="email" value="{{old('email')}}"
                                            placeholder="Email address" >
                                            @error('email')
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-reg-email">Mobile Number<span style="color: red;">*</span></label>
                                        <input type="text" id="frm-reg-email" name="mobile" value="{{old('mobile')}}"
                                            placeholder="Mobile Number" >
                                            @error('mobile')
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                    </fieldset>
                                    <fieldset class="wrap-input item-width-in-half left-item ">
                                        <label for="frm-reg-pass">Password <span style="color: red;">*</span></label>
                                        <input type="password" id="frm-reg-pass" name="password" placeholder="Password" autocomplete="new-password">
                                        @error('password')
                                            <p class="text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="wrap-input item-width-in-half ">
                                        <label for="frm-reg-cfpass">Confirm Password <span style="color: red;">*</span></label>
                                        <input type="password" id="frm-reg-cfpass" name="password_confirmation"
                                            placeholder="Confirm Password" autocomplete="new-password">
                                            @error('password_confirmation')
                                                <p class="text-danger">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                    </fieldset>
                                        <input type="submit" class="btn btn-sign" value="Register" name="register">

                                        <a class="link-function left-position" href="{{route('index')}}"
                                            title="Already Have Account?" style="margin-top: 30px;">Already Have Account?</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
