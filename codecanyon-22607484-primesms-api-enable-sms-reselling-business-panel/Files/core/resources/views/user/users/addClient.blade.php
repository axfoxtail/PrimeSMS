@extends('user.layouts.master')
@section('page_icon', 'fa fa-user-plus')
@section('page_name', 'Add User')
@section('body')
    <div class="row">
        <div class="col-md-12">
            @include('user.layouts.flash')
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('store.client') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label"><b>Name <span class="custom-required">*</span></b></label>
                                <input type="text" class="form-control form-control-lg" name="name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Email <span class="custom-required">*</span></b></label>
                                        <input type="text" class="form-control form-control-lg" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Mobile Number <span class="custom-required">*</span></b></label>
                                        <input type="text" class="form-control form-control-lg" name="mobile" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Username <span class="custom-required">*</span></b></label>
                                        <input type="text" class="form-control form-control-lg" name="username" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Password <span class="custom-required">*</span></b></label>
                                        <input type="password" class="form-control form-control-lg" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><b>Image</b></label>
                                <input type="file" class="form-control form-control-lg" name="image">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><b>Country <span class="custom-required">*</span></b></label>
                                        <input type="text" class="form-control form-control-lg" name="country" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><b>City</b></label>
                                        <input type="text" class="form-control form-control-lg" name="city">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><b>Postal Code</b></label>
                                        <input type="text" class="form-control form-control-lg" name="post_code">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><b>Address</b></label>
                                <textarea class="form-control form-control-lg" rows="4" name="address"></textarea>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary btn-block btn-lg" type="submit"><i
                                        class="fa fa-fw fa-lg fa-plus-circle"></i>Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection