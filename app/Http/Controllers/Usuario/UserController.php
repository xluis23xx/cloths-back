<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = MD5($request->input('password'));
        // dd($password);
        // die();
        $result = DB::table('users')
        ->select('users.*')
        ->where('email','=',$email)
        ->where('password','=', $password)
        ->get();
        if ($result->count()>0) {
            return json_encode(array("status" => 200, "response" => $result));
        }else {
            return json_encode(array("status" => 404, "response" => "User not found"));
        }
    }

    public function create(Request $request)
    {
        $usuarios = new User();

        $usuarios->id = 4;
        $usuarios->name = $request->input('name');
        $usuarios->name = $request->input('name');
        $usuarios->lastname = $request->input('lastname');
        // $usuarios->date_born = $request->input('date_born');
        $usuarios->email = $request->input('email');
        $usuarios->password = MD5($request->input('password'));

        $query = DB::table('users')
        ->select('users.*')
        ->where('users.email','=',"$usuarios->email")
        ->get();

        if(count($query) == 0){
            if($usuarios->save()){
                return response()->json(array("status"=>200,"response"=>$usuarios));
            };
        }
        else{
            return json_encode(array(
                "status" => 201,
                "mensaje" => "Ya existe una cuenta con el correo electronico"
            ));
        }
    }
}
