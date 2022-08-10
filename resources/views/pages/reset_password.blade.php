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
                                <div class="wrap-login-item "  style="margin: 30px 0px !important;">
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
                                        <form name="frm-login" method="POST" action="{{route('reset.password.update',['reset_token'=>$token])}}">
                                            @csrf
                                            <fieldset class="wrap-title">
                                                <h3 class="form-title">Reset Password</h3>
                                            </fieldset>
                                            <fieldset class="wrap-input">
                                                <label for="frm-login-uname">Email Address:</label>
                                                <input type="email" id="frm-login-uname" name="email"
                                                    placeholder="Type your email address" value="{{ $email }}" required
                                                     disabled>
                                            </fieldset>
                                            <fieldset class="wrap-input item-width-in-half left-item ">
                                                <label for="password">Password *</label>
                                                <input type="password" id="password" name="password" placeholder="Password"
                                                     autocomplete="new-password">
                                            </fieldset>
                                            <fieldset class="wrap-input item-width-in-half ">
                                                <label for="password_confirmation">Confirm Password *</label>
                                                <input type="password" id="password_confirmation" name="password_confirmation"
                                                    placeholder="Confirm Password"  autocomplete="new-password">
                                            </fieldset>
                                            <input type="submit" class="btn btn-submit" value="Reset Password" name="submit">
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
@endsection
