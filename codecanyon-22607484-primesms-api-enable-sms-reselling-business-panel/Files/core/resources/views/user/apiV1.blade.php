@extends('user.layouts.master')
@section('page_icon', 'fa fa-globe')
@section('page_name', 'API')
@section('body')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="table-rep-plugin table-responsive">
                        <table class="table" id="api-table">
                            <tbody>
                            <tr>
                                <th>API URL</th>
                                <td>{{url('/api/v1')}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Response format</th>
                                <td>JSON</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>HTTP Method</th>
                                <td>POST</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Your API key</th>
                                <td id="auth_key">{{ Auth::user()->api_key }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#cautionKeyGenerate" style="outline: none">Generate New
                                        key</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div id="accordion">
                        <div class="card custom-card">
                            <div class="card-header bg-dark click-accor" data-toggle="collapse"
                                 data-target="#collapseOne">
                                <h5 class="mb-0 pull-left text-white">Check Balance</h5>
                                <span class="pull-right"><i class="text-white fa fa-plus icon"></i></span>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordion" style="">
                                <div class="card-body">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <b>Required parameters</b>

                                            <div id="type_0">
                                                <ul>
                                                    <li><b width="20%">key</b> - Your API Key</li>
                                                    <li><b>action</b> - "balance"</li>
                                                </ul>
                                            </div>
                                            <br>
                                            <b>Success response :</b>
                                            <pre>[
     {<em>
        "name": "Mr. X"
        "username": "username"
        "sms": "50.5"
     </em>}
]</pre>
                                            <br>
                                            <b>Error response :</b>
                                            <ol>
                                                <li><em>{"error" : "Action should not be empty"}</em></li>
                                                <li><em>{"error" : "Api Key should not be empty"}</em></li>
                                                <li><em>{"error" : "Invalid Action"}</em></li>
                                                <li><em>{"error" : "Invalid API key"}</em></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div id="accordion">
                        <div class="card custom-card">
                            <div class="card-header bg-dark click-accor" data-toggle="collapse"
                                 data-target="#collapseTwo">
                                <h5 class="mb-0 pull-left text-white">Send SMS</h5>
                                <span class="pull-right"><i class="text-white fa fa-plus icon"></i></span>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordion" style="">
                                <div class="card-body">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <b>Required parameters</b>

                                            <div id="type_0">
                                                <ul>
                                                    <li><b width="20%">key</b> - Your API Key</li>
                                                    <li><b>action</b> - "send"</li>
                                                    <li><b>from</b> - "+1262332121"</li>
                                                    <li><b>to</b> - +120123451;+8801376231</li>
                                                    <li><b>message</b> - Your Message</li>
                                                </ul>
                                            </div>
                                            <br>
                                            <b>Success response :</b>
                                            <ol>
                                                <li><em>{"success" : "Message Sent"}</em></li>
                                            </ol>
                                            <br>
                                            <b>Error response :</b>
                                            <ol>
                                                <li><em>{"error" : "Api Key should not be empty"}</em></li>
                                                <li><em>{"error" : "Action should not be empty"}</em></li>
                                                <li><em>{"error" : "from should not be empty"}</em></li>
                                                <li><em>{"error" : "to should not be empty"}</em></li>
                                                <li><em>{"error" : "message should not be empty"}</em></li>
                                                <li><em>{"error" : "Invalid Api key"}</em></li>
                                                <li><em>{"error" : "Invalid Action"}</em></li>
                                                <li><em>{"error" : "Insufficient Balance"}</em></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cautionKeyGenerate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i
                                class='fa fa-exclamation-triangle'></i><strong>Caution!</strong></h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <strong>Your current api key will revoked. Are you sure to generate new api key?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close
                    </button>
                    <button type="button" class="btn btn-primary custom-btn-background" id="key-generate"><i
                                class="fa fa-check"></i> Yes I'm Sure.
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.click-accor', function () {
                if ($(this).find('.icon').hasClass('fa-plus')) {
                    $(this).find('.icon').removeClass('fa-plus').addClass('fa-minus');
                } else {
                    $(this).find('.icon').removeClass('fa-minus').addClass('fa-plus');
                }
            });
            $(document).on('click', '#key-generate', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '{{route('key.generate')}}',
                    success: function (data) {
                        $('#auth_key').text(data);
                        $('#cautionKeyGenerate').modal('hide');
                    },
                });
            });
        });
    </script>
@endsection