@extends('admin.layouts.master')
@section('page_icon', 'fa fa-envelope')
@section('page_name', 'Email Template')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                            <h3 class="tile-title"><i class="fa fa-bookmark"></i> Short Code</h3>
                    <div class="tile-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> CODE </th>
                                    <th> DESCRIPTION </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> <pre>&#123;&#123;name&#125;&#125;</pre> </td>
                                    <td> Users Name. Will Pull From Database and Use in EMAIL text</td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> <pre>&#123;&#123;message&#125;&#125;</pre> </td>
                                    <td> Details Text From Script</td>
                                </tr>
                                </tbody>
                            </table>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <form method="post" action="{{ route('admin.UpdateEmailSetting')}}">
                    @csrf
                    <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label"><b>Email Sent Form</b></label>
                                    <input class="form-control form-control-lg" type="email" name="esender"
                                           value="{{ $item->e_sender or '' }}">
                                </div>
                        <div class="form-group">
                            <label class="control-label"><b>Email Message</b></label>
                            <textarea class="form-control" name="emessage" id="message" rows="20">{{ $item->e_message or '' }}</textarea>
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
            bkLib.onDomLoaded(function () {
                nicEditors.editors.push(
                    new nicEditor().panelInstance(
                        document.getElementById('message')
                    )
                );
            });
        });
    </script>
@endsection