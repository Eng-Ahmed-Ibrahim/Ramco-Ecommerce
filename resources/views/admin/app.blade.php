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
        {{-- <link rel="shortcut icon" href="/{{ $shared_data['website_logo'] }}" /> --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

        <!-- ltr -->
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}?v={{ time() }}" rel="stylesheet"
            type="text/css" />
        <link rel="icon" href="{{ asset('storage/'.$siteSettings['logos']['site_favicon']) }}">
        @yield('css')

        <style>
            #kt_app_sidebar_toggle {
                background: white !important;
            }

            [data-kt-app-layout=dark-sidebar] .app-sidebar .menu>.menu-item.hover:not(.here)>.menu-link:not(.disabled):not(.active):not(.here),
            [data-kt-app-layout=dark-sidebar] .app-sidebar .menu>.menu-item:not(.here) .menu-link:hover:not(.disabled):not(.active):not(.here) {
                transition: color 0.2s ease;
                color: white;
            }

            tr,
            th,
            td {
                text-align: center
            }

            textarea {
                resize: none;
            }

            .btn-primary {

                background-color: #1F1F1F !important;

                color: #fff !important;

            }

            .btn-check:checked+.btn.btn-primary,
            .btn-check:active+.btn.btn-primary,
            .btn.btn-primary:focus:not(.btn-active),
            .btn.btn-primary:hover:not(.btn-active),
            .btn.btn-primary:active:not(.btn-active),
            .btn.btn-primary.active,
            .btn.btn-primary.show,
            .show>.btn.btn-primary:hover {

                background-color: #1F1F1F !important;

                color: #fff !important;

            }

            .card-body {
                overflow-x: scroll;
            }


            html body .btn-check:checked+.btn.btn-danger,
            .btn-check:active+.btn.btn-danger,
            .btn.btn-danger:focus:not(.btn-active),
            .btn.btn-danger:hover:not(.btn-active),
            .btn.btn-danger:active:not(.btn-active),
            .btn.btn-danger.active,
            .btn.btn-danger.show,
            .show>.btn.btn-danger {
                color: var(--bs-danger-inverse);
                border-color: var(--bs-danger-active);
                background-color: #f1416c !important;
            }

            @media (max-width: 425px) {
                table {
                    width: max-content !important;
                }
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
                @include('admin.layouts.sidebar')
                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        @yield('content')
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

            @if (isset($errors) && $errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        </script>

        @yield('js')


        <script>
            $('#order-status').on('change', function() {
                let status = $(this).val();
                let orderId = $(this).data('order-id');

                $.ajax({
                    url: '{{ route('admin.orders.updateStatus') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                        order_id: orderId
                    },
                    success: function(response) {
                        toastr.success('Order status updated successfully.');
                    },
                    error: function(xhr) {
                        let message = xhr.responseJSON?.message ?? 'Something went wrong';
                        toastr.error(message)
                    }
                });
            });
        </script>
    </body>

    </html>
