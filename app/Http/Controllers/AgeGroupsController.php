<?php

namespace App\Http\Controllers;

use App\AgeGroup;
use Illuminate\Http\Request;

class AgeGroupsController extends Controller
{
    public function index()
    {
        $routes = AgeGroup::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = AgeGroup::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = AgeGroup::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = AgeGroup::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = AgeGroup::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
}
