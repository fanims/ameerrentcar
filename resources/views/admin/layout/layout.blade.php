<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
    @include('admin.layout.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
 

 @include('admin.layout.navbar')

  <!-- Main Sidebar Container -->
  @include('admin.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->
  @include('admin.layout.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('admin.layout.script')
</body>
</html>
