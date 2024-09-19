<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response::api([
            'data' => Team::all(),
            'message' => 'All teams!'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        return Response::api([
            'data' => Team::create($request->validated()),
            'message' => 'Team created!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return Response::api([
            'data' => $team,
            'message' => 'Team!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->validated());

        return Response::api([
            'data' => $team,
            'message' => 'Team updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();

        Response::api('Team deleted!');
    }
}
