@extends('user.layouts.master')
@section('page_icon', 'fa fa-user')
@section('page_name', 'User Details')
@section('body')
    <div class="tile">
        <div class="row">
            @include('user.layouts.flash')
            <div class="col-md-6">
                <p>Username: <b>{{ $user->username }}</b></p>
                <p>Email: <strong>{{ $user->email }}</strong></p>
            </div>
            <div class="col-md-6">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-envelope-o fa-3x"></i>
                    <div class="info">
                        <h4>SMS</h4>
                        <p><b>{{ $general->currency_symbol }} {{number_format($user->sms)}}</b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('client.transaction', $user->id) }}" class="user-details">
                            <div class="widget-small primary"><i class="icons fa fa-exchange fa-3x"></i>
                                <div class="info">
                                    <h6>Transaction Log</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('client.sms.log', $user->id) }}" class="user-details">
                            <div class="widget-small danger"><i class="icons fa fa-envelope-open fa-3x"></i>
                                <div class="info">
                                    <h6>SMS Log</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('user.users.email', $user->id) }}" class="btn btn-lg btn-block btn-primary"
                   style="margin-bottom:10px;">Send Email</a>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal"
                        data-target="#changepass">Change Password
                </button>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#addSms">
                    Add SMS Balance
                </button>
            </div>
        </div>
    </div>

    <div class="tile">
        <h3 class="tile-title">Update Profile</h3>
        <div class="tile-body">
            <form id="form" method="POST" action="{{ route('client.update', $user->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-4">
                        <label><b>User's Name</b></label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><b>Mobile Number</b></label>
                        <input type="text" name="mobile" class="form-control" value="{{$user->mobile}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><b>Email</b></label>
                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label><b>Country</b></label>
                        <input type="text" name="country" class="form-control" value="{{$user->country}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><b>City</b></label>
                        <input type="text" name="city" class="form-control" value="{{$user->city}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><b>Postal Code</b></label>
                        <input type="text" name="post_code" class="form-control" value="{{$user->post_code}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="padding-bottom: 20px;" for=""><b>Image
                                    (Support jpg/jpeg/png only)</b></label>

                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                 style="width: 300px; height: 150px; margin: -20px 0 5px 0;">
                                <img src="{{ asset('assets/user/upload/profile') }}/{{ $user->image != null ? $user->image : 'default.png'}}"
                                     id="newimg"
                                     style="width: 300px; height: 150px;"/>
                            </div>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><b>Address</b></label>
                            <textarea class="form-control" rows="5" name="address"
                                      required>{!! $user->address  !!} </textarea>
                            <div class="form-group">
                                <label><b>User Status</b></label>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-on="Active" data-off="Inactive" data-width="100%" type="checkbox"
                                       name="status" value="1" {{ $user->status == "1" ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-paper-plane"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <!--Change Pass Modal -->
    <div id="changepass" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title pull-left"><b>Change Password</b></h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('client.pass', $user->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label"><b>Password</b></label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--add sms -->
    <div id="addSms" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title pull-left">Add SMS balance</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('client.sms', $user->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label"><b>Amount</b></label>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-paper-plane"></i> Submit
                            </button>
                        </div>
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

