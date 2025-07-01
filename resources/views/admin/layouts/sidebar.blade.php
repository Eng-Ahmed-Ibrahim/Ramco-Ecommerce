<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
	<!--begin::Logo-->
	<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
		<!--begin::Logo image-->
		<a href="{{route('admin.dashboard')}}">
			<img alt="Logo" src="/{{$shared_data['website_logo']}}" class="h-25px app-sidebar-logo-default" />
			<img alt="Logo" src="/{{$shared_data['website_logo']}}" class="h-20px app-sidebar-logo-minimize" />
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
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Home')}}</span>
						</div>
					</div>
					<!-- Dashboard -->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="{{route('admin.dashboard')}}">
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
							<span class="menu-title">{{__('messages.Dashboard')}}</span>
						</a>
						<!--end:Menu link-->
					</div>

					@can('show category')
					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Categories')}}</span>
						</div>
					</div>

					<!-- Categories -->
					<div class="menu-item">
						<a class="menu-link {{ request()->path() =='admin/categories' ? 'active' : ' ' }}" href="{{route('admin.categories')}}">
							<span class="menu-icon">
								<i class="ki-duotone ki-abstract-25 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.categories')}} </span>
						</a>
					</div>
					@endcan


					<!-- Services -->
					@if(Auth::user()->can('show feature') || Auth::user()->can('show Property'))
					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Services')}}</span>
						</div>
					</div>
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<i class="ki-duotone ki-bank fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.Services')}}</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							@can('show Property')
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link {{ request()->path() =='admin/services' ? 'active' : ' ' }}" href="{{ route('admin.services.index') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Services_List')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
							@endcan
							@can('show feature')
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link {{ request()->path() =='admin/features' ? 'active' : ' ' }}" href="{{ route('admin.features') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Features')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
							@endcan
							@can('show_reviews')
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link {{ request()->path() =='admin/reviews' ? 'active' : ' ' }}" href="{{ route('admin.reviews') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Reviews')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
							@endcan
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link {{ request()->path() =='admin/cities' ? 'active' : ' ' }}" href="{{ route('admin.cities') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Cities')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
						</div>
						<!--end:Menu sub-->
					</div>
					@endif
					<!-- Packages -->


					@if(auth()->user()->can('Show Packages') || auth()->user()->can('show_subscribers') || auth()->user()->can('show_features'))
					
					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Packages')}}</span>
						</div>
					</div>
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<i class="fa-solid fa-box"></i>
							</span>
							<span class="menu-title">{{__('messages.Packages')}}</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							@can('Show Packages')
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link  {{ request()->path() =='admin/packages' ? 'active' : ' ' }}" href="{{ route('admin.packages') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Packages')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
							@endcan
							@can('show_features')
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link  {{ request()->path() =='admin/packages/features' ? 'active' : ' ' }}" href="{{ route('admin.packages.features') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Features')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
							@endcan
							@can('show_subscribers')

							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link  {{ request()->path() =='admin/packages/subscribers' ? 'active' : ' ' }}" href="{{ route('admin.packages.subscribers') }}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Subscribers')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
							@endcan

						</div>
						<!--end:Menu sub-->
					</div>
					@endcan



					@can('show booking')
					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Orders')}}</span>
						</div>
					</div>
					<!-- Booking -->
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<!--begin:Menu link-->
						<span class="menu-link {{ request()->path() =='admin/booking' ? 'active' : ' ' }}">
							<span class="menu-icon">
								<i class="fa-solid fa-bookmark"></i>
							</span>
							<span class="menu-title ">{{__('messages.Booking')}}</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link " href="/admin/booking">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.All')}}</span>
									<span class="menu-badge">
										<span class="badge badge-primary">{{$shared_data['total_booking_all']}}</span>
									</span>
								</a>
								<!--end:Menu link-->
							</div>
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="/admin/booking?booking_status=1">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Booking_pending')}}</span>
									<span class="menu-badge">
										<span class="badge badge-warning">{{$shared_data['total_booking_pending']}}</span>
									</span>
								</a>
								<!--end:Menu link-->
							</div>
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="/admin/booking?booking_status=3">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Booking_accepted')}}</span>
									<span class="menu-badge">
										<span class="badge badge-success">{{$shared_data['total_booking_accpet']}}</span>
									</span>
								</a>
								<!--end:Menu link-->
							</div>
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="/admin/booking?booking_status=4">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Booking_rejected')}}</span>
									<span class="menu-badge">
										<span class="badge badge-danger">{{$shared_data['total_booking_rejected']}}</span>
									</span>
								</a>
								<!--end:Menu link-->
							</div>
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="/admin/booking?booking_status=5">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Cancelled')}}</span>
									<span class="menu-badge">
										<span class="badge badge-danger">{{$shared_data['total_booking_cancelled']}}</span>
									</span>
								</a>
								<!--end:Menu link-->
							</div>
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="/admin/booking?booking_status=6">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Overview_time')}}</span>
									<span class="menu-badge">
										<span class="badge badge-danger">{{$shared_data['total_booking_overview_time']}}</span>
									</span>
								</a>
								<!--end:Menu link-->
							</div>
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="/admin/booking?booking_status=7">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Overview_time_payment')}}</span>
									<span class="menu-badge">
										<span class="badge badge-danger">{{$shared_data['total_booking_overview_payment_time']}}</span>
									</span>
								</a>
								<!--end:Menu link-->
							</div>
						</div>
						<!--end:Menu sub-->
					</div>
					@endcan

					@can('show coupon')

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Coupon')}}</span>
						</div>
					</div>
					<!-- Coupons -->
					<div class="menu-item">
						<a class="menu-link {{ request()->path() =='admin/coupons' ? 'active' : ' ' }}" href="{{route('admin.coupons')}}">
							<span class="menu-icon">
								<i class="ki-duotone ki-credit-cart fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.Coupons')}} </span>
						</a>
					</div>
					@endcan
					@can('show reports')

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Reports')}}</span>
						</div>
					</div>
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<i class="ki-duotone ki-abstract-41 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.Reports')}}</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link {{ request()->path() =='admin/reports/payment-reports' ? 'active' : ' ' }}" href="{{route('admin.payment_reports')}}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Payment_reports')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					@endcan

					@if(auth()->user()->can('show payment method') || auth()->user()->can('show payments list'))
					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Payment')}}</span>
						</div>
					</div>
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<i class="ki-duotone ki-address-book fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.Payment')}}</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<!-- @can('show payments list')
								<a class="menu-link" href="{{route('admin.payment_list')}}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Payment_list')}}</span>
								</a>
								@endcan -->
								@can('show payment method')
								<a class="menu-link" href="{{route('admin.payment_methods')}}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Payment_methods')}}</span>
								</a>
								@endcan
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					@endif
					@can('show earning')

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Earning')}}</span>
						</div>
					</div>
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<i class="ki-duotone ki-bucket fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.Earning')}}</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="{{route('admin.earning')}}">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">{{__('messages.Earning_list')}}</span>
								</a>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					@endcan

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Users')}}</span>
						</div>
					</div>
					@can('show roles')
					<div class="menu-item">
						<a class="menu-link" href="{{route('admin.roles.index')}}">
							<span class="menu-icon">
								<i class="fa-solid fa-hand-sparkles"></i>
							</span>
							<span class="menu-title">{{__('messages.Roles')}} </span>
						</a>
					</div>
					@endcan
					@can('Show Only Assigned Providers')
					<div class="menu-item">
						<a class="menu-link" href="{{route('admin.assign_users')}}">
							<span class="menu-icon">
								<i class="fa-solid fa-list-check"></i>
							</span>
							<span class="menu-title">{{__('messages.Assign')}} </span>
						</a>
					</div>
					@endcan
					@can('show admins')
					<div class="menu-item">
						<a class="menu-link" href="/admin/users?role=admin">
							<span class="menu-icon">
								<i class="fa-solid fa-user-tie"></i>
							</span>
							<span class="menu-title">{{__('messages.Admins')}} </span>
							<span class="menu-badge">
								<span class="badge badge-info">{{$shared_data['total_admin_user']}}</span>
							</span>
						</a>
					</div>
					@endcan
					@can('show providers')
					<div class="menu-item">
						<a class="menu-link" href="/admin/users?role=provider">
							<span class="menu-icon">
								<i class="ki-duotone ki-address-book fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">{{ auth()->user()->power=='employee' ? __('messages.Assigned_Providers'): __('messages.Providers')}} </span>
							<span class="menu-badge">
								<span class="badge badge-info">{{$shared_data['total_provider_user']}}</span>
							</span>
						</a>
					</div>
					@endcan
					@can('show customers')
					<div class="menu-item">
						<a class="menu-link" href="/admin/users?role=customer">
							<span class="menu-icon">
								<i class="ki-duotone ki-address-book fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.Customers')}} </span>
							<span class="menu-badge">
								<span class="badge badge-info">{{$shared_data['total_customer_user']}}</span>
							</span>
						</a>
					</div>
					@endcan
					@can('Show Employess')
					<div class="menu-item">
						<a class="menu-link" href="/admin/users?role=employee">
							<span class="menu-icon">
							<i class="fa-solid fa-users"></i>
							</span>
							<span class="menu-title">{{__('messages.Employees')}} </span>
							<span class="menu-badge">
								<span class="badge badge-info">{{$shared_data['total_employee_user']}}</span>
							</span>
						</a>
					</div>
					@endcan

					@can('show support messages')
					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.Support')}}</span>
						</div>
					</div>
					<div class="menu-item">
						<a class="menu-link" href="{{route('admin.suport.index')}}">
							<span class="menu-icon">
								<i class="ki-duotone ki-abstract-25 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.Support')}} </span> <span class="menu-badge">
								<span class="badge badge-success">{{$shared_data['not_seen_count']}}</span>
							</span>
						</a>
					</div>
					@endcan
					@can('show settings')

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">{{__('messages.BUSINESS_SECTION')}}</span>
						</div>
					</div>

					<div class="menu-item">
						<a class="menu-link" href="{{route('admin.settings')}}">
							<span class="menu-icon">
								<i class="ki-duotone ki-abstract-28 fs-2">
									<span class="path1"></span>
									<span class="path2"></span>
									<span class="path3"></span>
									<span class="path4"></span>
									<span class="path5"></span>
									<span class="path6"></span>
								</i>
							</span>
							<span class="menu-title">{{__('messages.Settings')}} </span>
						</a>
					</div>
					@endcan
					@can('show withdrawal requests')

					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="{{route('admin.settings.withdrawal_requests')}}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">{{__('messages.Withdrawal_requests')}}</span>
							<span class="menu-badge">
								<span class="badge badge-success">{{$shared_data['withdrawal_requests']}}</span>
							</span>
						</a>
						<!--end:Menu link-->
					</div>
					@endcan
					@can('deposit requests')

					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="{{route('admin.transcations.index')}}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">{{__('messages.Deposit_requests')}}</span>
							<span class="menu-badge">
								<span class="badge badge-success">{{$shared_data['total_deposit_requests']}}</span>
							</span>
						</a>
						<!--end:Menu link-->
					</div>
					@endcan



				</div>
				<!--end::Menu-->
			</div>
			<!--end::Scroll wrapper-->
		</div>
		<!--end::Menu wrapper-->
	</div>
	<!--end::sidebar menu-->

</div>