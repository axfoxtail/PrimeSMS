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
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/user/upload/logo/icon.png') }}">
    <link href="{{ asset('assets/user/css/color.php?color=') }}{{ $general->base_color }}" rel="stylesheet">
    <script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
    <title>{{ $general->title }} | User Login</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
            <img class="img-responsive" src="{{ asset('assets/user/upload/logo/logo.png') }}" style="max-width: 200px; max-height: 60px">
    </div>
    <div class="login-box" style="min-height: 450px !important;">
        @if (session()->has('success'))
            <script type="text/javascript">
                $(document).ready(function(){
                    $.notify({
                        title: "Success!",
                        message: "{{ session()->get('success') }}"
                    },{
                        type: 'info'
                    });
                });
            </script>
        @endif

        @if (session()->has('alert'))
            <script type="text/javascript">
                $(document).ready(function(){
                    $.notify({
                        title: "Sorry!",
                        message: "{{ session()->get('alert') }}"
                    },{
                        type: 'danger'
                    });
                });
            </script>
        @endif
        <form class="login-form" action="{{ route('login') }}" method="post">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            @if(session()->has('error'))
                <strong style="color: #96000e">{{ session()->get('error') }}</strong>
            @endif
            <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" type="text"
                       name="username" value="{{ old('username') }}" placeholder="Username" autofocus required>
                @if ($errors->has('username'))
                    <strong style="color: #bf5329">{{ $errors->first('username') }}</strong>
                @endif

            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                       name="password" placeholder="Password" required>
                @if ($errors->has('Password'))
                    <strong style="color: #bf5329">{{ $errors->first('Password') }}</strong>
                @endif
            </div>
            @if($general->recaptcha == 1)
            <div class="g-recaptcha" data-sitekey="{{ $general->site_key }}" style="margin-left: -16px;"></div>
            @endif
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" style="margin-top: 10px"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <p class="semibold-text mb-2"><a href="{{ route('password.request') }}" data-toggle="flip">Forgot password ?</a></p>
                    </div>
                    <p class="semibold-text mb-2"><a href="{{ route('register') }}" data-toggle="flip">Need an account?</a></p>
                </div>
            </div>
        </form>
    </div>
</section>
@include('admin.layouts.scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>

