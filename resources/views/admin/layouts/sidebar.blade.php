<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
	<!--begin::Logo-->
	<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
		<!--begin::Logo image-->
		<a href="/">
			<img alt="Logo" src="logo.png" class="h-25px app-sidebar-logo-default" />
			<img alt="Logo" src="logo.png" class="h-20px app-sidebar-logo-minimize" />
		</a>
		<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
			<i class="ki-duotone ki-black-left-line fs-3 rotate-180">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Sidebar toggle-->
	</div>
	<!--end::Logo-->
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
			<div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
				<div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Home</span>
						</div>
					</div>
					<!-- Dashboard -->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/">
							<span class="menu-icon">
								<i class="ki-duotone ki-element-11 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">Dashboaed</span>
						</a>
						<!--end:Menu link-->
					</div>

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Categories</span>
						</div>
					</div>
					<!-- Dashboard -->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="{{ route('admin.categories.index') }}">
							<span class="menu-icon">
								<i class="ki-duotone ki-element-11 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">Categories</span>
						</a>
						<!--end:Menu link-->
					</div>

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Sub Categories</span>
						</div>
					</div>
					<!-- Dashboard -->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="{{ route('admin.sub_category.index') }}">
							<span class="menu-icon">
								<i class="ki-duotone ki-element-11 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">Sub Categories</span>
						</a>
						<!--end:Menu link-->
					</div>

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Products</span>
						</div>
					</div>
					<!-- Dashboard -->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="{{ route('admin.products.index') }}">
							<span class="menu-icon">
								<i class="ki-duotone ki-element-11 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">Products</span>
						</a>
						<!--end:Menu link-->
					</div>


				</div>
				<!--end::Menu-->
			</div>
			<!--end::Scroll wrapper-->
		</div>
		<!--end::Menu wrapper-->
	</div>
	<!--end::sidebar menu-->

</div>
