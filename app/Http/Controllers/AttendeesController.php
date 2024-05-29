<?php

namespace App\Http\Controllers;

use App\Attendee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AttendeesController extends Controller
{
    //---------------------------------------------------
    //crud
    public function index()
    {
        $routes = Attendee::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = Attendee::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = Attendee::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = Attendee::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Attendee::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
    //---------------------------------------------------

    //получить пользователя по id участника
    function getUserByAttendee($attendeeID)
    {
        $attendee = Attendee::find($attendeeID);
        $user = $attendee->user;
    
        return $user;
    }
    //получить участника по id пользователя
    function getAttendeeByUser($userID)
    {
        $attendee = Attendee::where('user_id', $userID)->get();
        return $attendee ;
    }

    //регистрация
    function registrate(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $user = new User(); 
            $user->login = $request->login;
            $user->password = Hash::make($request->password);
            $user->role = 'attendee';
            $user->save();
    
            $user_id = $user->id; // Получение user_id
    
            $attendee = new Attendee();
            $attendee->surname = $request->surname;
            $attendee->name = $request->name;
            $attendee->patronymic = $request->patronymic;
            $attendee->birth_date = $request->birth_date;
            $attendee->email = $request->email;
            $attendee->phone_number = $request->phone_number;
            $attendee->country = $request->country;
            $attendee->region = $request->region;
            $attendee->city = $request->city;
            $attendee->add_educational = $request->add_educational;
            $attendee->educational_institution_type = $request->educational_institution_type;
            $attendee->educational_institution = $request->educational_institution;
            $attendee->institute = $request->institute;
            $attendee->specialization = $request->specialization;
            $attendee->course = $request->course;
            $attendee->class = $request->class;
            $attendee->user_id = $user_id; // Использование user_id
            $attendee->save();
    
            DB::commit();
    
            return response()->json(['message' => 'Регистрация прошла успешно']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Ошибка при регистрации'], 500);
        }
    }
}
