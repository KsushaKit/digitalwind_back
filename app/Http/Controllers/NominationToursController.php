<?php

namespace App\Http\Controllers;

use App\NominationTour;
use Illuminate\Http\Request;

class NominationToursController extends Controller
{
    public function index()
    {
        $routes = NominationTour::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = NominationTour::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = NominationTour::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = NominationTour::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = NominationTour::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
}
