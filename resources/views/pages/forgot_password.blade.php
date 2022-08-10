@extends('layouts.base')

@section('content')
    @include('layouts.header', ['header_name' => 'Logistics Service'])
    <main id="main" class="main-site left-sidebar">

        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                    <div class=" main-content-area">
                        <div class="wrap-login-item" style="margin: 30px 0px !important;">
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
                                        {{session()->get('success')}}
                                    </div>
                                @endif
                                <form name="frm-login" method="POST" action="{{route('login')}}">
                                    @csrf
                                    <fieldset class="wrap-title">
                                        <h3 class="form-title">Log in to your account</h3>
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-login-uname">Email Address:</label>
                                        <input type="email" id="frm-login-uname" name="email"
                                            placeholder="Type your email address" value="{{ old('email') }}"
                                            autofocus>
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-login-pass">Password:</label>
                                        <input type="password" id="frm-login-pass" name="password"
                                            placeholder="************"  autocomplete="current-password">
                                    </fieldset>

                                    <fieldset class="wrap-input">
                                        <a class="link-function left-position" href="{{route('forgot.password')}}"
                                            title="Forgotten password?">Forgotten password?</a>
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <input type="submit" class="btn btn-submit" value="Login" name="submit">

                                        <a class="btn btn-success" style="float: right;"
                                            href="{{ route('create-account') }}" title="Create Account">Create
                                            Account</a>
                                    </fieldset>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                    <div class=" main-content-area">
                        <div class="wrap-login-item " style="margin: 30px 0px !important;">
                            <div class="login-form form-item form-stl">
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif
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
                                        {{session()->get('success')}}
                                    </div>
                                @endif
                                <form name="frm-login" method="POST" action="{{route('forgot.password.link')}}">
                                    @csrf
                                    <fieldset class="wrap-title">
                                        <h3 class="form-title">Forgot Password</h3>
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="frm-login-uname">Email Address:</label>
                                        <input type="email" id="frm-login-uname" name="email"
                                            placeholder="Type your email address" value="{{old('email')}}" autofocus>
                                    </fieldset>
                                    <input type="submit" class="btn btn-submit" value="Email Password Reset Link" name="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end main products area-->
                </div>
            </div>
        </div>
    </main>
@endsection
