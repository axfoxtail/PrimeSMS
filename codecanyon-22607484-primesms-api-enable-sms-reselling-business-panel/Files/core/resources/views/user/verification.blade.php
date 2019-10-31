@extends('user.layouts.master')
@section('page_icon', 'fa fa-lock')
@section('page_name', 'Two Factor google Authentication')
@section('body')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('user.layouts.flash')
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center">Two Factor Google Authenticator</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.verification.status') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control form-control-lg" id="key" name="key" value="{{ $secret }}" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text btn btn-primary copy-code" id="copy-btn">Copy </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img class="text-center" src="{{ $qrCodeUrl }}">
                        </div>
                        <button class="btn @if(Auth::user()->two_step_verify == 1 && isset(Auth::user()->two_step_code)) btn-danger @else btn-primary @endif btn-block btn-lg margin-top-10"
                                type="button" data-toggle="modal" data-target="#twoFactor-modal">
                            @if(Auth::user()->two_step_verify == 1 && isset(Auth::user()->two_step_code)) Disable @else
                                Enable @endif
                        </button>
                        <div id="twoFactor-modal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Enter Google Authentication Code</h4>
                                        <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">X
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group">
                                                    <input type="text" name="code" class="form-control form-control-lg"
                                                           placeholder="Enter Your Code" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center">Google Authenticator</h3>
                </div>
                <div class="card-body">
                    <h5 style="text-transform: capitalize;">Use Google Authenticator to Scan the QR code  or use the code</h5><hr>
                    <p class="text-justify">
                        Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.
                    </p>
                    <a class="btn btn-success btn-md" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&amp;hl=en" target="_blank">DOWNLOAD APP</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById("copy-btn").onclick = function () {
            document.getElementById('key').select();
            document.execCommand('copy');
        }
    </script>
@endsection