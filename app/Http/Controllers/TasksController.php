<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;


class TasksController extends Controller
{
    //

    public function index(Request $request)
    {

        //get projects
        $projects = Project::where('entered_by', auth()->id())->get();

        //display projects on datatable using ajax
        if ($request->ajax()){
            //project is equal to the filter value
            $project = $request->get('filter');

           if($project == "All" || !$project)
           {
            
                //if project filter is equal to all get all
                $tasks = Task::query()->with('project')->orderBy('priority')->where('entered_by', auth()->id())
                ->get();
           }
           else
           {
                //get tasks of the project filter

                $tasks = Task::query()->with('project')->where('project_id', $project)->where('entered_by', auth()->id())
                ->orderBy('priority')
                ->get();
           }

            try {
                return Datatables::of($tasks)
                    ->addIndexColumn()
                    ->editColumn('time', function ($row)
                    {
 
                         //display date in a sentence format
                         return Carbon::parse($row->time)->format('d F Y g:i A');
                    })
                   ->editColumn('created_at', function ($row)
                   {

                        //display date in a sentence format
                        return Carbon::parse($row->created_at)->format('d F Y g:i A');
                   })
                  
                    ->addColumn('action', function ($row) {
                      
                        $id = Crypt::encrypt($row->id);
                        return '<div style="display:inline-flex;">' .
                            '<a href="'.route('admin.tasks.edit_page', $id).'" class="btn bg-warning mr-2 text-white shadow btn-sm datatable_btn" title="Edit"><span class="fa fa-edit"></span></a>' .
                            '<a href="#" class="btn bg-danger mr-2 text-white shadow btn-sm datatable_btn" title="Delete"><span class="fa fa-trash"></span></a>' .

                            '</div>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                return [];
            }
        }
        return view('dashboard.tasks.index', compact('projects'));
    }


     //store tasks with the help of an observer class function
     public function store(Request $request)
     {
         
 
         try{
             //validate
             $data = $request->validate([
                 'name' => 'required',
                 'project_id' => 'required',
                 'time' => 'required',
                 'priority' => 'nullable'
             ]);
             
 

             //convert it to the right format
             $data['time'] = Carbon::createFromFormat('d/m/Y g:i A', $request->time);

             //enter the user creating the project
             $data['entered_by'] = auth()->user()->id;


             //Observe is ran before ... located at the Observers folder
             Task::create($data);
            
             return redirect()->back()->with('success', "Task was created successfully");
 
         }
         catch(Exception $e)
         {
             return redirect()->back()->withErrors($e->getMessage())->withInput();
 
         }
     }


     public function edit_page($id)
     {
        //get projects
        $projects = Project::where('entered_by', auth()->id())->get();

        //decrypt id
        $id = Crypt::decrypt($id);

        $task = Task::findorfail($id);

        return view('dashboard.tasks.edit', compact('task','projects'));
     }

     public function update(Request $request, Task $task)
     {


        $data = $request->validate(
            [
                'name' => 'required',
                'project_id' => 'required',
                'time' => 'required',
                'priority' => 'nullable'
            ]
            );

               //convert it to the right format
               $data['time'] = Carbon::createFromFormat('d/m/Y g:i A', $request->time);

            $task->update($data);

            return redirect()->route('admin.tasks.create')->with('success', "Task was updated successfully");

     }


     public function sort_index(Request $request)
     {
 

        $filter = $request->filter;

        if($filter)
        {
            $tasks = Task::where('entered_by', auth()->id())->where('project_id', $filter)->orderBy('priority')->get();
        }
        else{
            $tasks = Null;
        }
         //get projects
         $projects = Project::where('entered_by', auth()->id())->get();
 
        
         return view('dashboard.tasks.sort', compact('projects', 'tasks', 'filter'));
     }

     public function resort(Request $request)
     {

        $request->validate([
            'ids'         => 'required|array',
            'ids.*'       => 'integer',
            'project_id' => 'required|integer|exists:projects,id',
        ]);


        foreach ($request->ids as $index => $id) {
            Task::where('entered_by', auth()->id())
                ->where("project_id", $request->project_id)
                ->where('id', $id)
                ->update([
                    'priority' => $index + 1
                ]);
        }
   
        $priorities = Project::find($request->project_id)
            ->tasks()
            ->pluck('priority', 'id');

        return response(compact('priorities'), Response::HTTP_OK);
     }
    
}
