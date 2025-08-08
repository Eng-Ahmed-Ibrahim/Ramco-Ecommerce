@extends('admin.app')
@php
    $title = 'Repair';
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

                    @if (request('limit') > count($sliders) || count($sliders)==0|| request('limit') == null)
                        <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addModal">Create</a>
                    @endif
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">


                        <div class="container py-4">


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Icon</th>
                                            <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->name }}</td>
                                            <td>{{ $slider->description }}</td>
                                            <td>
                                                @php
                                                    $extension = pathinfo($slider->icon, PATHINFO_EXTENSION);
                                                    $isImage = in_array(strtolower($extension), [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'gif',
                                                        'webp',
                                                        'svg'
                                                    ]);
                                                    $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']);
                                                @endphp

                                                @if ($isImage)
                                                    <img src="{{ asset('storage/' . $slider->icon) }}"  height="80" />
                                                @elseif ($isVideo)
                                                    <video width="200" height="150" controls>
                                                        <source src="{{ asset('storage/' . $slider->icon) }}"
                                                            type="video/{{ $extension }}">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    File not supported
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                onclick="editslider({{ $slider }})">Edit</button>
                                                @if (request('limit') == null)
                                                    <form method="POST"
                                                        action="{{ route('admin.sliders.destroy', $slider) }}"
                                                        style="display:inline-block">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                    @endif
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Add Modal --}}
                        <div class="modal fade" id="addModal" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.sliders.store') }}"
                                    enctype="multipart/form-data" class="modal-content">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add slider</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        @include('admin.sliders.form')
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editModal" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" id="editForm" enctype="multipart/form-data" class="modal-content">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit slider</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        @include('admin.sliders.form')
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function editslider(slider) {
            const form = document.getElementById('editForm');
            form.action = `/admin/sliders/${slider.id}`;
            form.querySelector('[name=name]').value = slider.name;
            form.querySelector('[name=description]').value = slider.description;
            form.querySelector('[name=section]').value = slider.section;
        }
    </script>
@endsection
