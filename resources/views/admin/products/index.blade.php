 @extends('admin.app')
 @php
     $title = 'Products';
     $sub_title = 'Pages';
 @endphp
 @section('title', $title)
 @section('css')
     <style>
         .handle {
             cursor: pointer;
         }

         .switch {
             position: relative;
             display: inline-block;
             width: 50px;
             height: 28px;
         }

         .switch input {
             opacity: 0;
             width: 0;
             height: 0;
         }

         .slider {
             position: absolute;
             cursor: pointer;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0;
             background-color: #ccc;
             transition: 0.4s;
             border-radius: 34px;
         }

         .slider:before {
             position: absolute;
             content: "";
             height: 22px;
             width: 22px;
             left: 3px;
             bottom: 3px;
             background-color: white;
             transition: 0.4s;
             border-radius: 50%;
         }

         input:checked+.slider {
             background-color: #4caf50;
         }

         input:checked+.slider:before {
             transform: translateX(22px);
         }
     </style>
 @endsection
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

                     <a href="{{ route('admin.products.create') }}" class="btn btn-sm fw-bold btn-primary">Add New
                         Product</a>
                 </div>
             </div>
         </div>
         <div id="kt_app_content" class="app-content flex-column-fluid">
             <div id="kt_app_content_container" class="app-container container-xxl">
                 <div class="card">
                     <div class="card-body p-lg-17">


                         <form action="{{ route('admin.products.index') }}" method="GET" class="mb-4">
                             <div class="row g-3 align-items-end">
                                 <div class="col-md-3">
                                     <label for="category_id" class="form-label">Category</label>
                                     <select id="category-select" name="category_id" class="form-control">
                                         <option value="all">All Categories</option>
                                         @foreach ($categories as $category)
                                             <option {{ request('category_id') == $category->id ? 'selected' : '' }}
                                                 value="{{ $category->id }}">{{ $category->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>

                                 <div class="col-md-3">
                                     <label for="sub_category_id" class="form-label">Sub Category</label>
                                     <select id="subcategory-select" name="sub_category_id" class="form-control">
                                         <option value="all">All Subcategories</option>
                                         @foreach ($sub_categories as $sub_category)
                                             <option {{ request('sub_category_id') == $sub_category->id ? 'selected' : '' }}
                                                 value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>

                                 <div class="col-md-3">
                                     <label for="search" class="form-label">Search</label>
                                     <input type="text" name="search" id="search" class="form-control"
                                         placeholder="Search by product name" value="{{ request('search') }}">
                                 </div>

                                 <div class="col-md-3 d-flex gap-2">
                                     <button type="submit" class="btn btn-primary w-100">Filter</button>
                                     <a href="{{ route('admin.products.index') }}"
                                         class="btn btn-secondary w-100">Reset</a>
                                 </div>
                             </div>
                         </form>


                         <table class="table mt-3" id="sortable-products">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Name</th>
                                     <th>Category</th>
                                     <th>Sub Category</th>
                                     <th>Price</th>
                                     <th>Thumbnail</th>
                                     <th>Home Banner</th>
                                     <th>Best Seller</th>
                                     <th>Best Product</th>

                                     <th>Actions</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @forelse ($products as $product)
                                     <tr data-id="{{ $product->id }}">
                                         <td class="handle">
                                             <div class="d-flex align-items-center justify-content-center">↕️</div>
                                         </td>
                                         <td>
                                             {{ $product->name }}
                                         </td>
                                         <td>
                                             {{ $product->category->name }}
                                         </td>
                                         <td>
                                             {{ $product->subCategory->name }}
                                         </td>
                                         <td>
                                             {{ $product->price }}
                                         </td>
                                         <td>
                                             <img src="{{ asset('storage/' . $product->thumbnail) }}" width="50">
                                         </td>
                                         {{-- Switches --}}
                                         <td>
                                             <label class="switch">
                                                 <input type="checkbox" class="toggle-home-banner"
                                                     data-id="{{ $product->id }}"
                                                     {{ $product->home_banner == 1 ? 'checked' : '' }}>
                                                 <span class="slider round"></span>
                                             </label>
                                         </td>

                                         <td>
                                             <label class="switch">
                                                 <input type="checkbox" class="toggle-switch" data-id="{{ $product->id }}"
                                                     data-type="is_best_seller"
                                                     {{ $product->is_best_seller == 1 ? 'checked' : '' }}>
                                                 <span class="slider round"></span>
                                             </label>
                                         </td>

                                         <td>
                                             <label class="switch">
                                                 <input type="checkbox" class="toggle-switch" data-type="is_best_product"
                                                     data-id="{{ $product->id }}"
                                                     {{ $product->is_best_product == 1 ? 'checked' : '' }}>
                                                 <span class="slider round"></span>
                                             </label>
                                         </td>

                                         <td>

                                             <div class="d-flex align-items-center justify-content-center gap-2">

                                                 <a href="{{ route('admin.products.edit', $product) }}"
                                                     class="btn btn-warning btn-sm">Edit</a>
                                                 <form action="{{ route('admin.products.destroy', $product) }}"
                                                     method="POST" style="display:inline-block">
                                                     @csrf @method('DELETE')
                                                     <button class="btn btn-danger btn-sm"
                                                         onclick="return confirm('Are you sure?')">Delete</button>
                                                 </form>
                                             </div>

                                         </td>
                                     </tr>
                                 @empty
                                     <tr>
                                         <td colspan="7" class="text-center">No Products Found.</td>
                                     </tr>
                                 @endforelse
                             </tbody>
                         </table>
                         {{ $products->links('vendor.pagination.custom') }}


                     </div>
                 </div>
             </div>
         </div>
     </div>

 @endsection
 @section('js')
     <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
     <script>
         $(function() {
             $('#sortable-products tbody').sortable({
                 handle: '.handle',
                 tolerance: 'pointer',

                 update: function() {
                     var order = [];
                     $('#sortable-products tbody tr').each(function(index) {
                         order.push({
                             id: $(this).data('id'),
                             position: index + 1
                         });
                     });

                     $.ajax({
                         url: '{{ route('admin.products.sort') }}',
                         method: 'POST',
                         data: {
                             order: order,
                             page: {{ $products->currentPage() }},
                             perPage: {{ $products->perPage() }},
                             _token: '{{ csrf_token() }}'
                         },
                         success: function(response) {
                             toastr.success('Product order updated');
                         }
                     });

                 }
             });
         });
     </script>
     <script>
         $('.toggle-switch').on('change', function() {
             let productId = $(this).data('id');
             let type = $(this).data('type');
             let isChecked = $(this).is(':checked') ? 1 : 0;

             $.ajax({
                 url: '{{ route('admin.products.toggleFlag') }}',
                 method: 'POST',
                 data: {
                     _token: '{{ csrf_token() }}',
                     id: productId,
                     type: type,
                     value: isChecked
                 },
                 success: function(response) {
                     let fieldName = type.replace(/_/g, ' ').replace(/\b\w/g, char => char
                         .toUpperCase());
                     toastr.success(fieldName + ' updated successfully');
                 },
                 error: function(xhr) {
                     toastr.error('Something went wrong');
                     // Rollback checkbox state on failure
                     $(this).prop('checked', !isChecked);
                 }.bind(this)
             });
         });
     </script>
     <script>
         $('.toggle-home-banner').on('change', function() {
             let productId = $(this).data('id');

             $.ajax({
                 url: '{{ route('admin.products.setHomeBanner') }}',
                 method: 'POST',
                 data: {
                     _token: '{{ csrf_token() }}',
                     id: productId
                 },
                 success: function(response) {
                     // Uncheck all then recheck the clicked one
                     $('.toggle-home-banner').prop('checked', false);
                     $(`.toggle-home-banner[data-id="${productId}"]`).prop('checked', true);

                     toastr.success('Home banner updated successfully');
                 },
                 error: function() {
                     toastr.error('Something went wrong!');
                 }
             });
         });
     </script>
     <script>
         const subCategories = @json($sub_categories);

         document.getElementById('category-select').addEventListener('change', function() {
             const categoryId = this.value;
             const subcategorySelect = document.getElementById('subcategory-select');

             // Clear previous options
             subcategorySelect.innerHTML = '<option value="all">All Subcategories</option>';

             // Filter and append subcategories
             subCategories.forEach(sub => {
                 if (categoryId === 'all' || sub.category_id == categoryId) {
                     const option = document.createElement('option');
                     option.value = sub.id;
                     option.textContent = sub.name;
                     subcategorySelect.appendChild(option);
                 }
             });
         });
     </script>
 @endsection
