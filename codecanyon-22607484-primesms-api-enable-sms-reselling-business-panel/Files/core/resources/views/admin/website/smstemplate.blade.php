@extends('admin.layouts.master')
@section('page_icon', 'fa fa-mobile')
@section('page_name', 'SMS Template')
@section('body')
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title"><i class="fa fa-bookmark"></i> Short Code</h3>
                        <div class="tile-body">
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <th> #</th>
                                        <th> CODE</th>
                                        <th> DESCRIPTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> 1</td>
                                        <td>
                                            <pre>&#123;&#123;message&#125;&#125;</pre>
                                        </td>
                                        <td> Details Text From Script</td>
                                    </tr>
                                    <tr>
                                        <td> 2</td>
                                        <td>
                                            <pre>&#123;&#123;number&#125;&#125;</pre>
                                        </td>
                                        <td> Users number. Will Pull From Database to send SMS.</td>
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
                                <h3 class="tile-title">SMS Api</h3>

                            <form role="form" method="POST" action="{{route('admin.UpdateSmsSetting')}}">
                                @csrf
                                <div class="tile-body">
                                    <div class="form-group">
                                        <label>SMS API</label>
                                        <input type="text" name="smsapi" class="form-control input-lg"
                                               value="{{$item->sms_api}}">
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
    <script type="text/javascript">
        $(document).ready(function () {
            bkLib.onDomLoaded(function () {
                nicEditors.allTextAreas()
            });
        });
    </script>
@endsection