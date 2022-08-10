@extends('layouts.base')

@section('content')
    @push('stylesheet')
        <style>
            .wrap-login-item .form-item input[type="text"] {
                width: 15% !important;
            }
        </style>
    @endpush
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
                                        <form method="post" action='{{route('otp.verification')}}' class="digit-group text-center form-submit"
                                            data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                            @csrf
                                            <div class="form-heading text-center">
                                                <div class="title">OTP</div>
                                            </div>
                                            <p>Enter the code generated on email below to log in!</p>
                                            <fieldset class="wrap-input">
                                                <input type="text" id="digit1" name="digit1" data-next="digit2" />
                                                <input type="text" id="digit2" name="digit2" data-next="digit3"
                                                    data-previous="digit1" />
                                                <input type="text" id="digit3" name="digit3" data-next="digit4"
                                                    data-previous="digit2" />
                                                <input type="text" id="digit4" name="digit4" data-next="digit5"
                                                    data-previous="digit3" />
                                                <input type="text" id="digit5" name="digit5" data-next="digit6"
                                                    data-previous="digit4" />
                                                <input type="text" id="digit6" name="digit6"
                                                    data-previous="digit5" />
                                            </fieldset>
                                            <div class="row">
                                                <div class="col-md-12" id="verify-div">
                                                    <button type="submit" class="btn btn-primary mt-4 button-submit"
                                                        id="otpCodeBtn">
                                                        Verify
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md text-center pt-4">
                                                <a href="{{ route('otp.resend') }}">Resend OTP?</a>
                                            </div>
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
            $('.digit-group').find('input').each(function() {
                $(this).attr('maxlength', 1);
                $(this).on('keyup', function(e) {
                    var parent = $($(this).parent());

                    if (e.keyCode === 8 || e.keyCode === 37) {
                        var prev = parent.find('input#' + $(this).data('previous'));

                        if (prev.length) {
                            $(prev).select();
                        }
                    } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <=
                            90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                        var next = parent.find('input#' + $(this).data('next'));

                        if (next.length) {
                            $(next).select();
                        } else {
                            if (parent.data('autosubmit')) {
                                parent.submit();
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
