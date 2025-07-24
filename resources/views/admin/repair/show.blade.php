@extends('admin.app')
@php
    $title = 'Details';
    $sub_title = 'Pages';
@endphp
@section('title', $title)
@section('content')
    <div class="d-flex flex-column flex-column-fluid">

        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ $title }}</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">{{ $sub_title }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ $title }}</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_app">Create</a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="mb-3">Customer Info</h4>
                                <div class="row">
                                    <div class="col-md-6"><strong>Name:</strong> {{ $repair->full_name }}</div>
                                    <div class="col-md-6"><strong>Email:</strong> {{ $repair->email }}</div>
                                    <div class="col-md-6"><strong>Phone:</strong> {{ $repair->phone }}</div>
                                    <div class="col-md-6"><strong>Address:</strong> {{ $repair->address }}</div>
                                </div>

                                <hr>

                                <h4 class="mb-3">Product Info</h4>
                                <div class="row">
                                    <div class="col-md-6"><strong>Product:</strong> {{ $repair->product_name }}</div>
                                    <div class="col-md-6"><strong>Serial Number:</strong> {{ $repair->serial_number }}</div>
                                    <div class="col-md-6"><strong>Purchase Date:</strong> {{ $repair->purchase_date }}</div>
                                    <div class="col-md-6"><strong>Guarantee Date:</strong> {{ $repair->guarantee_date }}
                                    </div>
                                    <div class="col-md-6"><strong>Branch:</strong> {{ $repair->branch }}</div>
                                </div>

                                <hr>

                                <h4 class="mb-3">Issue</h4>
                                <div class="row">
                                    <div class="col-md-6"><strong>Issue:</strong> {{ $repair->issue }}</div>
                                    <div class="col-md-6"><strong>Description:</strong> {{ $repair->description }}</div>
                                    <div class="col-md-6"><strong>Visit Date:</strong> {{ $repair->visit_request_date }}
                                    </div>
                                    <div class="col-md-6"><strong>Time:</strong> {{ $repair->time }}</div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('admin.repair.index') }}" class="btn btn-secondary mt-3">Back</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
