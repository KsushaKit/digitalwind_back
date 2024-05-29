<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\AgeGroupJury;
use App\Creation;
use App\CreationJury;
use App\Jury;
use App\NominationJury;
use App\Round;
use App\TourJury;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JuriesController extends Controller
{
    //---------------------------------------------------
    //crud
    public function index()
    {
        $routes = Jury::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = Jury::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = Jury::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = Jury::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Jury::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
    //---------------------------------------------------

    //получить список всех работ для оценки жюри по его id, соответсвующие:
                                                            // 1) его списку туров
                                                            // 2) его списку номинаций
                                                            // 3) его списку возрастных групп
                                                            // 4) статуса "Одобрена"   
                                                            // 5) количеству запрашиваемых работ 
                                                            // 6) текущему этапу
    // function getCreations($juryID, $limit)
    // {
    //     //получение текущего этапа
    //     $round = Round::findOrFail(1);
    //     $roundNumber = $round->name;


    //     //получение списка id туров, связанных с конкретным жюри
    //     $toursId = TourJury::whereIn('jury_id', [$juryID])->pluck('tour_id');
    //     //получение списка id номинаций, связанных с конкретным жюри
    //     $nominationsId = NominationJury::whereIn('jury_id', [$juryID])->pluck('nomination_id');
    //     //получение списка id возрастных категорий, связанных с конкретным жюри
    //     $ageGroupsId = AgeGroupJury::whereIn('jury_id', [$juryID])->pluck('age_group_id');

    //     $creations = Creation::whereIn('tour_id', $toursId)
    //         ->whereIn('nomination_id', $nominationsId)
    //         ->whereIn('age_group_id', $ageGroupsId)
    //         ->whereIn('status', ['Одобрена'])
    //         ->where('round', $roundNumber)
    //         ->take($limit)
    //         ->get();
    //     return $creations;

    // }

    // для получения работ относящихся к жюри
// -----------------------ФУНКЦИЯ ДЛЯ ОБНОВЛЕННЫХ ПОЛЕЙ МАССИВОВ ТУРОВ НОМИНАЦИЙ И ВОЗРАСТНЫХ КАТЕГОРИЙ-------------
    function getCreations($juryID, $limit)
    {
        // Получение текущего этапа
        $round = Round::findOrFail(1);
        $roundNumber = $round->name;

        // Получение жюри с его связанными данными
        $jury = Jury::findOrFail($juryID);

        // Получение списка id туров, номинаций и возрастных категорий из varchar полей
        $toursId = $jury->tours;
        $nominationsId = $jury->nominations;
        $ageGroupsId = $jury->age_categories;

        
        // это тут не нужно, но оно так работает
        $nominations =$toursId;
        $tours = $nominationsId;
        $ageCategories = $ageGroupsId;

        // Получение списка работ, соответствующих критериям
        $creations = Creation::whereIn('tour_id', $tours)
            ->whereIn('nomination_id', $nominations)
            ->whereIn('age_group_id', $ageCategories)
            ->where('status', 'Одобрена')
            ->where('round', $roundNumber)
            ->take($limit)
            ->get();

        return $creations;
    }
// ----------------------------------------------------------------------------------------------------------------------

    // функция обновления массивов номинаций туров и возрастных категорий
    function updateJuryFields(Request $request, $id)
    {

        // $id = $request->input('id');
        // Получение жюри по ID
        $jury = Jury::findOrFail($id);

        $nominations = $request->input('nominations');
        $tours= $request->input('tours');
        $ageCategories = $request->input('age_categories');

        
        // Сериализация массивов в строки
        $nominationsString = serialize($nominations);
        $toursString = serialize($tours);
        $ageCategoriesString = serialize($ageCategories);

        // Проверка и обновление полей, если переменные не пустые
        if (!empty($nominations)) {
            $jury->nominations = $nominations;
        }

        if (!empty($tours)) {
            $jury->tours = $tours;
        }

        if (!empty($ageCategories)) {
            $jury->age_categories = $ageCategories;
        }

        // Сохранение изменений
        $jury->save();
    }


    // function getCreations($juryID)
    // {
    //     //получение записей из сводной таблицы
    //     $creationJuries = CreationJury::where('jury_id', $juryID)->pluck('creation_id');
    //     //получение работ
    //     $creations = Creation::whereIn('id', $creationJuries)->get();
    
    //     return $creations;
    // }

    //получить список всех работ для оценки жюри по его id, отсортированные по:
                                                            // 1) номинациям
                                                            // 2) возрастным группам
 
    function getCreations2($juryID, $nominationID, $ageGroupID, $limit)
    {
        //получение списка id туров, связанных с конкретным жюри
        $toursId = TourJury::whereIn('jury_id', [$juryID])->pluck('tour_id');
        //получение списка id номинаций, связанных с конкретным жюри
        $nominationsId = NominationJury::whereIn('jury_id', [$juryID])->pluck('nomination_id');
        //получение списка id возрастных категорий, связанных с конкретным жюри
        $ageGroupsId = AgeGroupJury::whereIn('jury_id', [$juryID])->pluck('age_group_id');

        $creations = Creation::whereIn('tour_id', $toursId)
            ->whereIn('nomination_id', $nominationsId)
            ->whereIn('age_group_id', $ageGroupsId)
            ->whereIn('status', ['accepted'])
            ->take($limit)
            ->where('nomination_id', $nominationID)
            ->where('age_group_id', $ageGroupID)
            ->get();
        return $creations;
    }
    // function getCreations2($juryID, $nominationID, $ageGroupID, $limit)
    // {
    //     //получение записей из сводной таблицы
    //     $creationJuries = CreationJury::where('jury_id', $juryID)->pluck('creation_id');
    //     //получение работ
    //     $creations = Creation::whereIn('id', $creationJuries)
    //     ->where('tour_id', $nominationID)
    //     ->where('tour_id', $ageGroupID)
    //     ->take($limit)
    //     ->get();
    
    //     return $creations;
    // }

    //получить список всех работ для оценки жюри по его id, отсортированные по:
                                                        // 1) номинациям
 
    function getCreations3($juryID, $nominationID, $limit)
    {
        //получение списка id туров, связанных с конкретным жюри
        $toursId = TourJury::whereIn('jury_id', [$juryID])->pluck('tour_id');
        //получение списка id номинаций, связанных с конкретным жюри
        $nominationsId = NominationJury::whereIn('jury_id', [$juryID])->pluck('nomination_id');
        //получение списка id возрастных категорий, связанных с конкретным жюри
        $ageGroupsId = AgeGroupJury::whereIn('jury_id', [$juryID])->pluck('age_group_id');

        $creations = Creation::whereIn('tour_id', $toursId)
            ->whereIn('nomination_id', $nominationsId)
            ->whereIn('age_group_id', $ageGroupsId)
            ->whereIn('status', ['accepted'])
            ->take($limit)
            ->where('nomination_id', $nominationID)
            ->get();
        return $creations;
    }

    //получить список всех работ для оценки жюри по его id, отсортированные по:
                                                        // 1) возрастным группам
 
    function getCreations4($juryID, $ageGroupID, $limit)
    {
        //получение списка id туров, связанных с конкретным жюри
        $toursId = TourJury::whereIn('jury_id', [$juryID])->pluck('tour_id');
        //получение списка id номинаций, связанных с конкретным жюри
        $nominationsId = NominationJury::whereIn('jury_id', [$juryID])->pluck('nomination_id');
        //получение списка id возрастных категорий, связанных с конкретным жюри
        $ageGroupsId = AgeGroupJury::whereIn('jury_id', [$juryID])->pluck('age_group_id');

        $creations = Creation::whereIn('tour_id', $toursId)
            ->whereIn('nomination_id', $nominationsId)
            ->whereIn('age_group_id', $ageGroupsId)
            ->whereIn('status', ['accepted'])
            ->take($limit)
            ->where('age_group_id', $ageGroupID)
            ->get();
        return $creations;
    }

    //получить жюри по id пользователя
    function getJuryByUser($userID)
    {
        $jury = Jury::where('user_id', $userID)->get();
        return $jury ;
    }

    public function updateNTA(Request $request, $id)
    {
        $jury = Jury::findOrFail($id);

        $jury->nominations = $request->input('nominations', []);
        $jury->rounds = $request->input('rounds', []);
        $jury->age_categories = $request->input('age_categories', []);

        $jury->save();

        return response()->json(['message' => 'Jury updated successfully']);
    }

    //регистрация
    function registrate(Request $request)
    {
    
        DB::beginTransaction();
    
        try {
            $user = new User(); 
            $user->login = $request->name;
            $user->password = Hash::make($request->password);
            $user->role = $request->email;
            $user->save();
    
            $jury = new Jury();
            $jury->surname = $request->surname;
            $jury->name = $request->name;
            $jury->patronymic = $request->patronymic;
            $jury->email = $request->email;
            $jury->save();
    
            DB::commit();
    
            return response()->json(['message' => 'Регистрация прошла успешно']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Ошибка при регистрации'], 500);
        }
    }


}
