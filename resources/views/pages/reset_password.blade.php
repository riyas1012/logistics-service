@extends('layouts.base')

@section('content')
    @include('layouts.header', ['header_name' => 'Logistics Service'])
    <main id="main" class="main-site left-sidebar">
        <div class="container">
            <main id="main" class="main-site left-sidebar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                            <div class=" main-content-area">
                                <div class="wrap-login-item " style="margin: 30px 0px !important;">
                                    <div class="login-form form-item form-stl">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul style="text-align: left;">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if (session()->has('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif
                                        <form name="resetPasswordForm" method="POST"
                                            action="{{ route('reset.password.update', ['reset_token' => $token]) }}">
                                            @csrf
                                            <fieldset class="wrap-title">
                                                <h3 class="form-title">Reset Password</h3>
                                            </fieldset>
                                            <fieldset class="wrap-input">
                                                <label for="frm-login-uname">Email Address:</label>
                                                <input type="email" id="frm-login-uname" name="email"
                                                    placeholder="Type your email address" value="{{ $email }}"
                                                    required disabled>
                                            </fieldset>
                                            <fieldset class="wrap-input item-width-in-half left-item ">
                                                <label for="password">Password *</label>
                                                <input type="password" id="password" name="password" placeholder="Password"
                                                    autocomplete="new-password">
                                            </fieldset>
                                            <fieldset class="wrap-input item-width-in-half ">
                                                <label for="password_confirmation">Confirm Password *</label>
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Confirm Password"
                                                    autocomplete="new-password">
                                            </fieldset>
                                            <input type="submit" class="btn btn-submit" value="Reset Password"
                                                name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </main>

    @push('scripts')
        <script>
            $().ready(function() {

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

                $('#resetPasswordForm').validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 8,
                            strong_password: true

                        },
                        password_confirmation: {
                            required: true,
                            minlength: 8,
                            equalTo: "#password"
                        }

                    },
                    messages: {
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
