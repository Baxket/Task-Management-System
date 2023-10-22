@extends('dashboard.layouts.app')


@section('styles')

@include('dashboard.includes.datatable_css')

@endsection
@section('content')
    

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item">projects</li>
              <li class="breadcrumb-item active">manage</li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <div class="sticky-top mb-3">
                
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Create A Project</h3>
                  </div>
                  <div class="card-body">
                    <!-- /btn-group -->
                        @if ($errors->any())

                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach  
                            </div>
                        @endif
                            <form action="{{route('admin.projects.store')}}" method="Post">
                                @csrf
                                <div class="input-group">
                                
                                        <input id="new-event" type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Project Name">
                    
                                        <div class="input-group-append">
                                            <button id="add-new-event" type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    
                                <!-- /btn-group -->
                                </div>

                            </form>
                    <!-- /input-group -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >

                        <div class="table-responsive " style="padding: 10px">
                            <table id="dataTable" class="table pt-3">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
    
                                  
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                </tr>
    
                                </tbody>
                            </table>

                        </div>

                    
                    </div>
                    <!-- /.card-body -->
                  </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')

<!-- DataTables  & Plugins -->
@include('dashboard.includes.datatable_js')
<script>
    $(document).ready(function () {
            $('#dataTable').DataTable({
                // order: [[1, 'desc']],
                processing: true,
                serverSide: true,
                // responsive: true,
                searchable: true,
                destroy: true,
                ajax: '{{route('admin.projects.manage')}}',
                dom: "<'row'>l<'/row'>Bfrtip",
                // dom: "<'row'l<'col-sm-12 py-2 col-md-12'Bftrp>>",
                info: true,
                columns: [
                    {"data": "name"},
                    {"data": "created_at"},
                    {"data": "action"},

                  
                ],
                buttons: [
                    {extend: 'colvis', footer:true, orientation: 'landscape'},
                    { extend: 'copyHtml5', footer: true, orientation: 'landscape', pageSize: 'LEGAL' },
                    { extend: 'excelHtml5', footer: true, orientation: 'landscape', pageSize: 'LEGAL' },
                    { extend: 'csvHtml5', footer: true, orientation: 'landscape', pageSize: 'LEGAL' },
                    { extend: 'pdfHtml5', footer: true, orientation: 'landscape', pageSize: 'LEGAL' }
                ],
                //

            });

        });
  </script>
@endsection