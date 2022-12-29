<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
    }

    public function change_password(){

        $data['path'] = "تغییر رمز عبور ";
        $data['title'] = " تغییر رمز عبور ";

        return View('panel.change_password', $data);
    }
    public function change_password_store(Request $request) {
        $data['path'] = "تغییر رمز عبور ";
        $data['title'] = " تغییر رمز عبور ";


        $validData = $this->validate($request, [
            'currentPassword' => 'required|string|max:255',
            'password' => 'required|string|max:255|min:6',
            'password_confirmation' => 'required|string|max:255|min:6|same:password',
        ]);

        if(Hash::check($request['currentPassword'],Auth::user()->password)) {
            User::where( 'id' , Auth::user()->id )->update([
                'password' => bcrypt($request['password'])
            ]);
            toast(  ' پسورد شما با موفقیت تغییر یافت . لطفا یک بار از سیستم خارج و مججدا لاگین کنید . ','success')->width('333')->position('center');
            return back();
        }

        toast( 'پسورد فعلی وارد شده اشتباه است .  مجددا تلاش نمایید.','error')->width('333')->position('center');
        return back();
    }
}
