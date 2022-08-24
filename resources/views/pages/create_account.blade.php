@extends('layouts.base')

@section('content')
@push('stylesheet')
<style>
    .error {
        color: red !important;
    }
</style>
@endpush
    @include('layouts.header', ['header_name' => 'Logistics Service'])
    <main id="main" class="main-site left-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                    <div class=" main-content-area">
                        <div class="wrap-login-item " style="margin: 30px 0px !important;">
                            <div class="register-form form-item ">
                                <form class="form-stl" action="{{ route('register') }}" name="registerForm" id="registerForm"
                                    method="POST">
                                    @csrf
                                    <fieldset class="wrap-title">
                                        <h3 class="form-title">Create an account</h3>
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-reg-lname">Name<span style="color: red;">*</span></label>
                                        <input type="text" id="frm-reg-lname" name="name" value="{{ old('name') }}"
                                            placeholder="Your Name..." autocomplete="name" autofocus>
                                        @error('name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-reg-email">Email Address<span style="color: red;">*</span></label>
                                        <input type="email" id="frm-reg-email" name="email" value="{{ old('email') }}"
                                            placeholder="Email address">
                                        @error('email')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-reg-email">Mobile Number<span style="color: red;">*</span></label>
                                        <input type="text" id="frm-reg-email" name="mobile" value="{{ old('mobile') }}"
                                            placeholder="Mobile Number">
                                        @error('mobile')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="wrap-input item-width-in-half left-item ">
                                        <label for="frm-reg-pass">Password <span style="color: red;">*</span></label>
                                        <input type="password" id="frm-reg-pass" name="password" placeholder="Password"
                                            autocomplete="new-password">
                                        @error('password')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="wrap-input item-width-in-half ">
                                        <label for="frm-reg-cfpass">Confirm Password <span
                                                style="color: red;">*</span></label>
                                        <input type="password" id="frm-reg-cfpass" name="password_confirmation"
                                            placeholder="Confirm Password" autocomplete="new-password">
                                        @error('password_confirmation')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </fieldset>
                                    <input type="submit" class="btn btn-sign" value="Register" name="register">

                                    <a class="link-function left-position" href="{{ route('index') }}"
                                        title="Already Have Account?" style="margin-top: 30px;">Already Have Account?</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            $().ready(function() {

                jQuery.validator.addMethod("emailExt", function(value, element, param) {
                    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
                }, "please enter valid email format");

                $.validator.addMethod('numericOnly', function(value) {
                    return /^[0-9]+$/.test(value);
                }, "Please only enter numeric values (0-9)");

                $.validator.addMethod("strong_password", function(value, element) {
                    let password = value;
                    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,20}$)/.test(password))) {
                        return false;
                    }
                    return true;
                }, function(value, element) {
                    let password = $(element).val();
                    if (!(/^(.{8,20}$)/.test(password))) {
                        return "Password must be between 8 to 20 characters long.";
                    } else if (!(/^(?=.*[A-Z])/.test(password))) {
                        return "Password must contain at least one uppercase.";
                    } else if (!(/^(?=.*[a-z])/.test(password))) {
                        return "Password must contain at least one lowercase.";
                    } else if (!(/^(?=.*[0-9])/.test(password))) {
                        return "Password must contain at least one digit.";
                    } else if (!(/^(?=.*[@#$%&])/.test(password))) {
                        return "{Password must contain special characters from @#$%&";
                    }
                    return false;
                });

                $('#registerForm').validate({
                    rules: {
                        // first_name: {
                        //     required: true
                        // },
                        // last_name: {
                        //     required: true
                        // },
                        name: {
                            required: true
                        },
                        email: {
                            required: true,
                            emailExt: true
                        },
                        phone_number: {
                            required: true,
                            numericOnly: true
                        },
                        password: {
                            required: true,
                            minlength: 8,
                            strong_password: true

                        },
                        password_confirmation: {
                            required: true,
                            minlength: 8,
                            equalTo: "#password"
                        },
                    },
                    messages: {
                        // first_name: {
                        //     required: "{{ __('jq_validation.first_name') }}",
                        // },
                        // last_name: {
                        //     required: "{{ __('jq_validation.last_name') }}",
                        // },
                        name: {
                            required: "Please enter name",
                        },
                        email: {
                            required: "Please enter email",
                        },
                        phone_number: {
                            required: "Please enter phone number",
                        },
                        password: {
                            required: "Please enter password",
                            minlength: "Please enter min 8 character",
                        },
                        password_confirmation: {
                            required: "Please enter password confirmation",
                            minlength: "Please enter min 8 character",
                            equalTo: "Password does not match",
                        },

                    },
                    submitHandler: function(form) {
                        form.submit();
                    }

                    // any other options and/or rules
                });
            });
        </script>
    @endpush
@endsection
