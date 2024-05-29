<?php

namespace App\Http\Controllers;

use App\Round;
use Illuminate\Http\Request;

class RoundsController extends Controller
{
    public function index()
    {
        $routes = Round::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = Round::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = Round::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = Round::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Round::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
}
