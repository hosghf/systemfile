<?php

namespace App\Http\Controllers\file;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Meter;
use App\Models\Price;
use App\Models\Room;
use App\Models\Street;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Gate;

class fileSearchController extends Controller
{
    public function filter(Request $request){

        $forosh = $request->forosh;
        $sakht = $request->sakht;
        if (auth()->user()->can('isEjare') and ($forosh == 1 || $sakht > 0 ) ){
            $forosh = 0;
            $sakht = 0;
            session()->flash('message', 'شما به فایل های فروش دسترسی ندارید.');
        }
        if (auth()->user()->can('isForosh') and $forosh == 0){
            $forosh = 1;
            session()->flash('message', 'شما به فایل های اجاره دسترسی ندارید.');
        }
        $maskoni = $request->maskoni;

        $searchbox = $request->searchbox;
        $cat_id = $request->category;
        $price1 = $request->price1;
        $price2 = $request->price2;
        $rahn1 = $request->rahn1;
        $rahn2 = $request->rahn2;
        $ejare1 = $request->ejare1;
        $ejare2 = $request->ejare2;
        $room = $request->room;

        $date1 = $request->date1;
        $date2 = $request->date2;
        $yeardif = $request->year;
        $streetsArr = $request->street;
        $fileid = $request->fileid;
        $fileNumSign = false;

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

        //query
        if($request->route()->getName() == 'filterfile'){

            $files = File::query();

//            $files = $files->where('forosh', $forosh)->where('maskoni', $maskoni)
//                ->where('archive', 0);

            if (auth()->user()->can('isModir')) { //only admin can see files with user with role_id 6
                $files = $files->where('forosh', $forosh)
                    ->where('maskoni', $maskoni)
                    ->where('sakht', $sakht)
                    ->where('archive', 0);
            } else {
                $files = File::with('user')->whereHas('user', function($q) {
                    $q->where('role_id', '!=', 6);
                })->where('forosh', $forosh)
                    ->where('maskoni', $maskoni)
                    ->where('sakht', $sakht)
                    ->where('archive', 0);
            }

            if($metr1 != -1 and $metr2 != -1){
                $files->whereBetween('metr', [$metr1, $metr2]);
            }elseif($metr1 != -1 and $metr2 == -1){
                $files->where('metr', '>=', $metr1);
            }elseif($metr1 == -1 and $metr2 != -1){
                $files->where('metr', '<=', $metr2);
            }

            if($price1 != null and $price2 != null){
                $files->whereBetween('price', [$price1, $price2]);
            }elseif($price1 != null and $price2 == null){
                $files->where('price', '>=', $price1);
            }elseif($price1 == null and $price2 != null){
                $files->where('price', '<=', $price2);
            }

            if($date1 != null and $date2 != null){
                $files->whereBetween('updated_at', [$date1, $date2]);
            }elseif($date1 != null and $date2 == null){
                $files->where('updated_at', '>=', $date1);
            }elseif($date1 == null and $date2 != null){
                $files->where('updated_at', '<=', $date2);
            }

            if($rahn1 != null and $rahn2 != null){
                $files->whereBetween('rahn', [$rahn1, $rahn2]);
            }elseif($rahn1 != null and $rahn2 == null){
                $files->where('rahn', '>=', $rahn1);
            }elseif($rahn1 == null and $rahn2 != null){
                $files->where('rahn', '<=', $rahn2);
            }
            if($ejare1 != null and $ejare2 != null){
                $files->whereBetween('ejare', [$ejare1, $ejare2]);
            }elseif($ejare1 != null and $ejare2 == null){
                $files->where('ejare', '>=', $ejare1);
            }elseif($ejare1 == null and $ejare2 != null){
                $files->where('ejare', '<=', $ejare2);
            }

            if($yeardif != null){
                $thisyear = verta()->year;
                $yeardif = $thisyear - $yeardif;
                $files->where('year', '>=', $yeardif);
            }

            if($streetsArr != null and $streetsArr != ''){
                $files->where(function ($query)use($streetsArr){
                    foreach ($streetsArr as $street){
                        $query->orWhere('street_id', $street);
                    }
                });
            }

            if($cat_id != null){
                $files->where('cat_id', $cat_id);
            }

            if($room != null) {
                $files->where('room_id', $room);
            }

            $files = $files->orderBy('updated_at', 'DESC')->paginate(12);
//            return redirect()->back();

        } elseif ($request->route()->getName() == 'listfile'){

            if (auth()->user()->can('isModir')) { //only admin can see files with user with role_id 6
                $files = File::where('forosh', $forosh)->where('maskoni', $maskoni)
                    ->where('archive', 0)->where('sakht', $sakht)
                                        ->orderBy('updated_at', 'DESC')->paginate(12);
            } else {
                $files = File::with('user')->whereHas('user', function($q) {
                    $q->where('role_id', '!=', 6);
                })->where('forosh', $forosh)
                    ->where('maskoni', $maskoni)
                    ->where('sakht', $sakht)
                    ->where('archive', 0)
                    ->orderBy('updated_at', 'DESC')->paginate(12);
            }


        }elseif ($request->route()->getName() == 'searchfile'){

            if($fileid > 0 ){
                //search by ID
                $files = File::whereIn('id', [$fileid, $fileid])
                    ->where('archive', 0)->paginate();

                if(isset($files[0])) {
                    if (auth()->user()->can('isEjare') and ($files[0]->forosh == 1 || $files[0]->sakht > 0) ) {
                        $request->session()->flash('message', "شما به این فایل دسترسی ندارید");
                        return redirect()->back();
                    } elseif (auth()->user()->can('isForosh') and $files[0]->forosh == 0) {
                        $request->session()->flash('message', "شما به این فایل دسترسی ندارید");
                        return redirect()->back();
                    } elseif (!auth()->user()->can('isModir') and $files[0]->user->role_id == 6 ) {
                        $request->session()->flash('message', "شما به این فایل دسترسی ندارید");
                        return redirect()->back();
                    }
                } else{
                    //file not found
                    $request->session()->flash('message', " فایل با شماره " . $fileid . " یافت نشد.");
                    return redirect()->back();
                }

                $fileNumSign = true;

            } else{
                if(auth()->user()->can('isModir') ){ //just admin user cuold see files with role_id 6
                    $files = File::where(function ($query) use($forosh, $maskoni, $sakht){
                        $query->where('forosh', $forosh)
                            ->where('maskoni', $maskoni)
                            ->where('sakht', $sakht)
                            ->where('archive', 0);
                    })->where(function ($query) use($searchbox,$cat_id){
                        $query->orWhere('phone', $searchbox)
                            ->orWhere('family', $searchbox)
                            ->orWhere('address', 'LIKE', "%{$searchbox}%")
                            ->orWhere('tozihat', 'LIKE', "%{$searchbox}%");
                    })->orderBy('updated_at', 'DESC')->paginate(12);
                } else {
                    $files = File::where(function ($query) use($forosh, $maskoni, $sakht){
                        $query->with('user')->whereHas('user', function($q) {
                            $q->where('role_id', '!=', 6);
                        })->where('forosh', $forosh)
                            ->where('maskoni', $maskoni)
                            ->where('sakht', $sakht)
                            ->where('archive', 0);
                    })->where(function ($query) use($searchbox,$cat_id){
                        $query->orWhere('phone', $searchbox)
                            ->orWhere('family', $searchbox)
                            ->orWhere('address', 'LIKE', "%{$searchbox}%")
                            ->orWhere('tozihat', 'LIKE', "%{$searchbox}%");
                    })->orderBy('updated_at', 'DESC')->paginate(12);
                }

            }
        }

        $prices = Price::all('price_title', 'price_value');
        $rahn4select = Price::all('rahn_title', 'rahn_value');
        $ejare4select = Price::all('ejare_title', 'ejare_value');
        $street = Street::all();
        $now  = \verta();
        $metr = Meter::all();
        $rooms = Room::all();
        foreach ($files as $f){
            //change date to persian date
            $f->tarikh = verta($f->updated_at);
            $f->tarikh = $f->tarikh->formatDifference($now);

            //address
            if(strlen($f->address) > 0){
                $f->limitedAddress = mb_substr($f->address,0,14,'utf-8') . " ... ";
            }
        }

        $files->withPath('?forosh=' . $forosh . '&maskoni=' . $maskoni);
        //set the forosh and maskoni var to the file value
        if($fileNumSign){
            $files->withPath('?forosh=' . $files[0]->forosh . '&maskoni=' . $files[0]->maskoni);
            $forosh = $files[0]->forosh;
            $maskoni = $files[0]->maskoni;
        }

        $pagetitle = '';
        $category = '';
        if( $forosh == 1 ) {
            $pagetitle = "فروش";
        } elseif($forosh == 0){
            $pagetitle = "رهن و اجاره";
        }
        $pagetitle = $pagetitle . " / ";
        if( $maskoni == 1 ) {
            $pagetitle = $pagetitle . " مسکونی ";
            if($forosh == 0){
                $category = Category::where('tejary', 0)->where('ejare', '1')->get();//forosh maskony only
            } else {
                $category = Category::where('tejary', 0)->get();//forosh maskony only
            }
        } elseif($maskoni == 0){
            $pagetitle = $pagetitle ." تجاری ";
            if($forosh == 0){
                $category = Category::where('tejary', 1)->where('ejare', '1')->get();//forosh maskony only
            }else{
                $category = Category::where('tejary', 1)->get();//forosh maskony only
            }
        }
        if($sakht == 1){
            $pagetitle = "مشارکت در ساخت";
        }

        $files->appends($_REQUEST);

        return view('files.list_melk', ['files' => $files, 'forosh' => $forosh, 'sakht' => $sakht,
            'maskoni' => $maskoni, 'pagetitle' => $pagetitle, 'category' => $category,
            'street' => $street,'metr' => $metr, 'prices' => $prices, 'rooms' => $rooms,
            'rahn4select' => $rahn4select,'ejare4select' => $ejare4select, 'oldcategory' => $request->category]);
    }

}
