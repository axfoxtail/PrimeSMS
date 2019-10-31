@extends('admin.layouts.master')
@section('page_icon', 'fa fa-tasks')
@section('page_name', 'Plans')
@section('addButton')
    <a class="btn btn-outline-success btn-lg" href="#" data-toggle="modal" data-target="#addPlan"><i
                class="fa fa-plus-circle"></i> Add Plan</a>
@endsection
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Plans</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $general->currency_symbol }} {{ $item->price }}</td>
                            <td>{{ $item->min }}</td>
                            <td>{{ $item->max }}</td>
                            <td>
                                {!! $item->status == 0 ? '<span class="btn badge-danger custom-btn-badge">Inactive</span>' : '<span class="btn badge-success custom-btn-badge">Active</span>' !!}
                            </td>
                            <td>
                                <button class="btn btn-outline-info plan_edit_btn"
                                        data-toggle="modal"
                                        data-target="#editPlan"
                                        data-route="{{ route('plan.update', $item->id) }}"
                                        data-name="{{ $item->name }}"
                                        data-price="{{ $item->price }}"
                                        data-min="{{ $item->min }}"
                                        data-max="{{ $item->max }}"
                                        data-validity="{{ $item->validity }}"
                                        data-support="{{ $item->support }}"
                                        data-reseller="{{ $item->reseller }}"
                                        data-others="{{ $item->others }}"
                                        data-status="{{ $item->status }}">
                                    <i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addPlan" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Plan</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <form role="form" action="{{ route('plan.store') }}" method="post">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for=""><b>Name</b></label>
                                        <input type="text" name="name" class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Price</b></label>
                                        <div class="input-group">
                                        <input type="text" name="price" class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ $general->currency_symbol }}</span>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Min</b></label>
                                            <input type="text" name="min" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Max</b></label>
                                            <input type="text" name="max" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Validity</b></label>
                                            <input type="text" name="validity" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Support</b></label>
                                            <input type="text" name="support" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Reseller</b></label>
                                            <input type="text" name="reseller" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Others</b></label>
                                            <input type="text" name="others" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Status</b></label>
                                        <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                               data-on="Active" data-off="Inactive" data-width="100%" type="checkbox" name="status" value="1">
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
    <div class="modal fade" id="editPlan" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Plan</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <form role="form" action="" method="post"
                                  id="planEditdForm">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for=""><b>Name</b></label>
                                        <input type="text" name="name" id="name" class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Price</b></label>
                                        <div class="input-group">
                                            <input type="text" name="price" id="price" class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">{{ $general->currency_symbol }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Min</b></label>
                                            <input type="text" name="min" id="min" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Max</b></label>
                                            <input type="text" name="max" id="max" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Validity</b></label>
                                            <input type="text" name="validity" id="validity" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Support</b></label>
                                            <input type="text" name="support" id="support" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Reseller</b></label>
                                            <input type="text" name="reseller" id="reseller" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b>Others</b></label>
                                            <input type="text" name="others" id="others" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Status</b></label>
                                        <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                               data-on="Active" data-off="Inactive" data-width="100%" type="checkbox" name="status" id="status" value="1">
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
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.plan_edit_btn', function () {
                var route = $(this).data('route');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var min = $(this).data('min');
                var max = $(this).data('max');
                var validity = $(this).data('validity');
                var support = $(this).data('support');
                var reseller = $(this).data('reseller');
                var others = $(this).data('others');
                var status = $(this).data('status');
                $('#name').val(name);
                $('#price').val(price);
                $('#min').val(min);
                $('#max').val(max);
                $('#validity').val(validity);
                $('#support').val(support);
                $('#reseller').val(reseller);
                $('#others').val(others);
                $('#planEditdForm').attr('action',route);
                if(status == 1){
                    $('#status').bootstrapToggle('on');
                }else{
                    $('#status').bootstrapToggle('off');
                }
            });
            $(document).on('click', '.plan_dlt_btn', function () {
                var route = $(this).data('route');
                $('#planDelForm').attr('action', route);
            });
        });
    </script>
@endsection