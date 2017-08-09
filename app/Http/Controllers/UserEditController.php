<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class UserEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $user = UserModel::where('id','=', $id)->get();
        if (count($user) != 1)
            return redirect('list')->with('error', 'User not found');
        if (Auth::user()->is_admin == true){
            if ($user[0]->is_admin == true && Auth::user()->id != $id)
                return redirect('list')->with('error','You are not allowed to edit other admin profile');
            else
                return view('edit', ['user'=>$user[0]]);
        } else{
            if ($user[0]->id == Auth::user()->id)
                return view('edit', ['user'=>$user[0]]);
            else 
                return redirect('list')->with('error', 'You are not allowed to edit other profile');
        }
    }

    public function postHandle(Request $request)
    {
        
        $id = $request->input('id');
        $user = UserModel::where('id','=', $id)->get();
        if (count($user) != 1)
            return redirect('list')->with('error', 'User not found');
        if (Auth::user()->is_admin == true){
            if ($user[0]->is_admin == true && Auth::user()->id != $id)
                return redirect('list')->with('error','You are not allowed to edit other admin profile');
            else
            {
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'username' => 'required|unique:users,username,'.$request->input('id').'|max:255',
                    'email' => 'required|unique:users,email,'. $request->input('id') .'|max:255',
                    'phone' => 'required|max:255',
                    'password' => 'max:255|confirmed'
                ]);
                UserModel::where('id', '=', $request->input('id'))->update(array(
                    'name' => $request->input('name'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone'),
                    'password' => $request->input('password')?bcrypt($request->input('password')):Auth::user()->password,
                ));
                return redirect('list')->with('status', 'Update profile success');
            }
        } else {
            if ($user[0]->id == Auth::user()->id)
            {
                $this->validate($request, [
                    'email' => 'required|unique:users,email,'. $request->input('id') .'|max:255',
                    'phone' => 'required|max:255',
                    'password' => 'max:255|confirmed'
                ]);
                UserModel::where('id', '=', $request->input('id'))->update(array(
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone'),
                    'password' => $request->input('password')?bcrypt($request->input('password')):Auth::user()->password,
                ));
                return redirect('list')->with('status', 'Update profile success');
            }
            else 
                return redirect('list')->with('error', 'You are not allowed to edit other profile');
        }
    }
}
