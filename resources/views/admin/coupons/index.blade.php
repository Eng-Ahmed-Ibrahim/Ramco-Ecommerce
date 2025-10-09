    @extends('admin.app')

    @php
        $title = 'Coupons';
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
                            <li class="breadcrumb-item text-muted"><a
                                    class="text-muted text-hover-primary">{{ $sub_title }}</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                            <li class="breadcrumb-item text-muted">{{ $title }}</li>
                        </ul>
                    </div>
                    @can('coupins-create')
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCouponModal"
                            onclick="resetCreateForm()">Create</button>
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
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Start At</th>
                                        <th>End At</th>
                                        @canany(['coupins-edit', 'coupins-delete'])
                                        <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->type }}</td>
                                            <td>{{ $coupon->value }}</td>
                                            <td>{{ \Carbon\Carbon::parse($coupon->start_at)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($coupon->end_at)->format('d M Y') }}</td>

                                            @canany(['coupins-edit', 'coupins-delete'])
                                            <td>
                                                @can('coupins-edit')
                                                <button class="btn btn-sm btn-warning edit-btn mx-2"
                                                    data-id="{{ $coupon->id }}" data-code="{{ $coupon->code }}"
                                                    data-type="{{ $coupon->type }}" data-value="{{ $coupon->value }}"
                                                    data-start_at="{{ $coupon->start_at }}"
                                                    data-end_at="{{ $coupon->end_at }}" data-bs-toggle="modal"
                                                    data-bs-target="#editCouponModal">
                                                    Edit
                                                </button>
                                                @endcan 
                                                @can('coupins-delete')
                                                <form action="{{ route('admin.coupons.destroy',$coupon->id) }}" style="display: inline-block" method="post">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this coupon?')">
                                                        Delete
                                                    </button>
                                                </form>
                                                @endcan

                                            </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Coupon Modal -->
        <div class="modal fade" id="createCouponModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" id="createCouponForm" action="{{ route('admin.coupons.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Coupon</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @include('admin.coupons._form_fields', ['prefix' => 'create_'])
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Coupon Modal -->
        <div class="modal fade" id="editCouponModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" id="editCouponForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Coupon</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @include('admin.coupons._form_fields', ['prefix' => 'edit_'])
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            function resetCreateForm() {
                document.getElementById('createCouponForm').reset();
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.edit-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const form = document.getElementById('editCouponForm');

                        const id = this.dataset.id;
                        const code = this.dataset.code;
                        const type = this.dataset.type;
                        const value = this.dataset.value;

                        const start_at = formatDateForInput(this.dataset.start_at);
                        const end_at = formatDateForInput(this.dataset.end_at);

                        form.action = `/admin/coupons/${id}`;

                        document.getElementById('edit_coupon_code').value = code;
                        document.getElementById('edit_coupon_type').value = type;
                        document.getElementById('edit_coupon_value').value = value;
                        document.getElementById('edit_coupon_start_at').value = start_at;
                        document.getElementById('edit_coupon_end_at').value = end_at;
                    });
                });
            });

            // function خارج السكريبت
    function formatDateForInput(dateString) {
    if (!dateString) return '';
    
    const date = new Date(dateString);

    // تعويض الفروقات الزمنية
    const correctedDate = new Date(date.getTime() + Math.abs(date.getTimezoneOffset() * 60000));

    return correctedDate.toISOString().slice(0, 10); // YYYY-MM-DD
}

        </script>
    @endsection
