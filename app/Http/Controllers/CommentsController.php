<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function index()
    {
        $routes = Comment::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = Comment::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = Comment::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = Comment::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Comment::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }

    function getCommentsByCreationId($creationId)
    {
        $creations = DB::table('comments')
            ->where('creation_id', $creationId)
            ->get();
    
        return $creations;
    }
}
