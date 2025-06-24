<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Str;

class ProjectController extends Controller
{
    //this method will return all projects
    public function index(){
        $projects = Project::orderBy('created_at', 'DESC')->get();
        return response()->json([
            'status'=>true,
            'data'=>$projects
        ]);
    }

    //this method will insert project details in db
    public function store(Request $request) {
       //return 'test ok';
        $validate = Validator::make($request->all(),[
            'title'=>'required',
            'slug'=>'required|unique:projects,slug',
        ]);

        if($validate->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validate->errors()
            ]);
        }

        $project = new Project();
        $project->title = $request->title;
        // $project->slug = Str::slug($request->slug);
        $project->slug = make_slug($request->slug);
        $project->short_desc = $request->short_desc;
        $project->content = $request->content;
        $project->construction_type = $request->construction_type;
        $project->sector = $request->sector;
        $project->location = $request->location;
        $project->image = $request->image;
        $project->status = $request->status;
        $project->save();

        return response()->json([
            'status'=>true,
            'message'=>'Project Added successfully',
        ]);
    }
 
}