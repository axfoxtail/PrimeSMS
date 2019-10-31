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
    <script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
    <title>{{ $general->title }} | Reset Password</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <img class="img-responsive" src="{{ asset('assets/user/upload/logo/logo.png') }}" style="max-width: 200px; max-height: 60px">
    </div>
    <div class="login-box">
            <form class="login-form" action="{{ route('forgot.pass') }}" method="post">
                @csrf
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Reset Password</h3>
                @include('user.layouts.flash')
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email"
                                       value="{{ old('email') }}" placeholder="Your Email id">
                                @if ($errors->has('email'))
                                    <strong style="color: #bf5329">{{ $errors->first('email') }}</strong>
                                @endif
                            </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" style="margin-top: 10px"><i class="fa fa-paper-plane fa-lg fa-fw"></i>Send</button>
                </div>
            </form>
    </div>
</section>
@include('admin.layouts.scripts')
</body>
</html>
