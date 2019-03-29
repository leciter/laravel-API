<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {        
        $users = User::all();

        return response()->json($users);
    }
 
    public function show($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {       
        $request->validate([
           'phone'       => 'unique|nullable',
        ]);

        $user = User::create($request->all());

        return response()->json([
            'message' => 'Great success! New user created',
            'user'    => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
           'phone'       => 'unique|nullable',
        ]);
        
        $user->update($request->all());

        return response()->json([
            'message' => 'User updated!',
            'user'    => $user
        ]);
    }

    public function delete(Request $request, $id)
    {
        $User = User::findOrFail($id);
        $User->delete();
        
        return 204;
    }
}
