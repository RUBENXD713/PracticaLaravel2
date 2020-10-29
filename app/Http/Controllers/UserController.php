<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LogIn(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();

        if($user || Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email|password'=>['Datos Incorrectos']
            ]);
        }
        $token=$user->createToken($request->email,['user:user','admin:admin'])->plainTextToken;
        return response()->json(["token"=>$token],201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LogOut(Request $request)
    {
        return response()->json(["destroy"=>$request->user()->token()->delete()],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Registro(Request $Nombre)
    {
        $request->validate([
            'email'=>'required|email|unique',
            'password'=>'required',
            'name'=>'required',
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->TipoUsuario=$request->tipo;
        $user->password=Hash::make($request->password);
        if($user->save()){
            return response()->json($usr,200);
        }
        return abort(402, "Error al Insertar");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comentarioss  $comentarioss
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->tokenCan('user:user'))
        {
            return response()->json(['users'=>User::all()],200);
        }
        if($request->user()->tokenCan('admin:admin'))
        {
            return response()->json(['users'=>User::all()->where()],200);
        }      
        return abort(402, "Error al Insertar");
    }
}
