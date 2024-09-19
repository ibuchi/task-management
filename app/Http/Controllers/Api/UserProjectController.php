<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'users' => 'required|array',
            'users.*' => 'required|numeric|integer'
        ]);

        $project->users()->attach($validated['users']);

        return Response::api('Users added!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Project $project)
    {
        $validated = $request->validate([
            'users' => 'required|array',
            'users.*' => 'required|numeric|integer'
        ]);

        $project->users()->detach($validated['users']);

        return Response::api('Users removed!');
    }
}
