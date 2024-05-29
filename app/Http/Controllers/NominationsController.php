<?php

namespace App\Http\Controllers;

use App\Nomination;
use Illuminate\Http\Request;

class NominationsController extends Controller
{
    public function index()
    {
        $routes = Nomination::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = Nomination::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = Nomination::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = Nomination::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Nomination::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
}
