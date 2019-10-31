@extends('user.layouts.master')
@section('page_icon', 'fa fa-users')
@section('page_name', 'My Profile')
@section('body')
    <div class="row">
        @include('user.layouts.flash')
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
            <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><b>Name</b></label>
                            <input type="text" class="form-control form-control-lg" name="name" value="{{ $item->name }}"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><b>Phone</b></label>
                            <input type="text" class="form-control form-control-lg" name="mobile" value="{{ $item->mobile }}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="padding-bottom: 20px;" for=""><b>Image
                                    (Support jpg/jpeg/png only)</b></label>

                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                 style="width: 300px; height: 150px; margin: -20px 0 5px 0;">
                                <img src="{{ asset('assets/user/upload/profile') }}/{{ $item->image != null ? $item->image : 'default.jpg'}}" id="newimg"
                                     style="width: 300px; height: 150px;"/>
                            </div>
                             <input type="file" name="image" class="form-control" id="image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><b>Address</b></label>
                            <textarea class="form-control form-control-lg" rows="4" name="address" required>{!! $item->address  !!} </textarea>

                            <div class="form-group" style="margin-top: 2px;">
                                <label class="control-label"><b>Country</b></label>
                                <input type="text" class="form-control form-control-lg" name="country" value="{{ $item->country }}"
                                       required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><b>City</b></label>
                            <input type="text" class="form-control form-control-lg" name="city" value="{{ $item->city }}"
                                   required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><b>Postal Code</b></label>
                            <input type="text" class="form-control form-control-lg" name="post_code"
                                   value="{{ $item->post_code }}" required="">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Save
                </button>
            </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('change', '#image', function () {
                readURL(this);
            });
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#newimg').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endsection