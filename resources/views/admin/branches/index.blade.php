@extends('admin.app')
@php
$title="Branches";
$sub_title="Settings";
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
			<div class="d-flex align-items-center gap-2 gap-lg-3">

				<a  href="{{ route('admin.branches.create') }}"  class="btn btn-sm fw-bold btn-primary" >Create</a>
			</div>
		</div>
	</div>
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<div id="kt_app_content_container" class="app-container container-xxl">
			<div class="card">
				<div class="card-body p-lg-17">



 

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Office Tel</th>
                <th>Mobile</th>
                <th>Emails</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($branches as $branch)
                <tr>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->office_tel }}</td>
                    <td>{{ $branch->mobile_whatsapp }}</td>
                    <td>
                        Office: {{ $branch->office_email }} <br>
                        Factory: {{ $branch->factory_email }}
                    </td>
                    <td>
                        <a href="{{ route('admin.branches.edit', $branch) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.branches.destroy', $branch) }}" method="POST" class="d-inline-block">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


				</div>
			</div>
		</div>
	</div>
</div>

@endsection