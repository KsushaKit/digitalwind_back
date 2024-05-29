<?php

namespace App\Http\Controllers;

use App\NominationJury;
use Illuminate\Http\Request;

class NominationJuriesController extends Controller
{
    public function index()
    {
        $routes = NominationJury::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = NominationJury::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = NominationJury::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = NominationJury::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = NominationJury::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
}
