<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\User;
use Illuminate\Support\Facades\Hash;
use Log;

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

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email|password'=>['Datos Incorrectos']
            ]);
        }
        if($user->TipoUsuario == 'admin')
        {
            $token=$user->createToken($request->email, ['admin:admin'])->plainTextToken;
            return response()->json(["token"=>$token],201);
        }
        else
        {
            if($user->TipoUsuario == 'userT2' )
            {
                $token=$user->createToken($request->email, ['user:user'])->plainTextToken;
                return response()->json(["token"=>$token],201);
            }
            else
            {
                $token=$user->createToken ($request->email,['user:info'])->plainTextToken;
                return response()->json(["token"=>$token],201);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LogOut(Request $request)
    {
        //return response()->json(["Destroyed"=>$request->user()->token()->delete()],200);
        return response()->json(["destroyed" => $request->user()->tokens()->delete()],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Registro(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required'
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->TipoUsuario='user';
        if($user->save()){
            return response()->json($user);
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
            return response()->json(['Perfil'=>$request->user()],200);
        }
        if($request->user()->tokenCan('admin:admin'))
        {
            return response()->json(['Usuarios'=>User::all()],200);
        }      
        return abort(402, "Error al Insertar");
    }
    public function actualizar(Request $request)
    {
        
        $user=User::find ($request->id);  
        $user->TipoUsuario=$request->tipo;  
        if($user->save())
        return response()->json(["Permiso Actualizado a"=>$user]);   
        return response()->json(null,400);
    }
}
