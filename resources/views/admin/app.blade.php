    <!DOCTYPE html>
    <html lang="en">

    <head>
        <base href="../" />
        <title>@yield('title')</title>
        <meta charset="utf-8" />
        <meta name="description"
            content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
        <meta name="keywords"
            content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title"
            content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
        <meta property="og:url" content="https://keenthemes.com/metronic" />
        <meta property="og:site_name" content="Keenthemes | Metronic" />
        <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
        <link rel="shortcut icon" href="/{{ $shared_data['website_logo'] }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

        <!-- ltr -->
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}?v={{ time() }}" rel="stylesheet"
            type="text/css" />
        @yield('css')

        <style>
            body {
                overflow-x: hidden;
            }

            .card {
                background: transparent !important;
            }

            .select2-container .select2-selection--single .select2-selection__clear {
                background-color: transparent;
                border: none;
                font-size: 1em;
                position: absolute;
                top: 50%;
                left: 3px;
            }

            html[data-bs-theme="dark"] .modal-content {
                background-color: #1C1C1C !important;
                color: white;
            }

            html[data-bs-theme="dark"] #kt_app_header_container {
                background-color: #1C1C1C !important;
                color: white !important;
                /* Adjust text color for dark background */
            }

            html[data-bs-theme="light"] #kt_app_header_container {
                background-color: white !important;
                color: black !important;
                /* Adjust text color for dark background */
            }

            html[data-bs-theme="dark"] .form-control {
                background-color: #1c1c1c !important;
                color: white;
                /* Adjust text color for dark background */
                border: 1px solid var(--bs-gray-300) !important;
            }

            html[data-bs-theme="dark"] #calendar {
                background-color: #1c1c1c !important;
                color: white;
                /* Adjust text color for dark background */
            }

            .card-body {
                width: 100%;
                overflow-x: scroll;
            }

            html {
                overflow-x: hidden;
            }

            .pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 5px;
                margin-top: 20px;
            }

            .pagination-link {
                display: inline-block;
                padding: 10px 15px;
                text-decoration: none;
                color: #333;
                border: 1px solid #ddd;
                border-radius: 4px;
                transition: background-color 0.3s, color 0.3s;
            }

            .pagination-link:hover {
                background-color: #f0f0f0;
                color: #333;
            }

            .pagination-link.active {
                background-color: #007bff;
                color: white;
                border-color: #007bff;
            }

            .pagination-link.disabled {
                color: #ccc;
                cursor: not-allowed;
            }

            .nav-line-tabs.nav-line-tabs-2x .nav-item .nav-link.active,
            .nav-line-tabs.nav-line-tabs-2x .nav-item.show .nav-link,
            .nav-line-tabs.nav-line-tabs-2x .nav-item .nav-link:hover:not(.disabled) {
                border-bottom-width: 2px;
                padding: 10px !important;
            }

            html[data-bs-theme="dark"] .breadcrumb {
                background: #1c1c1c !important;
                color: white !important;
                padding: 5px;
            }

            html[data-bs-theme="light"] .breadcrumb {
                background: #ffffff !important;
                color: black !important;
                padding: 5px;
            }

            .form-control::placeholder {
                font-size: 13px;
            }


            .breadcrumb {
                background-color: #5C5BE5 !important;
                color: white !important;
            }

            html[data-bs-theme="dark"] .card {
                border: none;
                padding: 0;
            }

            td,
            th {
                text-align: center !important;
            }

            .avaliable-span {
                position: absolute;
                top: 1;
                z-index: 9;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                font-weight: bold;
                border: 1px solid #8080802b;
            }

            html[data-bs-theme="dark"] .avaliable-span {
                border: 1px solid;
            }

            html[data-bs-theme="dark"] .card-body,
            .avaliable-span {
                background: #1c1c1c !important;
                color: white !important;
            }

            html[data-bs-theme="light"] .card-body,
            .avaliable-span {
                background: #FFFFFF !important;
                color: black !important;
            }
        </style>

    </head>



    <body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
        data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
        data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
        data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                @include('admin.layouts.header')
                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    @include('admin.layouts.sidebar')
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        @yield('content')
                        @include('admin.layouts.reminder')
                    </div>
                </div>
            </div>
        </div>



        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}?v={{ time() }}"></script>
        <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
        <script src="https://kit.fontawesome.com/9a149c0b80.js" crossorigin="anonymous"></script>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000",
                "positionClass": "toast-top-right"
            };

            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if (session('info'))
                toastr.info("{{ session('info') }}");
            @endif

            @if (session('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        </script>

        @yield('js')



    </body>

    </html>
