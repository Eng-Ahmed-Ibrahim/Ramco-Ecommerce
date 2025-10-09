@extends('admin.app')
@php
    $title = 'Admin';
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
                @can('admins-create')
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addAdminModal">Create</a>
                </div>
                @endcan
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Avatar</th>
                                                                            @canany(['admins-edit', 'admins-delete'])

                                    <th>Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->role }}</td>
                                        <td>
                                            @if ($admin->avatar)
                                                <img src="{{ asset('storage/' . $admin->avatar) }}" width="40"
                                                    height="40" style="border-radius: 50%;">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        @canany(['admins-edit', 'admins-delete'])
                                        <td>
                                            @can('admins-edit')
                                            <button class="btn btn-sm btn-warning" data-id="{{ $admin->id }}"
                                                data-name="{{ $admin->name }}" data-email="{{ $admin->email }}"
                                                data-bs-toggle="modal" data-bs-target="#editAdminModal"
                                                data-role="{{ $admin->role }}"
                                                onclick="editAdmin(this)">
                                                Edit
                                            </button>
                                            @endcan

                                            @can('admins-delete')
                                            <a href="{{ route('admin.admins.delete', $admin->id) }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</a>
                                                @endcan
                                            </td>
                                            @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $admins->links() }}

                        <!-- Add Admin Modal -->
                        <div class="modal fade" id="addAdminModal" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.admins.store') }}" method="POST"
                                    enctype="multipart/form-data" class="modal-content">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" name="role" required
                                                aria-label="Default select example">
                                                <option selected>Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Avatar</label>
                                            <input type="file" name="avatar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Edit Admin Modal -->
                        <div class="modal fade" id="editAdminModal" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.admins.update') }}" method="POST"
                                    enctype="multipart/form-data" class="modal-content">
                                    @csrf
                                    <input type="hidden" name="admin_id" id="edit_admin_id">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input type="text" name="name" id="edit_name" class="form-control"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" id="edit_email" class="form-control"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" id="edit-role" name="role" required
                                                aria-label="Default select example">
                                                <option selected>Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control">
                                            <small class="text-muted">Leave empty if you don't want to change it</small>
                                        </div>
                                        <div class="mb-3">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Avatar</label>
                                            <input type="file" name="avatar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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
        function editAdmin(button) {
            let id = button.getAttribute('data-id');
            let name = button.getAttribute('data-name');
            let email = button.getAttribute('data-email');
            let role = button.getAttribute('data-role');

            document.getElementById('edit_admin_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit-role').value = role;
        }
    </script>
@endsection
