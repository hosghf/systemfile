<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Street;
use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\Meter;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Hekmatinasser\Verta\Verta;
use Carbon\Carbon;
use Gate;

class customerController extends Controller
{
    public function registerIndex(Request $request){
        $streets = Street::all();
        $forosh = $request->forosh;
        $pagetitle = '';
        if($forosh == 1){
            $pagetitle = 'فروش';
        } elseif($forosh ==0){
            $pagetitle = 'رهن و اجاره';
        }
        return view('moshtari.sabte_moshtari', ['streets' => $streets,
                                        'pagetitle' => $pagetitle,'forosh' => $forosh]);
    }

    public function store(Request $request){

        if(auth()->user()->id ==4){
            $request->session()->flash('message', 'شما قادر به ثبت فای نیستید.');
            return redirect()->back();
        }

        $v = $request->validate([
            'family' => 'required',
            'phone' => 'required|digits_between:0,13',
            'gheymat' => 'nullable|numeric|max:99999999.99',
            'rahn' => 'nullable|numeric|max:999999.99',
            'ejare' => 'nullable|numeric|max:999999.99',
            'metr' => 'nullable|numeric|max:999999999',
        ],[
            'family.required' => 'لطفا نام خانوادگی مشتری را وارد کنید.',
            'phone.required' => 'لطفا تلفن مشتری را وارد کنید.',
            'gheymat.digits_between' => 'قیمت را به عدد وارد کنید.',
            'metr.numeric' => 'متراژ را به عدد وارد کنید.',
            'metr.max' => 'حداکثر مقدار مجاز برای متراژ 999999999 میباشد.',
            'gheymat.numeric' => ' قیمت را به عدد وارد کنید.واحد قیمت ملیون تومان میباشد.',
            'gheymat.max' => 'واحد قیمت یک ملیون میباشد و حداکثر مقدار مجاز 99999999.99 میباشد.',
            'rahn.numeric' => ' رهن را به عدد وارد کنید.واحد رهن ملیون تومان میباشد.',
            'rahn.max' => 'واحد رهن یک ملیون میباشد و حداکثر مقدار مجاز 999999.99 میباشد.',
            'ejare.numeric' => ' اجاره را به عدد وارد کنید.واحد اجاره ملیون تومان میباشد.برای مقادیر کمتر از 1 ملیون از اعشار استفاده کنید.',
            'ejare.max' => 'واحد اجاره یک ملیون میباشد و حداکثر مقدار مجاز 999999.99 میباشد.برای مقادیر کمتر از 1 ملیون از اعشار استفاده کنید.',
        ]);
        $forosh = $request->forosh;

        $customer = new Customer;
        $customer->family = $request->family;
        $customer->phone = $request->phone;
        $customer->price = $request->gheymat;
        $customer->rahn = $request->rahn;
        $customer->ejare = $request->ejare;
        $customer->metr = $request->metr;
        $customer->tozihat = $request->tozihat;
        $customer->forosh = $forosh;
        $customer->user_id = auth()->user()->id;
        $customer->save();

        $customer->streets()->attach($request->streets);
        $request->session()->flash('message', 'مشتری با موفقیت ثبت شد.');
        return redirect('registercustomer?forosh='.$forosh);
    }

    public function showUpdate($id){
        $customer = Customer::find($id);
        $streets = Street::all();
        return view('moshtari.update_moshtari', ['customer' => $customer, 'streets' => $streets,]);
    }

