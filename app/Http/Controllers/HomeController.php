<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Lara7',
            'users' => UserModel::all(),
        ];
//        dd($data);
        return view('welcome', $data);
    }

    public function destroy($id)
    {
        try {
            $delete = UserModel::findOrFail($id);
            $delete->delete();
            session()->flash('messages', alertBS('Success!','Data has been deleted.','success'));
        } catch (\Exception $e) {
            session()->flash('messages', alertBS('Error!','Can\'t find user with ID '.$id,'danger'));
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        try {
            $row = UserModel::findOrFail($id);
            $data = [
              'title' => 'Update',
              'user' => $row
            ];
            return view('v_home_update', $data);
        } catch (\Exception $e) {
            session()->flash('messages', alertBS('Error!','Can\'t find user with ID '.$id,'danger'));
        }
        return redirect()->back();
    }

    public function update(request $request)
    {
//        dd($request->all());
        $id = htmlspecialchars($request->segment(2),\ENT_QUOTES, 'UTF-8');
        $validate = Validator::make($request->all(),[
            'name' => 'required|min:4|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|required_with:password_confirmation|confirmed|min:6'
        ]);
        if($validate->fails()){
            session()->flash('messages', alertBS('Error!','Data not valid, try again.','danger'));
            return redirect()->back()->withInput()->withErrors($validate);
        }
        try {
            $update = UserModel::findOrFail($id);
            $update->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            session()->flash('messages', alertBS('Success!','Update user with ID '.$id.' successfully','success'));
        } catch (\Exception $e) {
            session()->flash('messages', alertBS('Error!','Can\'t update user with ID '.$id,'danger'));
        }
        return redirect()->back();
    }

    public function users()
    {
        $data = [
          'title' => 'User List',
          'users' => UserModel::all()
        ];
        return view('user.v_user_list', $data);
    }

    public function users_vue()
    {
        $data = [
            'title' => 'User List (Vue.js)',
            'users' => UserModel::all()
        ];
        return view('user.v_user_list', $data);
    }
}
