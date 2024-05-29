<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $routes = News::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = News::create($request->all());
        
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $image->storeAs('news', $route->id . '.jpg', 'public');//добавление файла в директорию
            $route->img =  $route->id . '.jpg'; //сохранение названия изображения в таблицу в бд
            $route->save();
        }
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = News::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = News::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = News::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }

    public function last()
    {
        $routes = News::latest()->take(3)->orderBy('id', 'desc')->get();
        return response()->json($routes);
    }
}
