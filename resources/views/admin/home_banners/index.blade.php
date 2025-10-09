@extends('admin.app')
@php
    $title = 'Home banners';
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
                @can('home page-create banner')
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                    <a href="#" class="btn btn-sm fw-bold btn-primary"  data-bs-toggle="modal" data-bs-target="#addModal">Create</a>
                </div>
                @endcan
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">



                        <div class="container mt-5">
  


                            <!-- Banners Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sub Title</th>
                                        <th>Description</th>
                                        <th>Link</th>
                                        <th>Background</th>
                                        <th>Align</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->name }}</td>
                                            <td>{{ $banner->sub_title }}</td>
                                            <td>{{ $banner->description }}</td>
                                            <td>{{ $banner->link }}</td>
                                            <td><img style="height: 70px" src="{{ asset('storage/' . $banner->background ) }}" alt=""></td>
                                            <td>{{ $banner->align }}</td>
                                            <td class="d-flex gap-1">
                                                @can('home page-edit banner')
                                                <button class="btn btn-sm btn-warning editBtn"
                                                    data-id="{{ $banner->id }}" data-name="{{ $banner->name }}"
                                                    data-sub_title="{{ $banner->sub_title }}"
                                                    data-description="{{ $banner->description }}"
                                                    data-link="{{ $banner->link }}"
                                                    data-background="{{ $banner->background }}"
                                                    data-align="{{ $banner->align }}" data-bs-toggle="modal"
                                                    data-bs-target="#editModal">Edit</button>
                                                    @endcan

                                                    @can('home page-delete banner')
                                                <form action="{{ route('admin.home-banners.destroy', $banner) }}" method="POST"
                                                    style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Add Modal -->
                        <div class="modal fade"  id="addModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.home-banners.store') }}" class="modal-content">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Banner</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        @include('admin.home_banners.form')
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="w-100 btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST"  enctype="multipart/form-data" id="editForm" class="modal-content">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Banner</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        @include('admin.home_banners.form')
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="w-100 btn btn-warning">Update</button>
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
        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                const form = document.getElementById('editForm');
                const id = btn.dataset.id;

                form.action = `/admin/home-banners/${id}`;

                form.querySelector('[name="name"]').value = btn.dataset.name;
                form.querySelector('[name="sub_title"]').value = btn.dataset.sub_title;
                form.querySelector('[name="description"]').value = btn.dataset.description;
                form.querySelector('[name="link"]').value = btn.dataset.link;
                form.querySelector('[name="background"]').value = btn.dataset.background;
                form.querySelector('[name="align"]').value = btn.dataset.align;
            });
        });
    </script>
@endsection
