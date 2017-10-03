<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()-> toArray();
        return response()->json($users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $user = new User([
                'name' =>$request -> input('name'),
                'email' =>$request -> input('email'),
                'password' =>$request -> input('password'),
            ]);
            Log::info('Usuario almacenado');
            $user->save();
            return response()-> json(['status'=>true,'Muchas gracias =)'],200);

        }catch (\Exception $exception){
            Log::critical("No se pudo almacenar el usuario: {$exception->getCode()}, {$exception->getLine()},{$exception->getMessage()}");
            return response('Algo malo',500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $user = User::find($id);
            if (!$user){
                return response()->json(['El id no existe'],404);
            }
            return response()->json($user,200);

        }catch (\Exception $exception){
            Log::critical("No se pudo almacenar el usuario: {$exception->getCode()}, {$exception->getLine()},{$exception->getMessage()}");
            return response('Algo malo',500);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id);
            if(!$user){
                return response()->json(['El id no existe '],404);
            }

            $user->delete();
            return response()->json('Usuario  eliminado',200);


        }catch (\Exception $exception){
            Log::critical("No se pudo almacenar el usuario: {$exception->getCode()}, {$exception->getLine()},{$exception->getMessage()}");
            return response('Algo malo',500);

        }
    }
}
