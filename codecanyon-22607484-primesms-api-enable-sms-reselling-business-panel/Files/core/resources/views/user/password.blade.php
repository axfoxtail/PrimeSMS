@extends('user.layouts.master')
@section('page_icon', 'fa fa-unlock-alt')
@section('page_name', 'Change Password')
@section('body')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('user.layouts.flash')
            <div class="card">
                <div class="card-body">
            <form method="post" action="{{ route('user.pass.change') }}">
                @csrf
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label"><b>Current Password</b></label>
                        <input type="password" class="form-control form-control-lg" name="cur_pass" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><b>New Password</b></label>
                        <input type="password" class="form-control form-control-lg" name="new_pass" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><b>Confirm Password</b></label>
                        <input type="password" class="form-control form-control-lg" name="con_pass" required>
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
    </div>
@endsection