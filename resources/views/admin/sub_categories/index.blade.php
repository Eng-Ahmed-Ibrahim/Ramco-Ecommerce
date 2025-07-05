@extends('admin.app')
@php
    $title = 'Sub Category';
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
                        data-bs-target="#addModal">Create</a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">

                        <form method="GET" action="{{ route('admin.sub_category.index') }}"
                            class="mb-4 d-flex gap-3 align-items-end">
                            <div>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <input type="text" name="name" value="{{ request('name') }}" class="form-control"
                                    placeholder="Search...">
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.sub_category.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>


                        <!-- ✅ Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($sub_categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->category->name }}</td>
                                        <td>
                                            <!-- Edit -->
                                            <button class="btn btn-sm btn-warning editBtn" data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}"
                                                data-category_id="{{ $category->category_id }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                Edit
                                            </button>

                                            <!-- Delete -->
                                            <form method="POST"
                                                action="{{ route('admin.sub_category.destroy', $category) }}"
                                                style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No data found.</td>
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
                <form method="POST" action="{{ route('admin.sub_category.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Sub Category Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Sub Category Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="category">Category</label>
                                <select class="form-select" id="category" name="category_id" required>
                                    <option selected disabled>Select Category</option>
                                    @forelse($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option>No Categories Avaliable</option>
                                    @endforelse


                                </select>
                            </div>
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
                            <div class="mb-3">
                                <label for="editName">Sub Category Name</label>
                                <input type="text" id="editName" name="name" class="form-control"
                                    placeholder="Sub Category Name" required>
                            </div>
                            <div class="mb-3">

                                <label for="editCategoryId">Category</label>
                                <select class="form-select" id="editCategoryId" name="category_id" required>
                                    <option selected disabled>Select Category</option>
                                    @forelse($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option>No Categories Avaliable</option>
                                    @endforelse


                                </select>
                            </div>
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
                const category_id = this.dataset.category_id;
                document.getElementById('editName').value = name;
                document.getElementById('editCategoryId').value = category_id;
                document.getElementById('editForm').action = '/admin/sub_category/' + id;
            });
        });
    </script>
@endsection