    public function update(Request $request, $id){
        $forosh = $request->forosh;
        $streets = $request->streets;
        $v = $request->validate([
            'family' => 'required',
            'phone' => 'required|digits_between:0,13',
            'gheymat' => 'nullable|numeric|max:99999999.99',
            'rahn' => 'nullable|numeric|max:999999.99',
            'ejare' => 'nullable|numeric|max:999999.99',
            'metr' => 'nullable|numeric|max:999999999',
        ],[
            'family.required' => 'لطفا نام خانوادگی مشتری را وارد کنید.',
            'phone.required' => 'لطفا تلفن مشتری را وارد کنید.',
            'gheymat.digits_between' => 'قیمت را به عدد وارد کنید.',
            'metr.numeric' => 'متراژ را به عدد وارد کنید.',
            'metr.max' => 'حداکثر مقدار مجاز برای متراژ 999999999 میباشد.',
            'gheymat.numeric' => ' قیمت را به عدد وارد کنید.واحد قیمت ملیون تومان میباشد.',
            'gheymat.max' => 'واحد قیمت یک ملیون میباشد و حداکثر مقدار مجاز 99999999.99 میباشد.',
            'rahn.numeric' => ' رهن را به عدد وارد کنید.واحد رهن ملیون تومان میباشد.',
            'rahn.max' => 'واحد رهن یک ملیون میباشد و حداکثر مقدار مجاز 999999.99 میباشد.',
            'ejare.numeric' => ' اجاره را به عدد وارد کنید.واحد اجاره ملیون تومان میباشد.برای مقادیر کمتر از 1 ملیون از اعشار استفاده کنید.',
            'ejare.max' => 'واحد اجاره یک ملیون میباشد و حداکثر مقدار مجاز 999999.99 میباشد.برای مقادیر کمتر از 1 ملیون از اعشار استفاده کنید.',
        ]);

        $customer = Customer::find($id);
        $customer->family = $request->family;
        $customer->phone = $request->phone;
        $customer->price = $request->gheymat;
        $customer->metr = $request->metr;
        $customer->tozihat = trim($request->tozihat);
        $customer->forosh = $forosh;
        $customer->user_id = auth()->user()->id;
        $customer->save();

        $customer->streets()->sync($streets);

        $request->session()->flash('message', 'تغییرات با موفقیت ثبت شد.');
        return redirect('updatecustomer/' . $id);
    }

