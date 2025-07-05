@extends('admin.app')
@php
    $title = 'Categories';
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

                    {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">{{__('messages.Create')}}</a> --}}
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">



                        <!-- ✅ Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <!-- Edit -->
                                            <button class="btn btn-sm btn-warning editBtn" data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}" data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                Edit
                                            </button>

                                            <!-- Delete -->
                                            {{-- <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                                style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>


        <!-- ✅ Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ✅ Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                document.getElementById('editName').value = name;
                document.getElementById('editForm').action = '/admin/categories/' + id;
            });
        });
    </script>
@endsection
