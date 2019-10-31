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
    <title>{{ $general->title }} | 404</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <h1 class="text-center" style="color: #c0392b; margin-top: 90px;"><i class="fa fa-exclamation-circle"></i> 404</h1>
    <h4 class="text-center">The Page you requested was not found !!</h4>
</section>
</body>
</html>