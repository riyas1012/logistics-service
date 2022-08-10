<header id="header" class="header header-style-1">
    <div class="container-fluid bg-color">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="wrap-logo-top left-section">
                        <a href="{{ route('index') }}" class="link-to-home"><img
                                src="{{asset('assets/images/logo.png')}}" alt="{{env('APP_NAME')}}"></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="application-heading">
                        {{-- Logistics Service Request Form --}}
                        {{ $header_name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
