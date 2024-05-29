<?php

namespace App\Http\Controllers;

use App\Creation;
use App\CreationJury;
use App\Jury;
use App\Nomination;
use App\NominationJury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CreationsController extends Controller
{
    //---------------------------------------------------
    //crud
    public function index()
    {
        $routes = Creation::all();
        return response()->json($routes);
    }

    //добавление работы
    public function store(Request $request)
    {
        $creation = Creation::create($request->all());
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file->storeAs('creations', $creation->id . '.' . $file->getClientOriginalExtension(), 'public'); //добавление файла в директорию
            $creation->file = $creation->id . '.' . $file->getClientOriginalExtension(); //сохранение названия файла в таблицу в бд
            $creation->save();
        }
    
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $image->storeAs('creations', $creation->id . '.jpg', 'public');//добавление файла в директорию
            $creation->img =  $creation->id . '.jpg'; //сохранение названия изображения в таблицу в бд
            $creation->save();
        }

        //добавление записи в таблицу для оценок жюри
        $creation_id = $creation->id;
        $nomination_id = $creation->nomination_id;
        $tour_id = $creation->tour_id;
        $age_group_id = $creation->age_group_id;

        //получение номеров жюри, которые оценивают эти номинации И туры И возрастные категории
        $juryIds = Jury::whereHas('nomination_juries', function ($query) use ($nomination_id) {
            $query->where('id', $nomination_id);
            })->whereHas('tour_juries', function ($query) use ($tour_id) {
                $query->where('id', $tour_id);
            })->whereHas('age_group_juries', function ($query) use ($age_group_id) {
                $query->where('id', $age_group_id);
            })->pluck('id');

        //добавление записей в таблицу для оценок
        foreach ($juryIds as $juryId) {
            $creationJury = new CreationJury();
            $creationJury->jury_id = $juryId;
            $creationJury->creation_id = $creation_id;
            $creationJury->save();
        }
    
        return response()->json($creation, 201);
    }


    public function show($id)
    {
        $route = Creation::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = Creation::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Creation::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
    //---------------------------------------------------

    //получение списка работ по id возрастной группы и id номинации
    function getCreationsByAgeGroupAndNomination($ageGroupId, $nominationId)
    {
        $creations = Creation::where('age_group_id', $ageGroupId)
            ->where('nomination_id', $nominationId)
            ->get();
    
        return $creations;
    }

    //получение списка работ по id номинации
    function getCreationsByNomination($nominationId)
    {
        $creations = Creation::where('nomination_id', $nominationId)
            ->get();
    
        return $creations;
    }

    //получение списка работ по id участника
    function getCreationsByAttendeeID($attendeeID)
    {
        $creations = Creation::where('attendee_id', $attendeeID)->get();
    
        return $creations;
    }

    //получение работы по id участника и id работы
    function getCreationByAttendeeIDCreationID($attendeeID, $creationID)
    {
        $creation = Creation::where('attendee_id', $attendeeID)
            ->where('id', $creationID)
            ->get();
    
        return $creation;
    }

    //получение файла работы по id работы
    public function getFile($creationID)
    {
        $file = Creation::findOrFail($creationID)->file;
        $path = storage_path('app/files/' . $file);
    
        if (file_exists($path)) {
            return response()->download($path, $file);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    //обновление массива работ
    public function updateAllcreations(Request $request)
    {
        $works = $request->all();
    
        foreach ($works as $work) {
            $workModel = Creation::findOrFail($work['id']);
            $workModel->update($work);
        }
    
        return response()->json($works);
    }

    //скачивание файла
    public function download($filename)
    {
        $filePath = storage_path('app/public/creations/' . $filename);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }

    //получить отфильтрованные и отсортированные по:
                                            // 1) id участника
                                            // 2) фамилии участника
                                            // 3) названии работы
                                            // 4) разделу   
                                            // 5) туру
                                            // 6) возрастной группе
    //все параметры не обязательны, запрос выстраивается динамически
    function getCreations(Request $request)
    {
        $query = Creation::query();
    
        $ID = $request->input('ID');
        $surname = $request->input('surname');
        $title = $request->input('title');
        $nomination = $request->input('nomination');
        $tour = $request->input('tour');
        $ageGroup = $request->input('ageGroup');
    
        if ($ID !== null) {
            $query->where('id', $ID);
        }
    
        // if ($surname !== null) {
        //     $query->whereIn('attendee_surname', [$surname]);
        // }
    
        // if ($title !== null) {
        //     $query->whereIn('title', [$title]);
        // }
    
        // if ($nomination !== null) {
        //     $query->whereIn('nomination_id', (int)$nomination);
        // }
    
        // if ($tour !== null) {
        //     $query->whereIn('tour_id', (int)$tour);
        // }
    
        // if ($ageGroup !== null) {
        //     $query->whereIn('age_group_id', (int)$ageGroup);
        // }
    
        $creations = $query->get();
    
        return $creations;
    }
    
}
