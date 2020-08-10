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
    public function registerIndex(){

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
        return view('files.sabte_melk', ['category' => $category, 'street' => $street, 'sanads' => $sanad,
                                            'directions' => $directions, 'year' => $year, 'rooms' => $rooms,
                                            'tabaghe' => $tabaghe, 'heatings' => $heatings, 'coolings' => $coolings,
                                            'kaf' => $kaf, 'cabinets' => $cabinet ]);
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

        $file = new File;
        $file->family = $request->family;
        $file->phone = $request->phone;
        $file->street_id = $request->street;
        $file->user_id = 1;
        $file->address = $request->address;
        $file->cat_id = $request->daste;
        $file->metr = $request->metr;
        $file->price = $request->gheymat;
        $file->forosh = 1;
        $file->maskoni = 1;
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
//        $file->save();

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
        return redirect('/registerfile');

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

        $file = File::find($id);
        $file->family = $request->family;
        $file->phone = $request->phone;
        $file->street_id = $request->street;
        $file->user_id = 1;
        $file->address = $request->address;
        $file->cat_id = $request->daste;
        $file->metr = $request->metr;
        $file->price = $request->gheymat;
        $file->forosh = 1;
        $file->maskoni = 1;
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
