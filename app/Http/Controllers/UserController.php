<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __contructor(){
        //coloca todos seguridad de auth menos el index
       // $this->middleware('auth:api')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        //return $users; 

        //return response()->json(['data' => $users], 200);
       // return UserResource::collection($users);
        return $this->showAll($users);

    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //name campo requerido con max 255 caracteres
        //email: campo requerido, validar que tenga formato email, 
        //que sea unico en la table users campo email  
        //password minimo 6 caracteres y debe ser confirmado
        //cuando el pws requiere confirmation entonces agregrar en el request el parametro "password_confirmation"
       /* $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);*/

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ];

        $data = $this->transformAndValidatedRequest(UserResource::class, $request, $rules);

       //encriptando
        $data['password'] = bcrypt($data['password']);
       
        $user = User::create($data);

        //return response()->json(['data' => $user], 201);
        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return response()->json(['data' => $user], 200);
        return $this->showOne($user);
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {  //se utilisa en el metodo put
        //fuerza al email q se grabe siendo el mismo
        /*$data = $request->validate([
            'name' => 'max:255',
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'min:6|confirmed'
        ]);*/

        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'min:6|confirmed'
        ];

        $data = $this->transformAndValidatedRequest(UserResource::class, $request, $rules);
/*
        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('email')){
            $user->email = $request->email;
        }
        if($request->has('password')){
            $user->email = bcrypt($request->email);
        }
*/
        if( isset($data['password'])){
            $data['password'] = bcrypt( $data['password'] );
        }

        $user->fill($data);

        if(!$user->isDirty()){
            //si no se hizo cambios
            /*
            return response()->json(['error' => [ 'code'=>422,
             'message'=>'Please specify at least one different value']], 422);
                */
             return $this->errorResponse('Please specify at least one different value', 422);
        }

        $user->save();

      //  return response()->json(['data' => $user], 200);
      return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
       // return response()->json(['data' => $user], 200);
       return $this->showOne($user);
    }


}
