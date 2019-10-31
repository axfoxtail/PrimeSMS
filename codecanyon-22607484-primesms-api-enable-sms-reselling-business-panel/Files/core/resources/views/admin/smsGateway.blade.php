@extends('admin.layouts.master')
@section('page_icon', 'fa fa-credit-card')
@section('page_name', 'SMS Gateway List')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">SMS Gateways</h3>
                <table class="table table-hover table-responsive-lg">
                    <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key => $item)
                        <tr>
                            <td>{{ ++$key }} </td>
                            <td>{{ $item->name }} </td>
                            <td>
                                @if($item->status == 0)
                                    <p class="btn badge-danger custom-btn-badge">Deactive</p>
                                @elseif($item->status == 1)
                                    <p class="btn badge-success custom-btn-badge">Active</p>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-outline-info gateway_item_edit_btn"
                                        data-toggle="modal"
                                        data-target="#editgetway"
                                        data-id="{{$item->id}}"
                                        data-route="{{route('sms.gateway.edit', $item->id)}}"
                                        data-name="{{$item->name}}"
                                        data-val1="{{$item->val1}}"
                                        data-val2="{{$item->val2}}"
                                        data-val3="{{$item->val3}}"
                                        data-status="{{$item->status}}"><i
                                            class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editgetway" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <span id="gateway-name"></span> Details</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <form role="form" action="" method="post"
                                  enctype="multipart/form-data" id="gateway-form">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for=""><b id="egval1"></b></label>
                                        <input type="text" name="val1" class="form-control form-control-lg"
                                               id="egtval1">
                                    </div>
                                    <div class="form-group" id="dval2">
                                        <label for=""><b id="egval2"></b></label>
                                        <input type="text" name="val2" class="form-control form-control-lg"
                                               id="egtval2">
                                    </div>
                                    <div class="form-group" id="dval3">
                                        <label for=""><b id="egval3"></b></label>
                                        <input type="text" name="val3" class="form-control form-control-lg"
                                               id="egtval3">
                                    </div>
                                            <div class="form-group">
                                                <label for=""><b>Status</b></label>
                                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                                       data-width="100%" type="checkbox" value="1"
                                                       name="status" id="estatus">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.gateway_item_edit_btn', function () {
                $('#dval2').show();
                $('#dval3').show();
                $('#gateway-form').attr('action',$(this).data('route'));
                $('#gateway-name').text($(this).data('name'));
                var id = $(this).data('id');
                var val1 = $(this).data('val1');
                var val2 = $(this).data('val2');
                var val3 = $(this).data('val3');
                if (id == 1){
                    $('#egval1').text("ACCOUNT SID");
                    $('#egtval1').val(val1);
                    $('#egval2').text("AUTH TOKEN");
                    $('#egtval2').val(val2);
                    $('#egval3').text("FROM NUMBER/SHORTCODE");
                    $('#egtval3').val(val3);
                }else if (id == 2){
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("PASSWORD");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 3) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val(val1);
                    $('#dval2').hide();
                    $('#dval3').hide();
                } else if (id == 4) {
                    $('#egval1').text("AUTH KEY");
                    $('#egtval1').val(val1);
                    $('#egval2').text("SENDER ID");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 5) {
                    $('#egval1').text("AUTH ID");
                    $('#egtval1').val(val1);
                    $('#egval2').text("AUTH TOKEN");
                    $('#egtval2').val(val2);
                    $('#egval3').text("SENDER NUMBER");
                    $('#egtval3').val(val3);
                } else if (id == 6) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val(val1);
                    $('#egval2').text("API SECRET");
                    $('#egtval2').val(val2);
                    $('#egval3').text("FROM NUMBER");
                    $('#egtval3').val(val3);
                } else if (id == 7) {
                    $('#egval1').text("CLIENT ID");
                    $('#egtval1').val(val1);
                    $('#egval2').text("CLIENT SECRET");
                    $('#egtval2').val(val2);
                    $('#egval3').text("FROM NUMBER");
                    $('#egtval3').val(val3);
                } else if (id == 8) {
                    $('#egval1').text("SECRET TOKEN");
                    $('#egtval1').val(val1);
                    $('#egval2').text("DEVICE ID");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 9) {
                    $('#egval1').text("CLIENT ID");
                    $('#egtval1').val(val1);
                    $('#egval2').text("SECRET KEY");
                    $('#egtval2').val(val2);
                    $('#egval3').text("SHORTCODE");
                    $('#egtval3').val(val3);
                } else if (id == 10) {
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("PASSWORD");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 11) {
                    $('#egval1').text("CUSTOMER ID");
                    $('#egtval1').val(val1);
                    $('#egval2').text("API KEY");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 12) {
                    $('#egval1').text("PROJECT IDENTIFIER");
                    $('#egtval1').val(val1);
                    $('#egval2').text("TOKEN");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 13) {
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("API V2 TOKEN");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 14) {
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("PASSWORD");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 15) {
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("API PASSWORD IN MD5");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 16) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val(val1);
                    $('#dval2').hide();
                    $('#dval3').hide();
                } else if (id == 17) {
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("PASSWORD");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 18) {
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("PASSWORD");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 19) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val(val1);
                    $('#dval2').hide();
                    $('#dval3').hide();
                } else if (id == 20) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val(val1);
                    $('#egval2').text("SENDER ID");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 21) {
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("PASSWORD");
                    $('#egtval2').val(val2);
                    $('#dval3').hide();
                } else if (id == 22) {
                    $('#egval1').text("USERNAME");
                    $('#egtval1').val(val1);
                    $('#egval2').text("PASSWORD");
                    $('#egtval2').val(val2);
                    $('#egval3').text("SENDER ID");
                    $('#egtval3').val(val3);
                } else if (id == 23) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val(val1);
                    $('#dval2').hide();
                    $('#dval3').hide();
                } else if (id == 24) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val(val1);
                    $('#dval2').hide();
                    $('#dval3').hide();
                }
                var status = $(this).data('status');
                if(status == 1){
                    $('#estatus').bootstrapToggle('on');
                }else{
                    $('#estatus').bootstrapToggle('off');
                }
            });
        });
    </script>
@endsection