<?php

namespace App\Http\Controllers;

use App\Creation;
use App\CreationJury;
use Illuminate\Http\Request;

class CreationJuryController extends Controller
{
    //---------------------------------------------------
    //crud
    public function index()
    {
        $routes = CreationJury::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = CreationJury::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = CreationJury::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = CreationJury::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = CreationJury::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
    //---------------------------------------------------

    //получение списка оценок, связанных с конкретным жюри
    public function getByJury($juryId)
    {
        $score = CreationJury::where('jury_id', $juryId)->get();
        return $score;
    }

    //ТУТ ДОЛЖНА БЫТЬ ТРАНЗАКЦИЯ
    //обновление массива оценок жюри
    public function updateAllcreations(Request $request)
    {
        $creationJuries = $request->all();
        
        foreach ($creationJuries as $creationJury) {
            $workModel = CreationJury::findOrFail($creationJury['id']);
            $workModel->update($creationJury);
    
            // обновление рейтинга нужной работы
            $creation_id = $creationJury['creation_id'];
            $creation = Creation::findOrFail($creation_id);
    
            // Получение нужного текстового поля из $creation и преобразование его в число
            $rating = $creation->rating; 
            $number = (int)$rating;
    
            // Получение первого и второго рейтинга
            $additionalNumber1 = (int)$creationJury['score1']; 
            $additionalNumber2 = (int)$creationJury['score2']; 
    
            // Прибавление чисел
            $updatedNumber = $number + $additionalNumber1 + $additionalNumber2;
    
            // Сохранение обновленного значения
            $creation->rating = (string)$updatedNumber;
            $creation->save();
        }
        
        return response()->json($creationJuries);
    }
    
    
    public function createAllcreations(Request $request)
    {
        $scores = $request->all();
        
        foreach ($scores as $score) {
            $workModel = new CreationJury();
            $workModel->fill($score);
            $workModel->save();
        }
        
        return response()->json($scores);
    }
}
