<?php

use Illuminate\Database\Seeder;
use App\Models\Street;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class initializeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now('utc')->toDateTimeString();

        //streets table
        $streets = [
          ['id' => 1, 'title' => 'فرهنگ شهر', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 2, 'title' => 'معالی آباد', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 3, 'title' => 'گلدشت معالی آباد', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 4, 'title' => 'قصرالدشت', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 5, 'title' => 'قدوسی غربی', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 6, 'title' => 'قدوسی شرقی', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 7, 'title' => 'عفیف آباد', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 8, 'title' => 'زرگری', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 9, 'title' => 'پاسداران', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 10, 'title' => 'تاچارا', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 11, 'title' => 'دینکان', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 12, 'title' => 'کوی وحدت', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 13, 'title' => 'صنایع', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 14, 'title' => ' شهرک باهنر', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 15, 'title' => ' شهرک بهشتی', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 16, 'title' => ' شهرک حافظ', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 17, 'title' => ' شهرک گلستان', 'created_at'=> $now, 'updated_at'=> $now],
          ['id' => 18, 'title' => 'سایر', 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach ($streets as $st) {
            DB::table('streets')->insert($st);
        }

        //buildingDirection table
        $direction = [
            ['id' => 1, 'title' => 'شمالی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'جنوبی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => 'شرقی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => 'غربی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => 'شمالی/جنوبی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 6, 'title' => ' شرقی/غربی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 7, 'title' => ' شمالی/شرقی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 8, 'title' => ' شمالی/غربی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 9, 'title' => ' جنوبی/شرقی', 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 10, 'title' => ' جنوبی/غربی', 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($direction as $dir){
            DB::table('building_directions')->insert($dir);
        }

        $cabibets = [
            ['id' => 1, 'title' => 'Mdf' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'فلز' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => 'های گلاس' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => 'استارون' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => 'سایر' , 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($cabibets as $cab){
            DB::table('cabinets')->insert($cab);
        }

        $heatings = [
            ['id' => 1, 'title' => 'بخاری' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'شوفاژ' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => ' چیلر' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => 'شومینه' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => 'سایر' , 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($heatings as $heating){
            DB::table('heatings')->insert($heating);
        }

        $roles = [
            ['id' => 1, 'title' => 'admin' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'مدیر' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => ' مشاور فروش و اجاره' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => 'مشاور فروش' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => 'مشاور رهن و اجاره' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 6, 'title' => 'منشی' , 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($roles as $role){
            DB::table('roles')->insert($role);
        }
        $users = [
            ['id' => 1, 'name' => 'admin', 'family' => 'admin', 'username' => 'admin','phone' => '09876543212','password' => Hash::make('admin'), 'role_id' => 1 , 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($users as $user){
            DB::table('users')->insert($user);
        }

        $coolings = [
            ['id' => 1, 'title' => 'کولر' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'اسپلیت' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => ' چیلر' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => 'سایر' , 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($coolings as $cooling){
            DB::table('coolings')->insert($cooling);
        }

        $floors = [
            ['id' => 1, 'title' => 'سرامیک' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'موزاییک' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => ' موکت' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => 'لمینت' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => 'کف پوش' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 6, 'title' => 'پارکت' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 7, 'title' => 'سایر' , 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($floors as $floor){
            DB::table('floors')->insert($floor);
        }

        $meters = [
            ['id' => 1, 'title' => 'کمتر از 100 متر' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => ' 100 تا 150 متر' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => '150 تا 200 متر' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => '200 تا 300 متر' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => 'بیشتر از 300 متر' , 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($meters as $meter){
            DB::table('meters')->insert($meter);
        }

        $sanad = [
            ['id' => 1, 'title' => 'ملکی' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'اوقاف' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => 'بدون سند' , 'created_at'=> $now, 'updated_at'=> $now]
        ];
        foreach($sanad as $s){
            DB::table('sanad')->insert($s);
        }

        $rooms = [
            ['id' => 1, 'title' => 'بدون اتاق' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => '1' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => '2' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => '3' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => '4' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 6, 'title' => '5' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 7, 'title' => 'بیشتر از 5' , 'created_at'=> $now, 'updated_at'=> $now]
        ];
        foreach($rooms as $r){
            DB::table('rooms')->insert($r);
        }

        $tabaghe = [
            ['id' => 1, 'title' => 'زیر همکف' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'همکف' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => '1' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => '3' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => '4' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 6, 'title' => '5' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 7, 'title' => '6' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 8, 'title' => '7' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 9, 'title' => '8' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 10, 'title' => '9' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 11, 'title' => '10' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 12, 'title' => '11' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 13, 'title' => '12' , 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 14, 'title' => 'بیشتر از 12' , 'created_at'=> $now, 'updated_at'=> $now]
        ];
        foreach($tabaghe as $t){
            DB::table('tabaghe')->insert($t);
        }

        $categories = [
            ['id' => 1, 'title' => 'آپارتمان' , 'tejary' => 0, 'ejare'=> 1, 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 2, 'title' => 'خانه و ویلا' , 'tejary' => 0, 'ejare'=> 1, 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 3, 'title' => ' زمین و کلنگی' , 'tejary' => 0, 'ejare'=> 0, 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 4, 'title' => ' دفتر کار/مطب' , 'tejary' => 1, 'ejare'=> 1, 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 5, 'title' => ' مغازه و غرفه' , 'tejary' => 1, 'ejare'=> 1, 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 6, 'title' => 'زمین تجاری' , 'tejary' => 1, 'ejare'=> 0, 'created_at'=> $now, 'updated_at'=> $now],
            ['id' => 7, 'title' => 'صنعتی/کشاورزی' , 'tejary' => 1, 'ejare'=> 1, 'created_at'=> $now, 'updated_at'=> $now]
        ];
        foreach($categories as $c){
            DB::table('categories')->insert($c);
        }

        $files = [
            ['id' => 1, 'family' => 'حمیدی' , 'phone' => '98987987', 'street_id'=> 1, 'user_id'=> 1, 'cat_id'=> 1, 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($files as $c){
            DB::table('files')->insert($c);
        }

        $comments = [
            ['id' => 1, 'text' => 'asdfsafsa safdhslkfh sa' , 'user_id' => '1', 'file_id' => '1', 'created_at'=> $now, 'updated_at'=> $now],
        ];
        foreach($comments as $c){
            DB::table('comments')->insert($c);
        }

    }
}
