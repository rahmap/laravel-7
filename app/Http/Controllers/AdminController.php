<?php

namespace App\Http\Controllers;

use App\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function register()
    {
        return view('auth.v_auth_admin_register', ['title' => 'Admin Register']);
    }

    public function registerPostAction(request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:4|regex:/^[a-zA-Z\s]*$/',
            'username' => 'required|min:3|alpha_dash|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6'
        ]);
        if($validate->fails()){
            $request->session()->flash('messages', alertBS('Error!','Data not valid.','danger'));
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $dataInsert = [
            'name' => ucwords($request->name),
            'username' => strtolower($request->username),
            'email' => trim($request->email),
            'password' => Hash::make($request->password)
        ];
        try {
            AdminModel::create($dataInsert);
            $request->session()->flash('messages', alertBS('Success!','Data Created Success.','success'));
            return redirect()->route('sign-in-admin');
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('messages', alertBS('Error!','Data Created Error. '.$e,'danger'));
            return redirect()->route('sign-up-admin');
        }
    }

    public function login()
    {
        return view('auth.v_auth_admin_login', ['title' => 'Admin Login']);
    }

    public function loginPostAction(request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required|min:3',
            'password' => 'required|min:6'
        ])->validate();
        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])){
            $request->session()->flash('messages', alertBS('Success!','You has successfully login.','success'));
        } else {
            $request->session()->flash('messages', alertBS('Error!','Upss data not found.','danger'));
            return redirect()->back()->withInput();
        }
        return redirect()->route('user_list');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('log-out-admin');
    }
}
