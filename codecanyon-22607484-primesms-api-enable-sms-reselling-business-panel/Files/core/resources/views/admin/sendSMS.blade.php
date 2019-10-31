@extends('admin.layouts.master')
@section('page_icon', 'fa fa-envelope-open')
@section('page_name', 'Send SMS')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <form method="post" action="{{ route('admin.sms.send') }}">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"><b>From (Your Number)</b></label>
                            <input class="form-control form-control-lg" type="text" name="from" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Gateway</b></label>
                            <select class="form-control form-control-lg" name="gateway" required>
                                <option>Select Gateway</option>
                                @foreach($gateways as $gateway)
                                    <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>To ( send message to multiple recipients by separate number
                                    with ; symbol)</b></label>
                            <textarea class="form-control form-control-lg" rows="4" name="to" id="number" placeholder="e.g: 123456;78910;23456" required></textarea>
                        </div>
                        <h3 class="text-center">Or</h3>
                        <div class="form-group">
                            <label class="control-label"><b>Upload Text file ( separate numbers with ; symbol)</b></label>
                            <input class="form-control form-control-lg " type="file" id="numberFile">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Message (Max: 160 Character)</b></label>
                            <textarea class="form-control form-control-lg" rows="3" name="message" id="message"
                                      maxlength="160" required></textarea>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><i
                                    class="fa fa-fw fa-lg fa-paper-plane"></i>Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                var str;
                $(document).on('change click', '#numberFile', function (evt) {
                    var txtFile = evt.target.files[0];
                    if (evt.target.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function () {
                            str = reader.result;
                            callBack(str);
                        }
                        reader.readAsText(evt.target.files[0]);
                    }
                });
            });

            function callBack(item) {
                str = item
                $('#number').val(str);
            }
        });

    </script>
@endsection