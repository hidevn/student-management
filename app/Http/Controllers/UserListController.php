<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as UserModel;

class UserListController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'requored|string|max:225|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function index(){
        $users = UserModel::all();
        return view('list', ['users' => $users]);
    }
}
