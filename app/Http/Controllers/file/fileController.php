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
use App\Models\Image;
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

        if(auth()->user()->id ==4){
            $request->session()->flash('message', 'شما قادر به ثبت فای نیستید.');
            return redirect()->back();
        }

        $v = $request->validate([
            'family' => 'required',
            'phone' => 'required|digits_between:0,13',
            'metr' => 'digits_between:0,9',
            'street' => 'required',
            'gheymat' => 'nullable|numeric|max:99999999.99',
            'rahn' => 'nullable|numeric|max:999999.99',
            'ejare' => 'nullable|numeric|max:999999.99',
            'images.*' => 'mimes:png,jpg,jpeg,gif,webp',
        ],[
            'family.required' => 'لطفا نام خانوادگی مالک را وارد کنید.',
            'phone.required' => 'لطفا تلفن مالک را وارد کنید.',
            'street.required' => ' محدوده را انتخاب کنید.',
            'phone.digits_between' => 'تلفن را به عدد وارد کنید.',
            'metr.digits_between' => 'متراژ را به عدد وارد کنید.',
            'gheymat.numeric' => ' قیمت را به عدد وارد کنید.واحد قیمت ملیون تومان میباشد.',
            'gheymat.max' => 'واحد قیمت یک ملیون میباشد و حداکثر مقدار مجاز 99999999.99 میباشد.',
            'rahn.numeric' => ' رهن را به عدد وارد کنید.واحد رهن ملیون تومان میباشد.',
            'rahn.max' => 'واحد رهن یک ملیون میباشد و حداکثر مقدار مجاز 999999.99 میباشد.',
            'ejare.numeric' => ' اجاره را به عدد وارد کنید.واحد اجاره ملیون تومان میباشد.برای مقادیر کمتر از 1 ملیون از اعشار استفاده کنید.',
            'ejare.max' => 'واحد اجاره یک ملیون میباشد و حداکثر مقدار مجاز 999999.99 میباشد.برای مقادیر کمتر از 1 ملیون از اعشار استفاده کنید.',
            'images.*.mimes' => 'فرمت تصویر از نوع png, jpg, jpeg, gif باشد.',
//            'images.*.max' => 'حداکثر سایز تصویر ارسالی یک مگابایت میتواند باشد.'
        ]);

        $maskoni = $request->maskoni;
        $forosh = $request->forosh;

        $file = new File;
        $file->family = $request->family;
        $file->phone = $request->phone;
        $file->street_id = $request->street;
        $file->user_id = auth()->user()->id;
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

        //images
//        $destination= base_path().'/public/images/'.date('Y').'/'.date('m');
        $destination= '/home/sibsinii/public_html/images/'.date('Y').'/'.date('m');
        if(!is_dir($destination))
        {
            mkdir($destination,0777,true);
        }
        if ($request->hasFile('images')) {
            foreach ($request->images as $img){
                $filename = rand(1,1000).time().rand(1,10000).'.'.$img->getClientOriginalExtension();
                $img->move($destination, $filename);

                $imgrow = new Image;
                $imgrow->name = $filename;
                $file->images()->save($imgrow);
            }
        }

        $request->session()->flash('message', 'فایل با موفقیت ثبت شد.');
        return redirect('registerfile?forosh='.$forosh .'&maskoni=' . $maskoni);
