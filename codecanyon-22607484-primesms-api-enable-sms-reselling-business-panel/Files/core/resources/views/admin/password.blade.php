@extends('admin.layouts.master')
@section('page_icon', 'fa fa-lock')
@section('page_name', 'Change Password')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-6 offset-md-3">
            <div class="tile">
                <form method="post" action="{{ route('admin.pass.change')}}">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"><b>Current Password</b></label>
                            <input class="form-control form-control-lg" type="password" name="cur_pass" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>New Password</b></label>
                            <input class="form-control form-control-lg" type="password" name="new_pass" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Confirm Password</b></label>
                            <input class="form-control form-control-lg" type="password" name="con_pass" required>
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
        });
    </script>
@endsection