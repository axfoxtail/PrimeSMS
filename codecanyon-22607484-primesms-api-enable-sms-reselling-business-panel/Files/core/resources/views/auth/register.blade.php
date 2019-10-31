<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('assets/user/css/color.php?color=') }}{{ $general->base_color }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/user/upload/logo/icon.png') }}">
    <title>{{ $general->title }} | Register</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <img class="img-responsive" src="{{ asset('assets/user/upload/logo/logo.png') }}"
             style="max-width: 200px; max-height: 60px">
    </div>
    <div class="login-box" style="min-width: 450px;min-height: 600px !important;">
        <form class="login-form" action="{{ route('register') }}" method="post">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user-plus"></i>Register</h3>
            @if (session()->has('error'))
                <strong style="color: #96000e">{{ session()->get('error') }}</strong>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label">Name</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name"
                               value="{{ old('name') }}" placeholder="Name">
                        @if ($errors->has('name'))
                            <strong style="color: #bf5329">{{ $errors->first('name') }}</strong>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" form-group>
                        <label class="label">Username</label>
                        <input type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                               name="username"
                               value="{{ old('username') }}" placeholder="Username">
                        @if ($errors->has('username'))
                            <strong style="color: #bf5329">{{ $errors->first('username') }}</strong>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="label">Email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email"
                       value="{{ old('email') }}" placeholder="Email">
                @if ($errors->has('email'))
                    <strong style="color: #bf5329">{{ $errors->first('email') }}</strong>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Mobile Number</label>
                <input type="text" class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                       name="mobile"
                       value="{{ old('mobile') }}" placeholder="Mobile Number">
                @if ($errors->has('mobile'))
                    <strong style="color: #bf5329">{{ $errors->first('mobile') }}</strong>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label">Password</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password"
                               placeholder="Password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label">Confirm Password</label>
                        <input id="password-confirm" class="form-control" type="password" name="password_confirmation"
                               placeholder="Password Confirm"
                               required>
                    </div>
                </div>
                @if ($errors->has('password'))
                    <strong style="color: #bf5329">{{ $errors->first('password') }}</strong>
                @endif
            </div>
            @if($general->recaptcha == 1)
            <div class="g-recaptcha" data-sitekey="{{ $general->site_key }}" style="margin-left: 32px;"></div>
            @endif
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" style="margin-top: 10px"><i
                            class="fa fa-sign-in fa-lg fa-fw"></i>SIGN UP
                </button>
            </div>
            <div class="form-group">
                <p class="semibold-text mb-2 float-right"><a href="{{ route('login') }}" data-toggle="flip">Already have
                        an account?</a></p>
            </div>
        </form>
    </div>
</section>
@include('admin.layouts.scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>


