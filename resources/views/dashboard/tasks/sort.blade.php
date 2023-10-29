@extends('dashboard.layouts.app')


@section('styles')

<!-- Select2 -->
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
 <!-- Tempusdominus Bootstrap 4 -->
 <link rel="stylesheet" href="{{asset('vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
 <style>
  #list-group { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #list-group li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #list-group li span { position: absolute; margin-left: -1.3em; }
  </style>
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
              <li class="breadcrumb-item active">Sort</li>

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
                    <h3 class="card-title">Select A Program</h3>
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
                            <form action="{{route('admin.tasks.sort_index')}}" method="GET">
                                @csrf
                                <div class="row">
                                
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <label>Project</label>
                                      <select class="form-control select2" name="filter" style="width: 100%;">
                                        <option selected disabled value="">select a project</option>
                                        @foreach ($projects as $project)
                                        <option @if($filter == $project->id) selected @endif value="{{$project->id}}">{{$project->name}}</option>

                                        @endforeach
                                      </select>
                                    </div>

                                  </div>
                                  
                                    
                                  
                                  
                                  
                                  <!-- /btn-group -->
                                </div>
                                <div class="input-group-append">
                                   <button id="add-new-event" type="submit" class="btn btn-primary">Fetch Tasks</button>
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

        @if($tasks)
          <div class="row">
                <!-- .col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">All Tasks</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
                      <h3 class="card-title">Sort</h3>

                      <div class="col-6 mx-auto">
                        
                        <ul data-id="{{$filter}}" id="sortable-list" class="list-group list-group-sortable">
                          @foreach ($tasks as $task)
                          <li class="list-group-item mt-2" style="    border: 1px solid rgba(0,0,0,.125);" data-id="{{$task->id}}">{{$task->name}} <span style="margin-left:20px;" id="priority"> #{{$task->priority}}</span></li>
  
                          @endforeach
  
                        </ul>

                      </div>

                    
                    
                    </div>
                    <!-- /.card-body -->
                </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
       
    
          </div>
        @endif
       <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')

<!-- Select2 -->
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



@if($filter)


<script>
  $(function () {
      $("#sortable-list").sortable({
          update: function (event, ui) {
              var tasks = $(this).sortable('toArray', { attribute: 'data-id' });
              var ids = $.grep(tasks, (task) => task !== "");


        let _token = $('meta[name="csrf-token"]').attr('content');


         $.post('{{ route('admin.tasks.resort') }}', {
                _token,
                ids,
                project_id: {{$filter}}
            })
            .done(function (response) {
              $('#sortable-list').children('.list-group-item').each(function (index, task) {
                    $(task).children('#priority').text('#'+response.priorities[$(task).data('id')])
                });
            })
            .fail(function (response) {
                alert('Error occured while sending reorder request');
            });
          }
      });
      $("#sortable-list").disableSelection();
  });
</script>


@endif
@endsection
