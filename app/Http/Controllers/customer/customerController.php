<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Street;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function registerIndex(Request $request){
        $streets = Street::all();
        $rooms = Room::all();
        $forosh = $request->forosh;
        $pagetitle = '';
        if($forosh == 1){
            $pagetitle = 'فروش';
        } elseif($forosh ==0){
            $pagetitle = 'رهن و اجاره';
        }
        return view('moshtari.sabte_moshtari', ['streets' => $streets, 'rooms' => $rooms,
                                        'pagetitle' => $pagetitle,'forosh' => $forosh]);
    }

    public function store(Request $request){
        $v = $request->validate([
            'family' => 'required',
            'phone' => 'required',
        ],[
            'family.required' => 'لطفا نام خانوادگی مشتری را وارد کنید.',
            'phone.required' => 'لطفا تلفن مشتری را وارد کنید.',
        ]);

        $customer = new Customer;
        $customer->family = $request->family;
        $customer->phone = $request->phone;
        $customer->price = $request->gheymat;
        $customer->rahn = $request->rahn;
        $customer->ejare = $request->ejare;
        $customer->metr = $request->metr;
        $customer->tozihat = trim($request->tozihat);
        $customer->forosh = $request->forosh;
        $customer->user_id = 1;
        $customer->save();

        $request->session()->flash('message', 'مشتری با موفقیت ثبت شد.');
        return redirect('registercustomer');
    }

    public function showUpdate($id){
        $customer = Customer::find($id);
        $streets = Street::all();
        $rooms = Room::all();
        return view('moshtari.update_moshtari', ['customer' => $customer, 'streets' => $streets,
                                                        'rooms' => $rooms]);
    }

    public function update(Request $request, $id){
        $v = $request->validate([
            'family' => 'required',
            'phone' => 'required',
            'gheymat' => 'numeric',
            'metr' => 'numeric'
        ],[
            'family.required' => 'لطفا نام خانوادگی مشتری را وارد کنید.',
            'phone.required' => 'لطفا تلفن مشتری را وارد کنید.',
            'gheymat.numeric' => 'قیمت را به عدد وارد کنید.',
            'metr.numeric' => 'متراژ را به عدد وارد کنید.'
        ]);

        $customer = Customer::find($id);
        $customer->family = $request->family;
        $customer->phone = $request->phone;
        $customer->price = $request->gheymat;
        $customer->metr = $request->metr;
        $customer->tozihat = trim($request->tozihat);
        $customer->room_id = $request->room;
        $customer->forosh = 1;
        $customer->maskoni = 1;
        $customer->user_id = 1;
        $customer->save();

        $request->session()->flash('message', 'تغییرات با موفقیت ثبت شد.');
        return redirect('updatecustomer/' . $id);
    }

    public function list(Request $request){
        $forosh = $request->forosh;
        $pagetitle = '';
        if($forosh == 1){
            $pagetitle = 'فروش';
        } elseif($forosh ==0){
            $pagetitle = 'رهن و اجاره';
        }
        $customers = Customer::where('forosh', $forosh)->paginate(10);
        return view('moshtari.list_moshtari', ['customers' => $customers, 'forosh' => $forosh, 'pagetitle' => $pagetitle]);
    }

    public function archive(){

    }

    public function delete($id){
        Customer::find($id)->delete();
        session()->flash('message', 'مشتری حذف شد.');
        return redirect()->back();

    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return view('moshtari.namayesh_moshtari', ['customer' => $customer]);
    }

}
