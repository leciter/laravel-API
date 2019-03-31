<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    private $unauthorized_error_response;
    
    public function __construct()
    {
        $this->unauthorized_error_response = response()->json(['error' => 'Unauthorized'], 401);
    }

    public function index()
    {
        // Список всех пользователей доступен только авторизованным пользователям
        if(auth()->user())
        {
            $users = User::all();

            return response()->json($users);
        }
        else
            return $this->unauthorized_error_response;
    }
 
    public function show($id)
    {
        // по идее данные любого пользователя по id также доступны только авторизованному пользователю
        if(auth()->user())
        {
            return User::find($id);
        }
        else
            return $this->unauthorized_error_response;      
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'phone'     => ['required', 'string', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:6'],
        ]);

        $user = User::create($request->all());

        return response()->json([
            'message'   => 'Great success! New user created',
            'user'      => $user
        ]);
    }

    public function update(Request $request, $id)
    {        
        // update доступен только авторизованному пользователю
        if(auth()->user())
        {
            $user = User::findOrFail($id);
            
            $request->validate([
                'name'      => ['string', 'max:255'],
                'lastname'  => ['string', 'max:255'],
                'phone'     => 'unique:users',
                'password'  => ['string', 'min:6'],
            ]);
            
            $user->update($request->all());

            return response()->json([
                'message'   => 'User updated!',
                'user'      => $user
            ]);
        }
        else
            return $this->unauthorized_error_response; 
    }

    public function delete(Request $request, $id)
    {
        // delete доступен только авторизованному пользователю
        if(auth()->user())
        {
            $User = User::findOrFail($id);
            $User->delete();
            
            return 204;
        }
        else
            return $this->unauthorized_error_response; 
    }
}
