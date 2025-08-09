@extends('admin.app')
@php
    $title = 'Socail Media';
    $sub_title = 'Settings';
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
                        data-bs-target="#addModal">Create</a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">


                        <div class="container mt-4">


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Link</th>
                                        <th>Icon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($socialLinks as $link)
                                        <tr>
                                            <td><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a></td>
                                            <td><i class="{{ $link->icon }}"></i> {{ $link->icon }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm"
                                                    onclick="openEditModal({{ $link->id }}, '{{ $link->link }}', '{{ $link->icon }}')">Edit</button>

                                                <form action="{{ route('admin.social.destroy', $link->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure?')"
                                                        class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No links found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Add Modal -->
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.social.store') }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Add Link</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Link</label>
                                            <input type="url" name="link" class="form-control" required>

                                            <label class="mt-3">Icon</label>
                                            <select name="icon" class="form-control" required>
                                                <option value="">-- Select Icon --</option>
                                                <option value="fa-brands fa-square-facebook">Facebook</option>
                                                <option value="fa-brands fa-instagram">Instagram</option>
                                                <option value="fa-brands fa-square-x-twitter">X (Twitter)</option>
                                                <option value="fa-brands fa-youtube">YouTube</option>
                                                <option value="fa-brands fa-linkedin">LinkedIn</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer mt-3">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" id="editForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Link</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Link</label>
                                            <input type="url" name="link" id="edit_link" class="form-control"
                                                required>

                                            <label class="mt-3">Icon</label>
                                            <select name="icon" id="edit_icon" class="form-control" required>
                                                <option value="">-- Select Icon --</option>
                                                <option value="fa-brands fa-square-facebook">Facebook</option>
                                                <option value="fa-brands fa-instagram">Instagram</option>
                                                <option value="fa-brands fa-square-x-twitter">X (Twitter)</option>
                                                <option value="fa-brands fa-youtube">YouTube</option>
                                                <option value="fa-brands fa-linkedin">LinkedIn</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer mt-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
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
        function openEditModal(id, link, icon) {
            document.getElementById('edit_link').value = link;
            document.getElementById('edit_icon').value = icon;
            const form = document.getElementById('editForm');
            form.action = '/admin/social-media/' + id;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>
@endsection
