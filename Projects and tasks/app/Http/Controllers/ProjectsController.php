<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

//use App\Mail\ProjectCreated;
use App\Events\ProjectCreated;
class ProjectsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    //
    public function index(){
        
        /*
        cache()->rememberForever('stats',function(){
            return ['lesson'=>1300, 'hours'=>50000,'series'=>100];
        });
        */
        return view('projects.index',[
            'projects' => auth()->user()->projects
        ]);
    }

    public function create(){
        
        return view('projects.create');
    }


    public function show(Project $project){
        abort_if($project->owner_id !== auth()->id(),403);


        return view('projects.show',compact('project'));

    }


    public function edit(Project $project){
        abort_if($project->owner_id !== auth()->id(),403);


        return view('projects.edit',compact('project'));

    }
    public function store()
    {
        
        $attributes = $this->validateProject();

        $project=\App\project::create($attributes + ['owner_id'=>auth()->id()]);

        event(new ProjectCreated($project));

        session()->flash('message','Your project has been created.');

        return redirect('/projects');
    }
 
    
    public function update(Project $project){
        abort_if($project->owner_id !== auth()->id(),403);    
        $project->update($this->validateProject());
        return redirect('/projects');

    }
    public function destroy(Project $project){
        abort_if($project->owner_id !== auth()->id(),403);
        $project->delete();

        return redirect('/projects');
    }

    protected function validateProject(){
        return request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);
    }
}
