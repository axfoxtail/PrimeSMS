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
    <title>{{ $general->title }} | Verification</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    @if(Auth::user()->status == 1)
    <div class="login-box">
        @if(session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session()->get('success') }}
            </div>
        @elseif(session()->has('alert'))
            <div class="alert alert-danger text-center">
                {{ session()->get('alert') }}
            </div>
        @endif
            <form class="login-form" action="@if(Auth::user()->two_step_verification == 0) {{ route('user.chk2step') }} @else {{route('user.auth')}} @endif" method="post">
                @csrf
                <h3 class="login-head">@if(Auth::user()->two_step_verification == 0) <i class="fa fa-lg fa-fw fa-google-plus-circle"></i>Google two factor verification @else <i class="fa fa-lg fa-fw fa-check"></i>Verify your Acount @endif </h3>
                @if (session()->has('error'))
                    <strong style="color: #96000e">{{ session()->get('error') }}</strong>
                @endif
                <div class="form-group">
                    <label class="control-label">Verification Code</label>
                    <input class="form-control " type="text" name="code" autofocus required>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-check-circle fa-lg fa-fw"></i>Verify</button>
                    @if(Auth::user()->two_step_verification == 1)
                    <a href="#" onclick="event.preventDefault(); document.getElementById('re-auth').submit();">Resend verification code</a>
                        @endif
                </div>
            </form>
            <form action="{{route('user.reauth')}}" method="post" id="re-auth">
                @csrf
            </form>
    </div>
    @else
        <h2 class="text-center" style="color: #c0392b; margin-top: 90px;">Your account has been deactivated.</h2>
        <h4 class="text-center">Contact with Administrator.</h4>
    @endif
</section>
@include('admin.layouts.scripts')
</body>
</html>