<!DOCTYPE html>
<html lang="en">
 
@include('dashboard.includes.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  @include('dashboard.includes.navbar')

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  

  @include('dashboard.includes.sidebar')




  <!-- Content Wrapper. Contains page content -->


      @yield('content') 
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
  @include('dashboard.includes.scripts')
</body>
</html>
