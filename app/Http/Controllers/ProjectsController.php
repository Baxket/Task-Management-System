<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;


class ProjectsController extends Controller
{
    //

    public function index(Request $request)
    {

        //display projects on datatable using ajax
        if ($request->ajax()){
            $projects = Project::query()->where('entered_by', auth()->id())->get();
            try {
                return Datatables::of($projects)
                    ->addIndexColumn()
   
                   ->editColumn('created_at', function ($row)
                   {

                        //display date in a sentence format
                        return Carbon::parse($row->created_at)->format('d F Y g:i A');
                   })
                    ->addColumn('action', function ($row) {
                      
                        return '<div style="display:inline-flex;">' .
                            '<a href="#" class="btn bg-warning mr-2 text-white shadow btn-sm datatable_btn" title="Edit"><span class="fa fa-edit"></span></a>' .
                            '<a href="#" class="btn bg-danger mr-2 text-white shadow btn-sm datatable_btn" title="Delete"><span class="fa fa-trash"></span></a>' .

                            '</div>';
                    })
                    ->rawColumns(['action', 'template'])
                    ->make(true);
            } catch (\Exception $e) {
                return [];
            }
        }
        return view('dashboard.projects.index');
    }


    //store poject function
    public function store(Request $request)
    {
        

        try{
            //validate
            $data = $request->validate([
                'name' => 'required'
            ]);
            //enter the user creating the project

            $data['entered_by'] = auth()->user()->id;
            Project::create($data);
           
            return redirect()->back()->with('success', "Project was created successfully");

        }
        catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage())->withInput();

        }
    }
}
