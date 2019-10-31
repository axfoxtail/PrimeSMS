@extends('admin.layouts.master')
@section('page_icon', 'fa fa-address-book')
@section('page_name', 'Contact Settings')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <form method="post" action="{{ route('admin.contact.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"><b>phone</b></label>
                                <input class="form-control form-control-lg" type="text" value="{{ $item->contact_phone }}" name="contact_phone">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Email</b></label>
                            <input class="form-control form-control-lg" type="email" value="{{ $item->contact_email }}" name="contact_email">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Address</b></label>
                            <textarea class="form-control form-control-lg" id="contact_address" rows="5" name="contact_address">{!! $item->contact_address !!}</textarea>
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
            bkLib.onDomLoaded(function() {
                nicEditors.editors.push(
                    new nicEditor().panelInstance(
                        document.getElementById('footer_text')
                    ),
                new nicEditor().panelInstance(
                    document.getElementById('contact_address')
                )
                );
            });
        });
    </script>
@endsection