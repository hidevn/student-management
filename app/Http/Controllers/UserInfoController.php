<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as UserModel;
use App\Message as MessageModel;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($id){
        $users = UserModel::where('users.id', '=', $id)->get();
        $messages = MessageModel::where([
                    ['to_id', '=', $id],
                    ['from_id', '=', Auth::user()->id]
                ])->get();
        if (count($users) != 1)
            return redirect('info')->with('error', 'User not found');
        return view('info', ['user' => $users[0], 'messages' => $messages]);
    }
    
    public function roleCheck($messageid){
        $userid = Auth::user()->id;
        $messages = MessageModel::where('id', '=', $messageid)->get();
        if (count($messages) != 0){
            if ($messages[0]->from_id == $userid || $messages[0]->to_id == $userid)
                return true;
        }
        return false;
    }
    
    public function update(Request $request, $id){
        $this->validate($request, [
            'content' => 'required'
        ]);
        if (!$this->roleCheck($id))
            return redirect('info')->with('error', 'Error');
        MessageModel::where('id', '=', $id)->update(array(
            'content'=>$request->input('content')        
        ));
        return redirect()->back()->with('status', 'Update message success');
    }
    
    public function add(Request $request, $id){
        $this->validate($request, [
            'content' => 'required'
        ]);
        MessageModel::where('id', '=', $request->input('id'))->insert(array(
            'content'=>$request->input('content'),
            'from_id'=>Auth::user()->id,
            'to_id'=>$id
        ));
        return redirect()->back()->with('status', 'Message sent');
    }
    
    public function delete($id){
        if (!$this->roleCheck($id))
            return redirect('info')->with('error', 'Error');
        MessageModel::where('id', '=', $id)->delete();
        return redirect()->back()->with('status', 'Message deleted');
    }
    
    public function inbox(){
        $messages = MessageModel::where('to_id', '=', Auth::user()->id)->get();
        return view('inbox', ['messages' => $messages]);
    }
}
