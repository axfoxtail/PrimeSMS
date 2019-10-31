@extends('user.layouts.master')
@section('page_icon', 'fa fa-envelope-open')
@section('page_name', 'Send SMS')
@section('body')
    <div class="row">
        @include('user.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <form method="post" action="{{ route('user.send.sms') }}">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"><b>From (Sender)</b></label>
                            <input class="form-control form-control-lg" type="text" name="from" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>To ( send message to multiple recipients by separate number
                                    with ; symbol )</b></label>
                            <textarea class="form-control form-control-lg" rows="4" name="to" id="number" placeholder="e.g: 123456;78910;23456" required></textarea>
                        </div>
                        <h3 class="text-center">Or</h3>
                        <div class="form-group">
                            <label class="control-label"><b>Upload Text file ( separate numbers with ; symbol)</b></label>
                            <input class="form-control form-control-lg" type="file" id="numberFile">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Message (Max: 160 Character)</b></label>
                            <textarea class="form-control form-control-lg" rows="3" name="message" id="message" maxlength="160" required></textarea>
                            <p id="max-error"></p>
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
    </script>
@endsection