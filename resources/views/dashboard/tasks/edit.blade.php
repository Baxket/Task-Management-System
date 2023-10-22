@extends('dashboard.layouts.app')


@section('styles')

<!-- Select2 -->
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
 <!-- Tempusdominus Bootstrap 4 -->
 <link rel="stylesheet" href="{{asset('vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
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
              <li class="breadcrumb-item">Tasks</li>
              <li class="breadcrumb-item active">Create</li>

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
               <!-- .col -->
            <div class="col-md-12">
              <div class="sticky-top mb-3">
                
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Create A Task</h3>
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
                            <form action="{{route('admin.tasks.update', $task->id)}}" method="Post">
                                @csrf
                                @method('PATCH') 
                                <div class="row">
                                
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Project</label>
                                      <select class="form-control select2" name="project_id" style="width: 100%;">
                                        <option selected disabled value="">select a project</option>
                                        @foreach ($projects as $project)
                                        <option @if(old('project_id', $task->project_id) == $project->id) selected @endif value="{{$project->id}}">{{$project->name}}</option>

                                        @endforeach
                                      </select>
                                    </div>

                                  </div>
                                  
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Task Name</label>
                                      <input type="text" name="name" class="form-control" id="name" value="{{old('name', $task->name)}}" placeholder="Enter name">
                                    </div> 

                                  </div>
                                     
                                    
                                <!-- /btn-group -->
                                </div>

                                <div class="row">
                                
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Date and time:</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"  value="{{old('time',  Carbon\Carbon::parse($task->time)->format('d/m/Y g:i A'))}}" name="time" data-target="#reservationdatetime"/>
                                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div> 

                                  </div>

                                   
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Task Priority</label>
                                      <input type="number" name="priority" class="form-control" id="priority" value="{{old('priority', $task->priority)}}" placeholder="Enter Priority">
                                    </div> 

                                  </div>

                                  
                                     
                                    
                                <!-- /btn-group -->
                                </div>
                                <div class="input-group-append">
                                  <button id="add-new-event" type="submit" class="btn btn-primary">Add</button>
                              </div>

                            </form>
                    <!-- /input-group -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
          
       
          </div>
          <!-- /.row -->

         <!-- /.col -->
       
    
       </div>
       <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')

<!-- Select2 -->
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('vendor/inputmask/jquery.inputmask.min.js')}}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script>
   $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      
      //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    });
    
</script>


@endsection