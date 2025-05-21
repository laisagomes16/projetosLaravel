<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectFormRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store(ProjectFormRequest $request)
    {
        $projeto = Project::create($request->validated());
        return response()->json($projeto, 201);
    }

    public function show($id)
    {
        return Project::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $projeto = Project::findOrFail($id);
        $projeto->update($request->all());
        return $projeto;
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return response()->noContent();
    }
}
