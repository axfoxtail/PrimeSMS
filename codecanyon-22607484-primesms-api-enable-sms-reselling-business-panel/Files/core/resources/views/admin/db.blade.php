@extends('admin.layouts.master')
@section('page_icon', 'fa fa-database')
@section('page_name', 'Database Backup and Restore')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12 text-center">
            <div class="tile">
                <a href="{{ route('db.download') }}" class="btn btn-lg btn-success"><i
                            class="fa fa-download"></i> Download and Create Backup</a>
            </div>
        </div>
    </div>
@endsection