//        return redirect()->back();
    }

    public function show($id){
        $file = File::find($id);
        $file->y = Carbon::createFromFormat('Y-m-d H:i:s', $file->created_at)->year;
        $file->m = Carbon::createFromFormat('Y-m-d H:i:s', $file->created_at)->month;
        $file->m = $file->m < 10 ? '0' . $file->m : $file->m;
        $file->tarikh = Verta($file->created_at);
        $file->tarikh = $file->tarikh->format('H:i j-n-Y');
        return view('files.namayesh_melk', ['file' => $file]);
    }

    public function showImages($id){
        $file = File::find($id);
        $file->y = Carbon::createFromFormat('Y-m-d H:i:s', $file->created_at)->year;
        $file->m = Carbon::createFromFormat('Y-m-d H:i:s', $file->created_at)->month;
        $file->m = $file->m < 10 ? '0' . $file->m : $file->m;
//        $images = $file->images;
        return view('files.imagesshow', ['file' => $file]);
    }

    public function deleteimage(Request $request)
    {
//        Image::find($request->id)->delete();
        $image = Image::find($request->id);

        $image->y = Carbon::createFromFormat('Y-m-d H:i:s', $image->created_at)->year;
        $image->m = Carbon::createFromFormat('Y-m-d H:i:s', $image->created_at)->month;
        $image->m = $image->m < 10 ? '0' . $image->m : $image->m;

//        $destination= base_path().'/public/images/' . $image->y . '/' . $image->m .'/';
        $destination= '/home/sibsinii/public_html/images/' . $image->y . '/' . $image->m .'/';

        unlink($destination . $image->name);

        $image->delete();

        return response()->json(array('data'=> 1), 200);
    }

    public function updateShow($id){

        $file = File::find($id);

        //for images
        $file->y = Carbon::createFromFormat('Y-m-d H:i:s', $file->created_at)->year;
        $file->m = Carbon::createFromFormat('Y-m-d H:i:s', $file->created_at)->month;
        $file->m = $file->m < 10 ? '0' . $file->m : $file->m;

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
            'phone' => 'required|digits_between:0,13',
            'metr' => 'digits_between:0,9',
            'street' => 'required',
            'gheymat' => 'nullable|numeric|max:99999999.99',
            'rahn' => 'nullable|numeric|max:999999.99',
            'ejare' => 'nullable|numeric|max:999999.99',
            'images.*' => 'mimes:png,jpg,jpeg,gif,webp',
        ],[
            'family.required' => 'لطفا نام خانوادگی مالک را وارد کنید.',
            'phone.required' => 'لطفا تلفن مالک را وارد کنید.',
            'street.required' => ' محدوده را انتخاب کنید.',
            'phone.digits_between' => 'تلفن را به عدد وارد کنید.',
            'metr.digits_between' => 'متراژ را به عدد وارد کنید.',
            'gheymat.numeric' => ' قیمت را به عدد وارد کنید.واحد قیمت ملیون تومان میباشد.',
            'gheymat.max' => 'واحد قیمت یک ملیون میباشد و حداکثر مقدار مجاز 99999999.99 میباشد.',
            'rahn.numeric' => ' رهن را به عدد وارد کنید.واحد رهن ملیون تومان میباشد.',
            'rahn.max' => 'واحد رهن یک ملیون میباشد و حداکثر مقدار مجاز 999999.99 میباشد.',
            'ejare.numeric' => ' اجاره را به عدد وارد کنید.واحد اجاره ملیون تومان میباشد.برای مقادیر کمتر از 1 ملیون از اعشار استفاده کنید.',
            'ejare.max' => 'واحد اجاره یک ملیون میباشد و حداکثر مقدار مجاز 999999.99 میباشد.برای مقادیر کمتر از 1 ملیون از اعشار استفاده کنید.',
            'images.*.mimes' => 'فرمت تصویر از نوع png, jpg, jpeg, gif باشد.',
//            'images.*.max' => 'حداکثر سایز تصویر ارسالی یک مگابایت میتواند باشد.'
        ]);

        $forosh = $request->forosh;
        $maskoni = $request->maskoni;

        $file = File::find($id);
        $file->family = $request->family;
        $file->phone = $request->phone;
        $file->street_id = $request->street;
        $file->user_id = auth()->user()->id;
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

        foreach ($file->facilities as $facility){
            $facility->delete();
        }

        $fArr = $request->facility != null ? $request->facility : [];
        if(count($fArr) > 0){
            foreach($fArr as $f){
                if($f == ''){
                    continue;
                }
                $facility = new Facility;
                $facility->value = $f;
                $file->facilities()->save($facility);
            }
        }

        //images
//        $destination= base_path().'/public/images/'.date('Y').'/'.date('m');
        $destination= '/home/sibsinii/public_html/images/'.date('Y').'/'.date('m');

        if(!is_dir($destination))
        {
            mkdir($destination,0777,true);
        }
        if ($request->hasFile('images')) {
            foreach ($request->images as $img){
                $filename = rand(1,1000).time().rand(1,10000).'.'.$img->getClientOriginalExtension();
                $img->move($destination, $filename);

                $imgrow = new Image;
                $imgrow->name = $filename;
                $file->images()->save($imgrow);
            }
        }

        $request->session()->flash('message', 'تغییرات با موفقیت اعمال شد.');
        return redirect()->back();
    }

    public function archive($id){
        $file = File::find($id);
        if($file->archive == 1){
            $file->archive = 0;
        }else{
            $file->archive = 1;
        }
        $file->save();
        session()->flash('message', 'فایل آرشیو شد.');
        return redirect()->back();
    }

    public function delete($id, Request $request){
        $file = File::find($id);
        if(!$file->images->isEmpty()){
            foreach ($file->images as $img){
                $idReq = new Request();
                $idReq->id = $img->id;
                $this->deleteimage($idReq);
            }
        }
        File::find($id)->delete();
        session()->flash('message', 'فایل حذف شد.');
        return redirect('/');
    }


}
