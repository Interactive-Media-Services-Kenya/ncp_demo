<!doctype html>
<html lang="en">

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('auth/css/bootstrap.min.css')}}">

</head>

<body class="img js-fullheight" style="background-image: url({{ asset('backend/assets/images/auth-backend.jpg') }});">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Verify OTP</h2>
                </div>
            </div>
            <p class="text-center text-success">We sent code to your phone :
                {{ substr(auth()->user()->phone, 0, 5) . '*****' . substr(auth()->user()->phone, -2) }}
            </p>

            @if ($message = Session::get('success'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close"
                                data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close"
                                data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">

                        <form action="{{ route('otp.post') }}" class="signin-form" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="code" class="form-label">Code</label>


                                        <input id="code" type="password"
                                            class="form-control @error('code') is-invalid @enderror" name="code"
                                            value="{{ old('code') }}" required autocomplete="code" autofocus>

                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 offset-md-4">
                                    <a class="#" href="{{ route('otp.resend') }}">Resend
                                        Code?</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success submit px-3">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/popper.js') }}"></script>
    <script src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth/js/main.js') }}"></script>

</body>

</html>
