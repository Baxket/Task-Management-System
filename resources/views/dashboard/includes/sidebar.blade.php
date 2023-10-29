 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      
        <div class="info justify-content-center">

          <h4 style="color: #ffff">{{auth()->user()->name}}</h4>
          <a href="{{ route('logout') }}" class="btn btn-block btn-default">Logout</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


          <!--Home Page -->
          <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link @if(str_contains(url()->current(), 'admin/home')) active  @endif">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Home
            </p>
          </a>
        </li>
             
          <li class="nav-item @if(str_contains(url()->current(), 'admin/projects')) menu-open  @endif">
            <a href="#" class="nav-link @if(str_contains(url()->current(), 'admin/projects')) active  @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Projects
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("admin.projects.manage")}}" class="nav-link @if(str_contains(url()->current(), 'admin/projects/manage')) active  @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Projects</p>
                </a>
              </li>
            
            </ul>
          </li>

          <li class="nav-item @if(str_contains(url()->current(), 'admin/tasks')) menu-open  @endif">
            <a href="#" class="nav-link @if(str_contains(url()->current(), 'admin/tasks')) active  @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tasks
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("admin.tasks.create")}}" class="nav-link @if(str_contains(url()->current(), 'admin/tasks/index')) active  @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Tasks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("admin.tasks.sort_index")}}" class="nav-link @if(str_contains(url()->current(), 'admin/tasks/sort')) active  @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sort Tasks</p>
                </a>
              </li>
            
            </ul>
            
          </li>
       
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>