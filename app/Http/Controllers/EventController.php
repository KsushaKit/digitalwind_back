<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{

    // Получает список всех мероприятий
    public function index(): JsonResponse
    {
        $events = Event::all();
        return response()->json($events);
    }

    // Создать мероприятие
    public function store(Request $request): JsonResponse
    {
        // TODO: по дефолту количество текущих учатсников = 0
        $route = Event::create($request->all());

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $image->storeAs('events', $route->id . '.jpg', 'public'); //добавление файла в директорию
            $route->img =  $route->id . '.jpg'; //сохранение названия изображения в таблицу в бд
            $route->save();
        }
        return response()->json($route, 201);
    }

    // Получить мероприятие по id
    public function show($id): JsonResponse
    {
        $route = Event::findOrFail($id);
        return response()->json($route);
    }

    // Удалить мероприятие по id
    public function destroy($id): JsonResponse
    {
        $route = Event::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }

}
