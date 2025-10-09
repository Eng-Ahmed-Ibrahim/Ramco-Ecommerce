<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('admin.dashboard') }}">
            @if($siteSettings['logos']['site_header_logo'])
            <img alt="Logo" src="{{ asset('storage/'.$siteSettings['logos']['site_header_logo']) }}"
                class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('storage/'.$siteSettings['logos']['site_header_logo']) }}"
                class="h-20px app-sidebar-logo-minimize" />
                @endif 
        </a>
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
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
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">

                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                        </div>
                    </div>
                    <!-- Dashboard -->
                    @can('dashboard-view'   )
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('admin.dashboard') }}">
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
                            <span class="menu-title">Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    {{-- Home page --}}
                    @can('home page-view home page')
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-address-book fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Home Page</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                @can('home page-view home banners')
                                    <div class="menu-item">
                                        <a href=" {{ route('admin.home-banners.index') }}" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Home Banners</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('home page-view sections')
                                    <div class="menu-item">
                                        <a href=" {{ route('admin.sliders.index', ['section' => 'home_sections', 'limit' => 2]) }}"
                                            class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Sections</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('home page-view need help')
                                    <div class="menu-item">
                                        <a href=" {{ route('admin.sliders.index', ['section' => 'need_help']) }}"
                                            class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Need Helpe</span>
                                        </a>
                                    </div>
                                @endcan

                            </div>
                        </div>
                    @endcan
                    @canany(['about page-view sections', 'about page-view background'])
                        {{-- About Page --}}
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-address-book fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title">About Page</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">

                                @can('about page-view background')
                                    <div class="menu-item">
                                        <a href=" {{ route('admin.about.edit') }}" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Background</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('about page-view sections')
                                    <div class="menu-item">
                                        <a href=" {{ route('admin.sliders.index', ['section' => 'about_page', 'limit' => 3]) }}"
                                            class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Sections</span>
                                        </a>
                                    </div>
                                @endcan



                            </div>
                        </div>
                    @endcanany
                    {{-- Settings --}}
                    @canany(['settings-view general', 'settings-view exchange rates', 'settings-view branches', 'settings-view socail media'])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-address-book fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Settings</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('settings-view general')
                            <div class="menu-item">
                                <a href=" {{ route('admin.general') }}" class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title"> General</span>
                                </a>
                            </div>
                            @endcan
                            @can('settings-view exchange rates')
                            <div class="menu-item">
                                <a href=" {{ route('admin.currency.index') }}" class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Exchange Rate</span>
                                </a>
                            </div>
                            @endcan
                            @can('settings-view branches')
                            <div class="menu-item">
                                <a href=" {{ route('admin.branches.index') }}" class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Branches</span>
                                </a>
                            </div>
                            @endcan 
                            @can('settings-view socail media')
                            <div class="menu-item">
                                <a href=" {{ route('admin.social.index') }}" class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Social Media</span>
                                </a>
                            </div>
                            @endcan

                        </div>
                    </div>
                    @endcan
                    {{-- End of Home page --}}
                    <!-- Repairs -->
                    @can('rapairs-view')
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('admin.repair.index') }}">
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
                                <span class="menu-title">Repairs</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endcan
                    <!-- Messages -->
                    @can('messages-view')
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('admin.messages.index') }}">
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
                                <span class="menu-title">Messages</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endcan

                    <!-- UseGuide -->
                    @can('use guides-view')
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('admin.UseGuide.index') }}">
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
                                <span class="menu-title">Use Guide</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endcan

                    <!-- Orders -->
                    @can('orders-view')
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Orders</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('admin.orders.index') }}">
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
                                <span class="menu-title">Orders</span>
                                <span class="badge bg-primary">{{ $totalOrders }}</span>

                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endcan
                    <!-- Products -->
                    @can('products-show')
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Products</span>
                            </div>
                        </div>
                        <div class="menu-item">
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
                    @endcan

                    <!-- Admins & roles -->
                    @canany(['admins-view', 'roles-view'])
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Admins & Roles</span>
                            </div>
                        </div>
                        @can('admins-view')
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.admins.index') }}">
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
                                    <span class="menu-title">Admins</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endcan

                        @can('roles-view')
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.roles.index') }}">
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
                                    <span class="menu-title">Roles</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endcan
                    @endcanany


                    <!--  categories -->
                    @canany(['categories-view', 'sub categories-view'])
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Categories </span>
                        </div>
                    </div>
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
                    @endcanany
                    <!-- Coupons -->
                    @can('coupins-view')
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Coupons</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('admin.coupons.index') }}">
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
                            <span class="menu-title">Coupons</span>
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
