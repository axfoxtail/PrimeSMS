@extends('user.layouts.master')
@section('page_icon', 'fa fa-support')
@section('page_name', 'Support Ticket')
@section('body')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @include('user.layouts.flash')
            <div class="card">
                <div class="card-header d-flex justify-content-center bg-dark text-white">
                    <h3 class="h4">Open support ticket</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.ticket.store') }}">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="form-control-label"><b>Subject</b></label>
                                <input type="text" class="form-control form-control-lg" name="subject" required="">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label"><b>Message</b></label>
                                <textarea class="form-control" name="message" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary btn-block btn-lg" type="submit">
                                <i class="fa fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection