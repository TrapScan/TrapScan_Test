<?php

namespace App\Http\Controllers;

use App\Models\Project;
use http\Url;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectsController extends Controller
{
    public function projects(Request $request){
        return Inertia::render('UserProjects',[
            'projects' => $request->user()->projectsAll()->get(),
            'projects_all' => Project::orderBy('name')->get()
        ]);
    }
    public function view(Request $request){
        $user_pr = \Auth::user()->projectsAll()->get();
        return Inertia::render('ViewProject',[
            'project' => Project::whereId($request->id)->first(),
            'back'=> Url()->previous(),
            'user_in_pr'=>($user_pr->where('id',$request->id)->count() == 0 ? false : true),
            'user_in_pr_data'=>$user_pr->where('id',$request->id)->first(),
            'coordinator'=>($user_pr->where('id',$request->id)->first() != null ? \Auth::user()->isCoordinatorOf($user_pr->where('id',$request->id)->first()) : false)
        ]);
    }
}
