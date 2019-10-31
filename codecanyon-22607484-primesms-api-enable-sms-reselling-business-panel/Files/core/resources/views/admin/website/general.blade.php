@extends('admin.layouts.master')
@section('page_icon', 'fa fa-cogs')
@section('page_name', 'General Settings')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <form method="post" action="{{ route('admin.UpdateGenSetting')}}">
                    @csrf
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Website Title</b></label>
                                    <input class="form-control form-control-lg" type="text" name="title"
                                           value="{{ $item->title or '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Base Color</b></label>
                                    <div class="input-group">
                                        <input class="form-control form-control-lg" type="color" name="color"
                                               id="colorValue" value="#{{ $item->base_color or 'fff' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Base Currency Symbol</b></label>
                                    <input type="text" class="form-control form-control-lg"
                                           value="{{$item->currency_symbol}}" name="currency_symbol"
                                           id="currency_symbol">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>SMS Charge</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">1 SMS</span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg"
                                               value="{{$item->sms_charge}}" name="sms_charge">
                                        <div class="input-group-append">
                                            <span class="input-group-text"
                                                  id="currency_rate">{{ $item->currency_symbol }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Default SMS Gateway</b></label>
                                    <select class="form-control form-control-lg" name="default_gateway">
                                        <option>Select Gateway</option>
                                        @foreach($gateways as $gateway)
                                        <option value="{{ $gateway->id }}" {{ $item->default_gateway == $gateway->id ? 'selected' : '' }}>{{ $gateway->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Google Recaptcha site key</b></label>
                                    <input type="text" class="form-control form-control-lg"
                                           value="{{$item->site_key}}" name="site_key">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Google Recaptcha secret key</b></label>
                                    <input type="text" class="form-control form-control-lg"
                                           value="{{$item->secret_key}}" name="secret_key">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="control-label"><b>Email Verification</b></label>
                                <div class="toggle lg">
                                    <label>
                                        <input type="checkbox" value="1"
                                               name="emailver" {{ $item->email_verification == "1" ? 'checked' : '' }}><span
                                                class="button-indecator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label><b>SMS Verification</b></label>
                                <div class="toggle lg">
                                    <label>
                                        <input type="checkbox" value="1"
                                               name="smsver" {{ $item->sms_verification == "1" ? 'checked' : '' }}><span
                                                class="button-indecator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label"><b>Email Notification</b></label>
                                <div class="toggle lg">
                                    <label>
                                        <input type="checkbox" value="1"
                                               name="emailnotf" {{ $item->email_notification == "1" ? 'checked' : '' }}><span
                                                class="button-indecator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label"><b>SMS Notification</b></label>
                                <div class="toggle lg">
                                    <label>
                                        <input type="checkbox" value="1"
                                               name="smsnotf" {{ $item->sms_notification == "1" ? 'checked' : '' }}><span
                                                class="button-indecator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label"><b>Recaptcha</b></label>
                                <div class="toggle lg">
                                    <label>
                                        <input type="checkbox" value="1"
                                               name="recaptcha" {{ $item->recaptcha == "1" ? 'checked' : '' }}><span
                                                class="button-indecator"></span>
                                    </label>
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
            $('#color').spectrum({
                color: $('#color').val(),
                change: function (color) {
                    $('#colorValue').val(color.toHexString().slice(1));
                }
            });
            bkLib.onDomLoaded(function () {
                nicEditors.allTextAreas()
            });

            $(document).ready(function () {
                $(document).on('keyup', '#currency_symbol', function () {
                    var val = $(this).val();
                    $('#currency_rate').text(val)
                });
            });
        });
    </script>
@endsection