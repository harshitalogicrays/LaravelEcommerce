<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('/admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('/admin/vendors/base/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('/admin/css/style.css')}}">
  <link rel="shortcut icon" href="{{asset('/admin/images/favicon.png')}}" />

    @livewireStyles
</head>
<body>
    <div class="container-scroller">
            @include('admin.includes.navbar')
    <div class="container-fluid page-body-wrapper"> 
            @include('admin.includes.sidebar')  
        <div class="main-panel">
        <div class="content-wrapper">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        </div>
     </div>
    </div>
 <!-- plugins:js -->
 <script src="{{asset('/admin/vendors/base/vendor.bundle.base.js')}}"></script>
 <!-- endinject -->
 <!-- Plugin js for this page-->
 <script src="{{asset('/admin/vendors/chart.js/Chart.min.js')}}"></script>
 <script src="{{asset('/admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
 <script src="{{asset('/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
 <!-- End plugin js for this page-->
 <!-- inject:js -->
 <script src="{{asset('/admin/js/off-canvas.js')}}"></script>
 <script src="{{asset('/admin/js/hoverable-collapse.js')}}"></script>
 <script src="{{asset('/admin/js/template.js')}}"></script>
 <!-- endinject -->
 <!-- Custom js for this page-->
 <script src="{{asset('/admin/js/dashboard.js')}}"></script>
 <script src="{{asset('/admin/js/data-table.js')}}"></script>
 <script src="{{asset('/admin/js/jquery.dataTables.js')}}"></script>
 <script src="{{asset('/admin/js/dataTables.bootstrap4.js')}}"></script>
 <!-- End custom js for this page-->

 <script src="{{asset('/admin/js/jquery.cookie.js')}}" type="text/javascript"></script>

    @livewireScripts
</body>
</html>
