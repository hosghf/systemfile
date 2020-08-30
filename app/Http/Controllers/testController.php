<?php

namespace App\Http\Controllers;

use App\Models\BuildingDirection;
use App\Models\Cooling;
use App\Models\Customer;
use App\Models\Ejare;
use App\Models\Facility;
use App\Models\File;
use App\Models\Heating;
use App\Models\Image;
use App\Models\Meter;
use App\Models\Sanad;
use App\Models\Street;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer_street;
use App\Models\Floor;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder;

class testController extends Controller
{
    public function test2(Request $request)
    {
        $customers = Customer::query();
        $customers->where('user_id', 1)->get();

//        dd($customers);
        foreach ($customers as $customer){
            echo $customer->id;
            echo 'helo';
        }
    }

    public function xyz(Request $request){
        echo $request->x;
    }

    public function test(Request $request)
    {
        $new = 1;
        return view('test', ['new' => $new]);
    }

    public function index(){
//        $x = Customer_street::find(1)->get();
//
//        $x = File::find(1)->get();
//        echo $x[0]->street->title;
//            $c = File::find(1)->get();
//            echo $c[1]->cabinet_id;

//        $x = File::find(1);
//        echo $x->BuildingDirection->title;
//        $z = BuildingDirection::find(2);
//        echo $z->files[0]->family;

//        $x = File::find(1);
//        echo $x->cooling->title;
//        $z = Cooling::find(2);
//        echo $z->files[0]->family;
//
//        $x = File::find(1);
//        echo $x->sanad->title;
//        $z = Sanad::find(2);
//        echo $z->files[0]->family;
//
//        $x = File::find(1);
//        echo $x->type_of_land->title;
//        $z = Category::find(1);
//        echo $z->files[0]->family;
//
//        $x = User::find(1);
//        echo $x->role->title;
//        $z = Role::find(2);
//        echo $z->users[0]->id;
//
//        $x = File::find(1);
//        echo $x->facilities[1]->value;
//        $z = Facility::find(1);
//        echo $z->file->family;
//
        $x = File::find(1);
        var_dump($x->ejare);
        if(!isset($x->ejare)){
            echo 'not set';
        }
//        $z = Ejare::find(1);
//        echo $z->file->family;

//        $x = File::find(1);
//        echo $x->user->name;
//        $z = User::find(1);
//        echo $z->files[0]->family;
//
//        $x = Customer::find(1);
//        echo $x->user->name;
//        $z = User::find(1);
//        echo $z->customers[0]->family;

    }
}
