<?php

namespace App\Http\Controllers;

use App\Tour;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    public function index()
    {
        $routes = Tour::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = Tour::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = Tour::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = Tour::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Tour::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
}
