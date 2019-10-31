@extends('user.layouts.master')
@section('page_icon', 'fa fa-ticket')
@section('page_name')
    Ticket #{{ $my_ticket->ticket }}
@endsection
@section('body')
            <div class="row">
                <div class="col-md-12">
                    @include('user.layouts.flash')
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <b class="ticket-design text-white">Subject:</b> <strong
                                    style="font-size: 18px;">{{ $my_ticket->subject }} </strong>
                            <span class="pull-right"><b class='support-btn open-support-btn'>

                                    @if($my_ticket->status == 0)
                                        <h5 class="btn badge-primary custom-btn-badge"> Open </h5>
                                        @elseif($my_ticket->status == 1)
                                        <h5 class="btn badge-success custom-btn-badge"> Answered </h5>
                                        @elseif($my_ticket->status == 2)
                                        <h5 class="btn badge-info custom-btn-badge"> Customer Replied </h5>
                                        @elseif($my_ticket->status == 3)
                                        <h5 class="btn badge-danger custom-btn-badge"> Closed </h5>
                                    @endif</b>
                                </span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 product-service md-margin-bottom-30">
                                    <ol class="commentlist noborder nomargin nopadding clearfix">
                                        @foreach($messages as $message)
                                            @if($message->type == 1)
                                                <div class="row">
                                                    <div class="col-md-10 offset-md-2">
                                                        <li class="comment even thread-even depth-1" id="li-comment-1">
                                                            <div id="comment-1" class="comment-wrap clearfix">
                                                                <div class="comment-meta">
                                                                    <div class="comment-author vcard">
                                                                <span class="comment-avatar clearfix">
                                                                    <img alt=""
                                                                         src="{{ asset('assets/user/upload/profile') }}/{{ Auth::user()->image }}"
                                                                         class="avatar avatar-60 photo avatar-default"
                                                                         width="60" height="60"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-content clearfix">
                                                                    <div class="comment-author">{{ $message->ticket->user->name }}
                                                                        <span>{{ $message->created_at->format('d F, Y - h:i A') }}</span>
                                                                    </div>
                                                                    <p>{{ $message->message }}</p>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </li>
                                                    </div>
                                                </div>
                                            @elseif($message->type == 2)
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <li class="comment even thread-even depth-1" id="li-comment-1">
                                                            <div id="comment-1" class="comment-wrap clearfix">
                                                                <div class="comment-meta">
                                                                    <div class="comment-author vcard">
                                                                <span class="comment-avatar clearfix">
                                                                    <img alt=""
                                                                         src="{{ asset('assets/user/upload/logo/logo.png') }}"
                                                                         class="avatar avatar-60 photo avatar-default"
                                                                         width="60" height="60"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-content clearfix">
                                                                    <div class="comment-author">
                                                                        Staff<span>{{ $message->created_at->format('d F, Y - h:i A') }}</span>
                                                                    </div>
                                                                    <p>{{ $message->message }}</p>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </li>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </ol>
                                </div>
                                @if($my_ticket->status != 4)
                                <form method="post" class="col-md-12" action="{{ route('user.message.store', $my_ticket->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control"
                                                      placeholder="Your Reply" required="" rows="4" cols="10"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary btn-block btn-lg custom-btn-background" name="replayTicket" value="1"><i class="fa fa-paper-plane"></i> Send
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-12">
                                                    <button type="button"
                                                            class="btn btn-danger btn-lg btn-block btn-block delete_button"
                                                            data-toggle="modal" data-target="#DelModal">
                                                        <i class="fa fa-times"></i> Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation!</strong> </h4>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <strong>Are you sure you want to Close This Support Ticket?</strong>
                    </div>
                    <div class="modal-footer">
                        <form method="post" action="{{ route('user.message.store', $my_ticket->id) }}">
                            @csrf
                            @method('PUT')
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary custom-btn-background" name="replayTicket" value="2"><i class="fa fa-check"></i> Yes I'm Sure.</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
@endsection
