<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function index()
    {
        $routes = Admin::all();
        return response()->json($routes);
    }

    public function store(Request $request)
    {
        $route = Admin::create($request->all());
        return response()->json($route, 201);
    }

    public function show($id)
    {
        $route = Admin::findOrFail($id);
        return response()->json($route);
    }

    public function update(Request $request, $id)
    {
        $route = Admin::findOrFail($id);
        $route->update($request->all());
        return response()->json($route);
    }

    public function destroy($id)
    {
        $route = Admin::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }

    //--------------------------------------------------------------

    //получить администратора по id пользователя
    function getAdminByUser($userID)
    {
        $admin = Admin::where('user_id', $userID)->get();
        return $admin ;
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
        
                $jury = new Admin();
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
