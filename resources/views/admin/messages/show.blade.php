@extends('admin.app')
@php
    $title = 'Details';
    $sub_title = 'Messages';
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
                        <div class=" mt-3">
                            <div class="card-body">
                                <h4 class="mb-3">Customer Info</h4>
                                <div class="row">
                                    <div class="col-md-6"><strong>Name:</strong> {{ $message->name }}</div>
                                    <div class="col-md-6"><strong>Email:</strong> {{ $message->email }}</div>
                                    <div class="col-md-6"><strong>Country:</strong> {{ $message->country }}</div>
                                </div>

                                <hr>

                                <h4 class="mb-3">Message</h4>
                                <div class="row">
                                    <div class="col-md-12"> {{ $message->message }}</div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary mt-3">Back</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
