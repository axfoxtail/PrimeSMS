@extends('admin.layouts.master')
@section('page_icon', 'fa fa-user')
@section('page_name', 'User Details')
@section('body')
    <div class="tile">
        <div class="row">
            @include('admin.layouts.flash')
            <div class="col-md-6">
                <p>Email: <strong>{{ $user->email }}</strong></p>
                <p>Username: <b>{{ $user->username }}</b></p>
                <p>User Type: <b>{{ $user->roll == 0 ? 'User' : 'Reseller'}}</b></p>
                @if($user->roll == 0 && $user->refer_by == 0)
                    <form action="{{ route('admin.user-roll', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info">Mark as Reseller</button>
                    </form>
                @endif
            </div>
            <div class="col-md-6">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-envelope-o fa-3x"></i>
                    <div class="info">
                        <h4>SMS</h4>
                        <p><b>{{ $general->currency_symbol }} {{$user->sms}}</b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('single.transaction', $user->id) }}" class="user-details">
                            <div class="widget-small primary"><i class="icons fa fa-exchange fa-3x"></i>
                                <div class="info">
                                    <h6>Transaction Log</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('single.sms', $user->id) }}" class="user-details">
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
            <div class="col-md-3">
                <a href="{{route('admin.user-email',$user->id)}}" class="btn btn-lg btn-block btn-primary"
                   style="margin-bottom:10px;">Send Email</a>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal"
                        data-target="#changepass">Change Password
                </button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#addSms">
                    Add or Deduct SMS Balance
                </button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-secondary btn-lg btn-block" data-toggle="modal"
                        data-target="#addgateway">
                    Add Gateway
                </button>
            </div>
        </div>
    </div>

    <div class="tile">
        <h3 class="tile-title">Update Profile</h3>
        <div class="tile-body">
            <form id="form" method="POST" action="{{route('admin.user-status', $user->id)}}"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-4">
                        <label><b>User's Name</b></label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label><b>Phone</b></label>
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
                                <img src="{{ asset('assets/user/upload/profile') }}/{{ $user->image != null ? $user->image : 'default.jpg'}}"
                                     id="newimg"
                                     style="width: 300px; height: 150px;"/>
                            </div>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><b>Address</b></label>
                            <textarea class="form-control form-control-lg" rows="5" name="address"
                                      required>{!! $user->address  !!} </textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label><b>User Status</b></label>
                        <div class="toggle lg">
                            <label>
                                <input type="checkbox" value="1"
                                       name="status" {{ $user->status == "1" ? 'checked' : '' }}><span
                                        class="button-indecator"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label><b>Email Verification</b></label>
                        <div class="toggle lg">
                            <label>
                                <input type="checkbox" value="1"
                                       name="email_verify" {{ $user->email_verify == 0 ? 'checked' : '' }}><span
                                        class="button-indecator"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label><b>Sms Verification</b></label>
                        <div class="toggle lg">
                            <label>
                                <input type="checkbox" value="1"
                                       name="sms_verify" {{ $user->sms_verify == 0 ? 'checked' : '' }}><span
                                        class="button-indecator"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label><b>Two Factor Verification</b></label>
                        <div class="toggle lg">
                            <label>
                                <input type="checkbox" value="1"
                                       name="two_step_verify" {{ $user->two_step_verify == "1" ? 'checked' : '' }}><span
                                        class="button-indecator"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
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
                    <h4 class="modal-title">Change Password</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('admin.user-pass', $user->id)}}"
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
                    <h4 class="modal-title">Add or Deduct SMS</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('admin.user-sms', $user->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label"><b>Amount</b></label>
                            <input type="text" class="form-control" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"><b>Add or Subtract</b></label>
                            <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                   data-on="Add" data-off="Subtract"
                                   data-width="100%" type="checkbox" value="1"
                                   name="status">
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
    <!--add gateway -->
    <div id="addgateway" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add SMS Gateway</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('client.gateway', $user->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label"><b>Gateway</b></label>
                            <select class="form-control form-control-lg" name="gateway">
                                <option>Select Gateways</option>
                                @foreach($gateways as $gateway)
                                    <option value="{{ $gateway->id }}"
                                            @if($gateway->id == $user->gateway) selected @endif>{{ $gateway->name }}</option>
                                @endforeach
                            </select>
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

