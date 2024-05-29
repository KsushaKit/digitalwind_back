<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $routes = User::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = User::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = User::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = User::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = User::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
}
