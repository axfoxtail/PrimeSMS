@extends('admin.layouts.master')
@section('page_icon', 'fa fa-wifi')
@section('page_name', 'Coverage Country List')
@section('addButton')
    <a class="btn btn-outline-success btn-lg" href="#" data-toggle="modal" data-target="#addroute"><i
                class="fa fa-plus-circle"></i> Add Route</a>
@endsection
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Coverage Lists</h3>
                <table class="table table-hover table-responsive-lg">
                    <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Country</th>
                        <th>Code</th>
                        <th>Sms Charge</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key => $item)
                        <tr>
                            <td>{{ ++$key }} </td>
                            <td>{{ $item->country }} </td>
                            <td>{{ $item->code }} </td>
                            <td>{{ $general->currency_symbol }} {{ isset($item->sms_charge) ? $item->sms_charge : $general->sms_charge }} </td>
                            <td>
                                @if($item->status == 0)
                                    <p class="btn badge-danger custom-btn-badge">Deactivate</p>
                                @elseif($item->status == 1)
                                    <p class="btn badge-success custom-btn-badge">Active</p>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-info coverage"
                                        data-toggle="modal"
                                        data-target="#editroute"
                                        data-route="{{ route('coverage.status', $item->id) }}"
                                        data-country="{{ $item->country }}"
                                        data-code="{{ $item->code }}"
                                        data-sms="{{ $item->sms_charge }}"
                                        data-status="{{ $item->status }}">
                                    <i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-outline-danger coverageDelete"
                                        data-toggle="modal"
                                        data-target="#deleteroute"
                                        data-route="{{ route('coverage.delete', $item->id) }}">
                                    <i class="fa fa-trash"></i></button>
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
    <div class="modal fade" id="addroute" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Route</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <form role="form" action="{{ route('coverage.store') }}" method="post">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for=""><b>Country Name</b></label>
                                        <input type="text" name="country" class="form-control form-control-lg"
                                               placeholder="Bangladesh" required>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Country Code</b></label>
                                        <input type="text" name="code" class="form-control form-control-lg"
                                               placeholder="+880" required>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Sms Charge</b></label>
                                        <div class="input-group">
                                            <input type="text" name="sms_charge" class="form-control form-control-lg"
                                                   required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">{{ $general->currency_symbol }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><b>Status</b></label>
                                        <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                               data-on="Active" data-off="Inactive" data-width="100%" type="checkbox"
                                               name="status" value="1">
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
        </div>
    </div>
    <div class="modal fade" id="editroute" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Route</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <form role="form" action="" method="post" id="edit-form">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="form-group">
                                <label for=""><b>Country Name</b></label>
                                <input type="text" name="country" id="country" class="form-control form-control-lg"
                                       placeholder="Bangladesh" required>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Country Code</b></label>
                                <input type="text" name="code" id="code" class="form-control form-control-lg"
                                       placeholder="+880" required>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Sms Charge</b></label>
                                <div class="input-group">
                                    <input type="text" name="sms_charge" id="sms_charge"
                                           class="form-control form-control-lg"
                                           required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{ $general->currency_symbol }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for=""><b>Status</b></label>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-on="Active" data-off="Inactive" data-width="100%" type="checkbox"
                                       name="status" id="status" value="1">
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary btn-block btn-lg" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteroute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i><strong>Confirmation!</strong>
                    </h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Are You sure to delete this route?</h5>
                </div>
                <div class="modal-footer">
                    <form method="post" action="" id="coverageStatus">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary custom-btn-background" name="replayTicket"
                                value="2"><i class="fa fa-check"></i> Yes I'm Sure.
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.coverage', function (e) {
                var country = $(this).data('country');
                var code = $(this).data('code');
                var sms = $(this).data('sms');
                var status = $(this).data('status');
                var route = $(this).data('route');
                $('#edit-form').attr('action', route);
                $('#country').val(country);
                $('#code').val(code);
                $('#sms_charge').val(sms);
                if (status == 1) {
                    $('#status').bootstrapToggle('on');
                } else {
                    $('#status').bootstrapToggle('off');
                }
            });
            $(document).on('click', '.coverageDelete', function (e) {
                var route = $(this).data('route');
                $('#coverageStatus').attr('action', route);
            });
        });
    </script>
@endsection