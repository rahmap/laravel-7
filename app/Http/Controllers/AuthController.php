<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Auth;
class AuthController extends Controller
{
    public function register()
    {
        return view('auth.v_auth_register', ['title' => 'Register']);
    }

    public function registerPostAction(request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:4|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        if($validate->fails()){
            $request->session()->flash('messages', alertBS('Error!','Data not valid.','danger'));
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $dataInsert = [
            'name' => ucwords($request->name),
            'email' => trim($request->email),
            'password' => Hash::make($request->password)
        ];
        try {
            UserModel::create($dataInsert);
            $request->session()->flash('messages', alertBS('Success!','Data Created Success.','success'));
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('messages', alertBS('Error!','Data Created Error. '.$e,'danger'));
        }
        return redirect()->route('sign-up');
    }

    public function login()
    {
        return view('auth.v_auth_login', ['title' => 'Login']);
    }

    public function loginPostAction(request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ])->validate();
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->flash('messages', alertBS('Success!','You has successfully login.','success'));
        } else {
            $request->session()->flash('messages', alertBS('Error!','Upss data not found.','danger'));
            return redirect()->back()->withInput();
        }
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
