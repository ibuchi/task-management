<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response::api([
            'data' => Project::all(),
            'message' => 'All projects!'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        return Response::api([
            'data' => Project::create($request->validated()),
            'message' => 'Project created!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return Response::api([
            'data' => $project,
            'message' => 'Project!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return Response::api([
            'data' => $project,
            'message' => 'Project updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        Response::api('Project deleted!');
    }
}
