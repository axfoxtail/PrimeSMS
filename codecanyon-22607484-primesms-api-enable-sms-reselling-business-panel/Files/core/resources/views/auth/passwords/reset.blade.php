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
    <title>{{ $general->title }} | Reset Password</title>
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
        <form class="login-form" action="{{ route('reset.pass') }}" method="post">
            @csrf
            <input type="hidden" value="{{$reset->token}}" name="token"/>
            <div class="form-group">
                <label class="control-label">Password</label>
                <input id="password" type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       name="password" placeholder="New Password" required>
            </div>
            <div class="form-group">
                <label class="control-label">Confirm Password</label>
                <input id="password-confirm" class="form-control" type="password" name="password_confirmation"
                       placeholder="Confirm Password"
                       required>
                @if ($errors->has('password'))
                    <strong style="color: #bf5329">{{ $errors->first('password') }}</strong>
                @endif
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" style="margin-top: 10px"><i
                            class="fa fa-paper-plane fa-lg fa-fw"></i>Reset
                </button>
            </div>
        </form>
    </div>
</section>
@include('admin.layouts.scripts')
</body>
</html>