    public function list(Request $request){
        $forosh = $request->forosh;

        $price1 = $request->price1;
        $price2 = $request->price2;
        $rahn1 = $request->rahn1;
        $rahn2 = $request->rahn2;
        $ejare1 = $request->ejare1;
        $ejare2 = $request->ejare2;
        $searchbox = $request->searchbox;
        $date1 = $request->date1;
        $date2 = $request->date2;
        $streetsArr = $request->street;
        $customerNumber = $request->customerNumber;
        $customerId = false;

        if(isset($request->metr1)){
            $metr1 = Meter::find($request->metr1)->title;
        }else{
            $metr1 = -1;
        }
        if(isset($request->metr2)){
            $metr2 = Meter::find($request->metr2)->title;
        }else{
            $metr2 = -1;
        }

        if($date1 != null){
            $date1 = Verta::faToEnNumbers($date1);
            $date1 = explode('/', $date1);
            $date1 = Verta::getGregorian($date1[0], $date1[1], $date1[2]);
            $date1 = Carbon::create($date1[0], $date1[1], $date1[2]);
        }
        if($date2 != null){
            $date2 = Verta::faToEnNumbers($date2);
            $date2 = explode('/', $date2);
            $date2 = Verta::getGregorian($date2[0], $date2[1], $date2[2]);
            $date2 = Carbon::create($date2[0], $date2[1], $date2[2]);
        }

        if($request->route()->getName() == 'listmoshtari') {
//            $customers = Customer::where('forosh', $forosh)->orWhere('user_id', auth()->user()->id)
//                                      ->paginate(12);

//              $customers = Customer::whereHas('user', function(Builder $query){
//                  $query->where('role_id', 2);
//              })->orWhere('user_id', auth()->user()->id)->where('forosh', $forosh)->paginate(12);

              $customers = Customer::where('forosh', $forosh)->where(function ($query){
                  $query->whereHas('user', function(Builder $query){
                              $query->where('role_id', 2);
                          })->orWhere('user_id', auth()->user()->id);
                                                            })->orderBy('updated_at', 'DESC')->paginate(12);

        }
        elseif($request->route()->getName() == 'searchmoshtari'){

            if($customerNumber > 0 ) {

                //search by customer ID
                if (auth()->user()->can('isModir') and $forosh == 1) {
                    $customers = Customer::whereIn('id', [$customerNumber, $customerNumber])
                        ->paginate(12);
                } else {
                    $customers = Customer::whereIn('id', [$customerNumber, $customerNumber])
                                    ->where(function ($query) {
                                        $query->whereHas('user', function(Builder $query){
                                            $query->where('role_id', 2);
                                        })->orWhere('user_id', auth()->user()->id);
                                    })->paginate(12);
                }

                if(!isset($customers[0])){
                    //file not found
                    $request->session()->flash('message', " مشتری با شماره " . $customerNumber . " یافت نشد و یا شما به این مشتری دسترسی ندارید.");
                    return redirect()->back();
                } else {
                    $customerId = true;
                }

            } else {
                $customers = Customer::where('forosh', $forosh)->where(function ($query){
                                                            $query->whereHas('user', function(Builder $query){
                                                                  $query->where('role_id', 2);
                                                                    })->orWhere('user_id', auth()->user()->id);
                                                                    })
                                   ->where(function ($query) use($searchbox){
                                    $query->orWhere('phone', $searchbox)
                                        ->orWhere('family', 'LIKE', "%{$searchbox}%")
                                        ->orWhere('tozihat', 'LIKE', "%{$searchbox}%");
                                })->orderBy('updated_at', 'DESC')->paginate(12);
            }

        }elseif($request->route()->getName() == 'filtermoshtari'){

            $customers = Customer::query();
            if($metr1 != -1 and $metr2 != -1){
                $customers->whereBetween('metr', [$metr1, $metr2]);
            }elseif($metr1 != -1 and $metr2 == -1){
                $customers->where('metr', '>=', $metr1);
            }elseif($metr1 == -1 and $metr2 != -1){
                $customers->where('metr', '<=', $metr2);
            }
            if($price1 != null and $price2 != null){
                $customers->whereBetween('price', [$price1, $price2]);
            }elseif($price1 != null and $price2 == null){
                $customers->where('price', '>=', $price1);
            }elseif($price1 == null and $price2 != null){
                $customers->where('price', '<=', $price2);
            }

            if($date1 != null and $date2 != null){
                $customers->whereBetween('updated_at', [$date1, $date2]);
            }elseif($date1 != null and $date2 == null){
                $customers->where('updated_at', '>=', $date1);
            }elseif($date1 == null and $date2 != null){
                $customers->where('updated_at', '<=', $date2);
            }

            if($rahn1 != null and $rahn2 != null){
                $customers->whereBetween('rahn', [$rahn1, $rahn2]);
            }elseif($rahn1 != null and $rahn2 == null){
                $customers->where('rahn', '>=', $rahn1);
            }elseif($rahn1 == null and $rahn2 != null){
                $customers->where('rahn', '<=', $rahn2);
            }

            if($ejare1 != null and $ejare2 != null){
                $customers->whereBetween('ejare', [$ejare1, $ejare2]);
            }elseif($ejare1 != null and $ejare2 == null){
                $customers->where('ejare', '>=', $ejare1);
            }elseif($ejare1 == null and $ejare2 != null){
                $customers->where('ejare', '<=', $ejare2);
            }

            if($streetsArr != null and $streetsArr != ''){
                $customers->whereHas('streets',function (Builder $query)use($streetsArr){
                    $query->whereIn('street_id', $streetsArr);
                });
            }
//            $customers = $customers->where('forosh', $forosh)
//                ->orderBy('created_at', 'DESC')->paginate(10);

            $customers = $customers->where('forosh', $forosh)
                ->where(function ($query){
                    $query->whereHas('user', function(Builder $query){
                        $query->where('role_id', 2);
                    })->orWhere('user_id', auth()->user()->id);
                })->orderBy('updated_at', 'DESC')->paginate(12);
        }

        $customers->withPath('?forosh=' . $forosh);
        if($customerId) {
            $customers->withPath('?forosh=' . $customers[0]->forosh);
            $forosh = $customers[0]->forosh;
        }

        $pagetitle = '';
        if($forosh == 1){
            $pagetitle = 'فروش';
        } elseif($forosh ==0){
            $pagetitle = 'رهن و اجاره';
        }

        $customers->appends($_REQUEST);
        $customers->page = app('request')->input('page') == '' ? 0 : app('request')->input('page') - 1;
        $customers->page = ((($customers->page)*12) + 1);

        $metr = Meter::all();
        $street = Street::all();
        $prices = Price::all('price_title', 'price_value');
        $rahn4select = Price::all('rahn_title', 'rahn_value');
        $ejare4select = Price::all('ejare_title', 'ejare_value');
        return view('moshtari.list_moshtari', ['customers' => $customers, 'forosh' => $forosh,
                    'pagetitle' => $pagetitle, 'street' => $street, 'prices' => $prices,
                    'rahn4select' => $rahn4select,'ejare4select' => $ejare4select, 'metr' => $metr]);
    }

    public function delete($id, Request $request){
        Customer::find($id)->streets()->detach();
        Customer::find($id)->delete();
        session()->flash('message', 'مشتری حذف شد.');
        $previousUrl = app('url')->previous();
        if(Str::contains($previousUrl, 'searchmoshtari') or Str::contains($previousUrl, 'filtermoshtari') ){
            return redirect()->to($previousUrl.'?forosh='. $request->forosh);
        }
        return redirect()->to($previousUrl);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        $customer->tarikh = Verta($customer->created_at);
        $customer->tarikh = $customer->tarikh->format('H:i j-n-Y');
        $customer->update = Verta($customer->updated_at);
        $customer->update = $customer->update->format('H:i j-n-Y');

        return view('moshtari.namayesh_moshtari', ['customer' => $customer]);
    }

}
