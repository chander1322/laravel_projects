<?php

namespace App\Http\Controllers;

use App\Models\BasicApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class justApi extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        // $apidata=[
        //     'firstname'=>$req->name,
        //     'email'=>$req->email,
        //     'password'=>Hash::make($req->password),
        // ];
        // BasicApi::create($apidata);  
        return response()->json(['message' => 'Data stored successfully']);
    }
    public function insert_user(Request $req){
    //     $data=[
    //        'name'=>$req->name,
    //        'email'=>$req->email,
    //        'password'=>Hash::make($req->password),
    //    ];
    //    User::create($data);  
    //    return 'success You are Registered';
    return response()->json(['message' => 'Data stored successfully']);

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
}
