@extends('admin.layouts.master')
@section('page_icon', 'fa fa-image')
@section('page_name', 'Logo-Icon Settings')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <form method="post" action="{{ route('logoicon.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center" style="width: 150px; height: 80px; border: 1px solid #000000">
                                    <img src="{{ asset('assets/user/upload/logo/logo.png') }}" id="logo-img" style="max-width: 125px; max-height: 60px;">
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><b>Logo</b></label>
                                    <input class="form-control form-control-lg" type="file" name="logo" id="logo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center" style="width: 150px; height: 80px; border: 1px solid #000000">
                                    <img src="{{ asset('assets/user/upload/logo/icon.png') }}" id="icon-img" style="max-width: 125px; max-height: 60px;">
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><b>Favicon</b></label>
                                    <input class="form-control form-control-lg" type="file" name="icon" id="icon">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('change', '#logo', function () {
                logoURL(this);
            });

            function logoURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#logo-img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(document).on('change', '#icon', function () {
                iconURL(this);
            });

            function iconURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#icon-img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endsection