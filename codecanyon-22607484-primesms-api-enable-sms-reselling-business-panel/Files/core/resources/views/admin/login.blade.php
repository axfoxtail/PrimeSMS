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
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/frontend/upload/logo/icon.png') }}">
    <link href="{{ asset('assets/user/css/color.php?color=') }}{{ $general->base_color }}" rel="stylesheet">
    <title>{{ $general->title }} | Admin Login</title>
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
    <div class="login-box">
        <form class="login-form" action="{{ route('admin.login') }}" method="post">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            @if (session()->has('error'))
                    <strong style="color: #96000e">{{ session()->get('error') }}</strong>
            @endif
            <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" type="text"
                       name="username" value="{{ old('username') }}" placeholder="Username" autofocus required>

            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                       name="password" placeholder="Password" required>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
        </form>
    </div>
</section>
@include('admin.layouts.scripts')
<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function () {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>
</body>
</html>

