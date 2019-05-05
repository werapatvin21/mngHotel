@extends('layouts.app')
@section('content')

{{--    <link rel="icon" type="image/png" href="{{asset("images/icons/favicon.ico")}}"/>--}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
{{--    <div class="container">
        <div class="row justify-content-center">
            <div class="card-group">
                --}}{{--<div class="card">--}}{{--
                    --}}{{--<img class="img-t" src="">--}}{{--
                --}}{{--</div>--}}{{--

                <div class="card">
                    <div class="card-body">


                        <h3><b>
                                <center><span style="color:#FFFFFF;">{{env("APP_NAME")?:'HotelCloud'}}</span></center>
                            </b></h3>
                        <form method="POST" action="{{ route('login') }}" style="margin-top: 33px">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user-alt"></i></span>
                                        </div>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-key"></i></span>
                                        </div>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                                    </div>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2" style=" text-align: -webkit-center;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember" style="color:#FFFFFF;">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="col">
                                    <center>
                                        <button type="submit" class="btn  btn-default px4 pull-right btn-block" style="width: 250px">
                                            {{ __('Login') }}
                                        </button>
                                        <br>
                                        <a href="/register">
                                            <button type="button" class="btn  btn-primary px4 pull-right btn-block" style="width: 250px"
                                                    style="">
                                                Register
                                            </button>
                                        </a>
                                    </center>


                                </div>
                            </div>
                            <br>

                            <br>
                         --}}{{--   <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2" style="text-align: -webkit-center;">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#FFFFFF;">
                                            {{ __('Forgot Your Password ?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>--}}{{--
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{asset('img/S__35119107.jpg')}}" alt="IMG">
                </div>
                    <form class="login100-form validate-form" method="POST" action="{{ route('login') }}" style="margin-top: 33px">
                        @csrf
					<span class="login100-form-title">
						Hotel Cloud
					</span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>


                    <div class="text-center p-t-136">
                        <a class="txt2" href="/register">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

@endpush
