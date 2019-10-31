@extends('user.layouts.master')
@section('page_icon', 'fa fa-task')
@section('page_name', 'SMS Plan')
@section('body')
    <div class="row">
        @include('user.layouts.flash')
        <div class="col-md-12">
                <div class="row">
                    @foreach($items as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-dark text-color text-center">
                                <h4>{{ $item->name }}</h4>
                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-info text-color text-center">
                                            Min Amount
                                        </div>
                                        <div class="card-body text-center">
                                            {{ $item->min }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-info text-color text-center">
                                            Max Amount
                                        </div>
                                        <div class="card-body text-center">
                                            {{ $item->max }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-danger text-color text-center">
                                            Validity
                                        </div>
                                        <div class="card-body text-center">
                                            {{ $item->validity }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-danger text-color text-center">
                                            Support
                                        </div>
                                        <div class="card-body text-center">
                                            {{ $item->support }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-primary text-color text-center">
                                            Reselling
                                        </div>
                                        <div class="card-body text-center">
                                            {{ $item->reseller }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-primary text-color text-center">
                                            Others
                                        </div>
                                        <div class="card-body text-center">
                                            {{ $item->others }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-secondary text-color text-center">
                                            Price Per SMS
                                        </div>
                                        <div class="card-body text-center">
                                           {{$general->currency_symbol}} {{ $item->price }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
@endsection