@extends('admin.app')
@php
$title="$role->name";
$sub_title="Roles";
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



					<!--begin::Form-->
					<form id="kt_modal_add_role_form" action="{{route('admin.roles.update')}}" class="form form-ajax fv-plugins-bootstrap5 fv-plugins-framework" method="post">
						@csrf
						<input type="hidden" name="id" value="{{$role->id}}">
						<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px" style="max-height: 347px;">
							<!--begin::Input group-->
							<div class="fv-row mb-10 fv-plugins-icon-container">
								<!--begin::Label-->
								<label class="fs-5 fw-bold form-label mb-2">
									<span class="required">Role Name</span>
								</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input {{$role->name == "admin" || $role->name == "provider" || $role->name=="customer" ? "readonly" :  ' '}} class="form-control form-control-solid" value="{{$role->name}}" name="name" id="name" required>
								<!--end::Input-->
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							<!--end::Input group-->
							<!--begin::Permissions-->
							<div class="fv-row">
								<!--begin::Label-->
								<label class="fs-5 fw-bold form-label mb-2">Permissions</label>
								<!--end::Label-->
								<!--begin::Table-->
								<div id="" class="table-responsive">

									<table class="table align-middle table-row-dashed fs-6 gy-5">
										<!--begin::Table body-->
										<tbody class="text-gray-600 fw-semibold">
											<!--begin::Table row-->
											<tr>
												<td class="text-gray-800">Administrator Access  <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Allows a full access to the system" data-bs-original-title="Allows a full access to the system" data-kt-initialized="1"></i>
												</td>
												<td>
													<!--begin::Checkbox-->
													<label onclick="selectAll()" class="form-check form-check-custom form-check-solid me-9">
														<input class="form-check-input permissions" type="checkbox" value="" id="kt_roles_select_all">
														<span class="form-check-label" for="kt_roles_select_all">Select All</span>
													</label>
													<!--end::Checkbox-->
												</td>
											</tr>
										</tbody>
										<!--end::Table body-->
									</table>
								</div>
								<div class="fv-row">
									<!--begin::Card-->
									<div class="card card-flush h-md-100">
										<!--begin::Card header-->
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body pt-1">

											<div class="row">

												@foreach($permissions as $setionName => $permissions)
												<span class="my-3"> {{ucwords($setionName)}}</span>

												@foreach($permissions as $permission)
												<label class="col-4 mb-2">
													<input {{in_array($permission->name, $rolePermissions) ? 'checked' : ' '}} class="form-check-input permissions" type="checkbox" value="{{$permission->name}}" name="permissions[]">
													<span class="form-check-label fw-bold">
														{{ ucwords(str_replace("$setionName-","", $permission->name)) }}													</span>

												</label>
												@endforeach
												@endforeach

											</div>
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
								</div>
							</div>
							<!--end::Permissions-->
						</div>
						<!--begin::Actions-->
						<div class="text-center pt-15">
							<a href="{{route('admin.roles.index')}}" class="btn btn-danger me-3">Cancel</a>
							<button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
								<span class="indicator-label">Save</span>
								<span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						</div>

						<!--end::Actions-->
					</form>
					<!--end::Form-->


				</div>
			</div>
		</div>
	</div>
</div>
	<!-- Modal -->
	<div class="modal fade" id="users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
		
				<div class="modal-body">
					<table class="table align-middle gs-0 gy-4">
						<thead>
							<tr class="fw-bold text-muted bg-light">
								<th class="ps-4 min-w-300px rounded-start">Name</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>

								<td>
									{{$user->name}}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endsection
	@section('js')
	<script>
		function selectAll() {
			let allInputs = document.querySelectorAll(".permissions");
			let kt_roles_select_all = document.getElementById('kt_roles_select_all');
			if (kt_roles_select_all.checked) {
				allInputs.forEach(item => {
					item.checked = true;
				});
			} else {
				// Loop through each checkbox and set checked to false
				allInputs.forEach(item => {
					item.checked = false;
				});
			}
		}
	</script>
	@endsection