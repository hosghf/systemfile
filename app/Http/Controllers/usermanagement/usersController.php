<?php

namespace App\Http\Controllers\usermanagement;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\File;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    public function registerIndex(){
        $role = Role::all();
        return view('user_management.sabte_personel', ['roles' => $role]);
    }

    public function store(Request $request){
        $v = $request->validate([
            'name' => 'required',
            'family' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'username' => 'required|min:3|unique:users',
            'password' => 'required|min:3',
        ],[
            'name.required' => 'لطفا نام را وارد کنید.',
            'family.required' => 'لطفا نام خانوادگی را وارد کنید.',
            'phone.required' => 'لطفا تلفن را وارد کنید.',
            'username.required' => 'لطفا نام کاربری را وارد کنید.',
            'username.min' => ' نام کاربری حداقل 3 کاراکتر باشد. ',
            'role.required' => ' سمت مشاور را وارد کنید. ',
            'password.required' => 'لطفا پسوورد را وارد کنید.',
            'password.min' => 'پسوورد حداقل 3 کاراکتر باشد.',
            'username.unique' => 'نام کاربری تکراری میباشد.',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->family = $request->family;
        $user->role_id = $request->role;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->flash('message', 'مشاور با موفقیت ثبت شد.');

        return redirect('registerpersonel');
    }

    public function showUpdate($id){
        $user = User::find($id);
        $role = Role::all();
        return view('user_management.update_personel', ['user' => $user, 'roles' => $role]);
    }

    public function update(Request $request, $id){
        if($id == 2 or $id == 1){
            session()->flash('message', 'امکان ویرایش کاربر وجود ندارد.');
            return redirect()->back();
        }
        if (!auth()->user()->can('isModir')){
            session()->flash('message', 'شما به این قسمت دسترسی ندارید.');
            return redirect()->back();
        }
        $v = $request->validate([
            'name' => 'required',
            'family' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'username' => 'required|min:3',
        ],[
            'name.required' => 'لطفا نام را وارد کنید.',
            'family.required' => 'لطفا نام خانوادگی را وارد کنید.',
            'phone.required' => 'لطفا تلفن را وارد کنید.',
            'username.required' => 'لطفا نام کاربری را وارد کنید.',
            'username.min' => ' نام کاربری حداقل 3 کاراکتر باشد. ',
            'role.required' => ' سمت مشاور را وارد کنید. ',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->family = $request->family;
        $user->role_id = $request->role;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->save();

        $request->session()->flash('message', 'اطلاعات مشاور با موفقیت بروز رسانی شد.');
        return redirect()->back();
    }

    public function changepassword(Request $request,$id){
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->flash('message', 'پسوورد با موفقیت بروز رسانی شد.');
        return redirect()->back();
    }

    public function list(){
        $users = User::all()->except([1]);
        return view('user_management.list_personel', ['users' => $users]);
    }

    public function delete($id)
    {
        if($id == 2 or $id == 1){
            session()->flash('message', 'امکان حذف کاربر وجود ندارد.');
            return redirect()->back();
        }
        if (!auth()->user()->can('isModir')){
            session()->flash('message', 'شما به این قسمت دسترسی ندارید.');
            return redirect()->back();
        }

        $files = File::where('user_id', $id)->get();
        foreach ($files as $file){
            $file->user_id = 2;
            $file->save();
        }

        $customers = Customer::where('user_id', $id)->get();
        foreach ($customers as $cust){
            $cust->user_id = 2;
            $cust->save();
        }

        User::find($id)->delete();
        session()->flash('message', 'کاربر حذف شد.');
        return redirect()->back();
    }
}
