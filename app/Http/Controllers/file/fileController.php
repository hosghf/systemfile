<?php

namespace App\Http\Controllers\file;

use App\Http\Controllers\Controller;
use App\Models\BuildingDirection;
use App\Models\Cabinet;
use App\Models\Category;
use App\Models\Cooling;
use App\Models\Facility;
use App\Models\File;
use App\Models\Floor;
use App\Models\Heating;
use App\Models\Room;
use App\Models\Sanad;
use App\Models\Street;
use App\Models\Tabaghe;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class fileController extends Controller
{
    public function registerIndex(Request $request){

        $maskoni = $request->maskoni;
        $forosh = $request->forosh;
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
        $street = Street::all();
        $sanad = Sanad::all();
        $directions = BuildingDirection::all();
        $year = verta()->year;
        $rooms = Room::all();
        $tabaghe = Tabaghe::all();
        $heatings = Heating::all();
        $coolings = Cooling::all();
        $kaf = Floor::all();
        $cabinet = Cabinet::all();
        return view('files.sabte_melk', ['category' => $category, 'street' => $street, 'sanads' => $sanad,
                                            'directions' => $directions, 'year' => $year, 'rooms' => $rooms,
                                            'tabaghe' => $tabaghe, 'heatings' => $heatings, 'coolings' => $coolings,
                                            'kaf' => $kaf, 'cabinets' => $cabinet,'maskoni' => $maskoni,
                                                'forosh' => $forosh, 'pagetitle' => $pagetitle]);
    }

    public function registerStore(Request $request){

        $v = $request->validate([
            'family' => 'required',
            'phone' => 'required',
            'street' => 'required'
        ],[
            'family.required' => 'لطفا نام خانوادگی مالک را وارد کنید.',
            'phone.required' => 'لطفا تلفن مالک را وارد کنید.',
            'street.required' => ' محدوده را انتخاب کنید.',
        ]);

        $maskoni = $request->maskoni;
        $forosh = $request->forosh;

        $file = new File;
        $file->family = $request->family;
        $file->phone = $request->phone;
        $file->street_id = $request->street;
        $file->user_id = 1;
        $file->address = $request->address;
        $file->cat_id = $request->daste;
        $file->metr = $request->metr;
        $file->price = $request->gheymat;
        $file->rahn = $request->rahn;
        $file->ejare = $request->ejare;
        $file->forosh = $forosh;
        $file->maskoni = $maskoni;
        $file->year = $request->year;
        $file->cabinet_id = $request->cabinet;
        $file->floor_id = $request->kaf;
        $file->room_id = $request->room;
        $file->tabaghe_id = $request->tabaghe;
        $file->kole_tabaghat = $request->kole_tabaghat;
        $file->heating_id = $request->garmayesh;
        $file->cooling_id = $request->sarmayesh;
        $file->sanad_id = $request->sanad;
        $file->direction_id = $request->direction;
        $file->parking = $request->parking;
        $file->anbari = $request->anbari;
        $file->asansor = $request->asansor;
        $file->tozihat = $request->tozihat;
        $file->save();

        $fArr = $request->facility;
        if(!is_null($fArr)){
            foreach ($fArr as $f){
                $facility = new Facility;
                $facility->value = $f;
                $facility->file_id = $file->id;
                $facility->save();

            }
        }

        $request->session()->flash('message', 'فایل با موفقیت اضافه شد.');
        return redirect('/registerfile?forosh='.$forosh .'&maskoni=' . $maskoni);

    }

    public function show($id){
        $file = File::find($id);
        return view('files.namayesh_melk', ['file' => $file]);
    }

    public function updateShow($id){

        $file = File::find($id);

        $category = Category::where('tejary', 0)->get();//forosh maskony only
        $street = Street::all();
        $sanad = Sanad::all();
        $directions = BuildingDirection::all();
        $year = verta()->year;
        $rooms = Room::all();
        $tabaghe = Tabaghe::all();
        $heatings = Heating::all();
        $coolings = Cooling::all();
        $kaf = Floor::all();
        $cabinet = Cabinet::all();
        return view('files.update_melk', ['category' => $category, 'street' => $street, 'sanads' => $sanad,
            'directions' => $directions, 'year' => $year, 'rooms' => $rooms,
            'tabaghe' => $tabaghe, 'heatings' => $heatings, 'coolings' => $coolings,
            'kaf' => $kaf, 'cabinets' => $cabinet, 'file' => $file ]);
    }

    public function update(Request $request,$id){
        $v = $request->validate([
            'family' => 'required',
            'phone' => 'required',
            'street' => 'required'
        ],[
            'family.required' => 'لطفا نام خانوادگی مالک را وارد کنید.',
            'phone.required' => 'لطفا تلفن مالک را وارد کنید.',
            'street.required' => ' محدوده را انتخاب کنید.',
        ]);

        $forosh = $request->forosh;
        $maskoni = $request->maskoni;

        $file = File::find($id);
        $file->family = $request->family;
        $file->phone = $request->phone;
        $file->street_id = $request->street;
        $file->user_id = 1;
        $file->address = $request->address;
        $file->cat_id = $request->daste;
        $file->metr = $request->metr;
        $file->price = $request->gheymat;
        $file->rahn = $request->rahn;
        $file->ejare = $request->ejare;
        $file->forosh = $forosh;
        $file->maskoni = $maskoni;
        $file->year = $request->year;
        $file->cabinet_id = $request->cabinet;
        $file->floor_id = $request->kaf;
        $file->room_id = $request->room;
        $file->tabaghe_id = $request->tabaghe;
        $file->kole_tabaghat = $request->kole_tabaghat;
        $file->heating_id = $request->garmayesh;
        $file->cooling_id = $request->sarmayesh;
        $file->sanad_id = $request->sanad;
        $file->direction_id = $request->direction;
        $file->parking = $request->parking;
        $file->anbari = $request->anbari;
        $file->asansor = $request->asansor;
        $file->tozihat = $request->tozihat;
        $file->save();

//        $fArr = $request->facility;
//        if(count($fArr) > 0){
//            foreach($fArr as $f){
//                $facility = new Facility;
//                $facility->value = $f;
//                $facility->file_id = $file->id;
//                $facility->save();
//
//            }
//        }

        $request->session()->flash('message', 'تغییرات با موفقیت اعمال شد.');
        return redirect()->back();
    }

    public function archive($id){
        $file = File::find($id);
        $file->archive = 1;
        $file->save();
        session()->flash('message', 'فایل آرشیو شد.');
        return redirect()->back();
    }

    public function delete($id){
        File::find($id)->delete();
        session()->flash('message', 'فایل حذف شد.');
        return redirect('/listfile');
    }


}
