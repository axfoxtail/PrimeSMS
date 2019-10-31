@extends('admin.layouts.master')
@section('page_icon', 'fa fa-users')
@section('page_name', 'Search Users List')
@section('body')
    <div class="tile">
        <div class="app-search float-right">
            <form method="POST" action="{{ route('admin.search-users') }}">
                @csrf
                <input type="search" name="search" class="app-search__input" style="background:#ddd;" value="{{ $key }}"
                       placeholder="Search User">
                <button class="app-search__button" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <h3 class="tile-title">Users List</h3>
        <table class="table table-hover table-responsive-lg">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            @if(count($users) > 0)
            @foreach($users as $user)
                <tr>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        {{$user->username}}
                    </td>
                    <td>
                        {{$user->mobile}}
                    </td>
                    <td>
                        <a href="{{route('admin.user-single', $user->id)}}" class="btn btn-outline-info">
                            <i class="fa fa-eye"></i> </a>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center"><h5>No User Found</h5></td>
                </tr>
            @endif
            <tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$users->links()}}
        </div>
    </div>
@endsection