<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\User as UserModel;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $portsString = Auth::user()->check_ports;
        return view('setting', ['portsString' => $portsString]);
    }
    
    public function update(Request $request)
    {
        $portsString = $request->input('ports');
        $this->validate($request, [
            'ports' => 'required'
        ]);
        UserModel::where('id','=',Auth::user()->id)->update([
            'check_ports' => $portsString
            ]);
        return redirect('setting')->with('status', 'Updated');
    }
}
