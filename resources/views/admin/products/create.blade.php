@extends('admin.app')
@php
$title="Create Product";
$sub_title="Products";
@endphp
@section('title',$title)
@section('content')
<div class="d-flex flex-column flex-column-fluid">

	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ $title }}</h1>
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

		</div>
	</div>
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<div id="kt_app_content_container" class="app-container container-xxl">
			<div class="card">
				<div class="card-body p-lg-17">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.products.layouts.form')
                <button class="btn btn-primary w-100" >Create</button>
            </form>



				</div>
			</div>
		</div>
	</div>
</div>

@endsection