<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title> --}}

    @stack('head')
    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">

    <link href="{{ asset('admin/assets/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/dist/css/demo.min.css?1692870487"') }} rel="stylesheet" />
    <link href="{{ asset('admin/assets/dist/css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">

    @stack('styles')
    {{-- <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .navbar-vertical .nav-item.active>.nav-link {
            background-color: #007bff !important;
            /* Blue background */
            color: white !important;
            border-radius: 4px;
            /* Optional: Add a slight rounding */
        }

        .navbar-vertical .nav-item.active>.nav-link .nav-link-icon svg {
            fill: white !important;
            /* Fill the icon with white */
            color: white !important;
            /* Also set the stroke color to white */
        }

        .navbar-vertical .nav-item.dropdown.active>.nav-link {
            background-color: #007bff !important;
            /* Blue background for the dropdown parent */
            color: white !important;
            border-radius: 4px;
        }

        .navbar-vertical .nav-item.dropdown.active>.nav-link .nav-link-icon svg {
            fill: white !important;
            color: white !important;
        }

        .navbar-vertical .dropdown-menu .dropdown-item.active {
            background-color: #0056b3 !important;
            /* Darker blue for active dropdown item */
            color: white !important;
        }

        .navbar-vertical .dropdown-menu .dropdown-item.active svg {
            fill: white !important;
            color: white !important;
        }
    </style> --}}
</head>

<body>
    <div class="page">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        
        <!-- Navbar -->
        @include('admin.layouts.header')
        
        <div class="page-wrapper">
            
            @yield('content')
            
            <!-- Footer -->
            @include('admin.layouts.footer')
            
        </div>
    </div>
    
    <!--Models -->
    
    <!--Lib -->
    @stack('scripts')
    @yield('scripts')
    <!-- Tabler Core -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{ asset('admin/assets/dist/js/demo-theme.min.js?1692870487') }}"></script> 
    <script src="{{ asset('admin/assets/dist/js/tabler.min.js?1692870487') }}" defer></script>
     <script src="{{ asset('admin/assets/dist/js/demo.min.js?1692870487') }}" defer></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    

</body>

</html>
