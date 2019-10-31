<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $general->title }}">
    <meta property="og:title" content="{{ $general->title }}">
    <meta property="og:url" content="http://thesoftking.com">
    <title>{{ $general->title }} | @yield('page_name')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layouts.styles')
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/user/upload/logo/icon.png') }}">
    <style>
        .app-header__logo{
            background-color: {{ $rgb or "#000" }};
        }
    </style>
</head>
<body class="app sidebar-mini rtl">
@include('admin.layouts.navbar')
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
@include('admin.layouts.sidebar')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="@yield('page_icon')"></i> @yield('page_name')</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            @yield('addButton')
        </ul>
    </div>
    @section('body')
        @show
</main>
@include('admin.layouts.scripts')
@yield('scripts')
</body>
</html>