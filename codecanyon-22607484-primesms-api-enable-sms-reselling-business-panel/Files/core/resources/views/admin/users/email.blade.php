@extends('admin.layouts.master')
@section('page_icon', 'fa fa-envelope')
@section('page_name', 'Send Broadcast Email')
@section('body')
<div class="tile">
    @include('admin.layouts.flash')
    <form role="form" method="POST" action="{{route('admin.send-email')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-body">
            <div class="form-group">
                <label>To</label>
                <input type="email" name="emailto" class="form-control input-lg" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="reciver" class="form-control input-lg" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control input-lg" value="">
            </div>
            <div class="form-group">
                <label>Email Message</label>
                <textarea class="form-control" name="emailMessage" rows="10">
                    
                </textarea>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="submit-btn btn btn-primary btn-lg btn-block login-button">Send Email</button>
        </div>
    </form>
</div>

@endsection