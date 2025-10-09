@extends('admin.app')
@php
    $title = "General Settings";
    $sub_title = "Settings";
@endphp

@section('title', $title)

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ $title }}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">{{ $sub_title }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ $title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-lg-17" style="background: gray">

                    <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label class="form-label fw-bold">Header Logo</label><br>
                            @if(!empty($settings['site_header_logo']))
                                <img src="{{ asset('storage/' . $settings['site_header_logo']) }}" alt="Header Logo" width="150" class="mb-3 d-block">
                            @endif
                            <input type="file" name="site_header_logo" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold">Footer Logo</label><br>
                            @if(!empty($settings['site_footer_logo']))
                                <img src="{{ asset('storage/' . $settings['site_footer_logo']) }}" alt="Footer Logo" width="150" class="mb-3 d-block">
                            @endif
                            <input type="file" name="site_footer_logo" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold">Favicon</label><br>
                            @if(!empty($settings['site_favicon']))
                                <img src="{{ asset('storage/' . $settings['site_favicon']) }}" alt="Favicon" width="64" class="mb-3 d-block">
                            @endif
                            <input type="file" name="site_favicon" class="form-control" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
