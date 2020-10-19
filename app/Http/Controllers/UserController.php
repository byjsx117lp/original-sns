<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

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
        $user = User::find($id);
        
        return view('users.show', ['user' => $user]);
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
        $user = User::find($id);
        return view('users.edit', ['user' => $user, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, $id)
    {
        //
        if($file = $request->image_file_name) {
            $fileName = time() .'_'. $id .'_'. $file->getClientOriginalName();
            $targetPath = public_path('/storage/');
            $file->move($targetPath, $fileName);
        } else {
            $user = User::find($id);
            $fileName = $user->image_file_name;
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->image_file_name = $fileName;
        $user->residence = $request->residence;
        $user->self_introduction = $request->self_introduction;
        $user->part1 = $request->part1;
        $user->part2 = $request->part2;
        $user->part3 = $request->part3;
        $user->part_of_years1 = $request->part_of_years1;
        $user->part_of_years2 = $request->part_of_years2;
        $user->part_of_years3 = $request->part_of_years3;

        $user->save();

        return redirect()->route('users.show', ['user' => $user->id,]);
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

    public function  mypage() {
        $user = Auth::user();
        return view('users.mypage', ['user' => $user]);
    }
}
