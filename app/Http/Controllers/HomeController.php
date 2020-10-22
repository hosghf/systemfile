<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allfiles = File::count();
        $foroshcount = File::where('forosh', 1)->count();
        $ejarecount = File::where('forosh', 0)->count();
        $usercount = User::count() - 1;

        $mysalefiles = File::where('user_id', auth()->user()->id)->where('forosh', 1)->where('archive', 0)->count();
        $myrentfiles = File::where('user_id', auth()->user()->id)->where('forosh', 0)->where('archive', 0)->count();
        $myarchivefiles = File::where('user_id', auth()->user()->id)->where('forosh', 1)->where('archive', 1)->count();
        $ejarearchive = File::where('user_id', auth()->user()->id)->where('forosh', 0)->where('archive', 1)->count();


//      report
//        $users = User::all()->except([1]);
        $users = User::all()->except([1]);

        $v = \verta();
        $dayofmonth = $v->day;
        $dayofweek = $v->dayOfWeek;
        $firstofweek = Carbon::today()->subDays($dayofweek);
        $firstofmonth = Carbon::today()->subDays($dayofmonth);

        foreach ($users as $user){
            $user->todayfiles = File::whereBetween('created_at', [Carbon::today(), Carbon::now()])
                        ->where('user_id', $user->id)->count();
            $user->thisweekfiles = File::whereBetween('created_at',[$firstofweek ,Carbon::now()])
                        ->where('user_id', $user->id)->count();
            $user->thismonthfiles = File::whereBetween('created_at',[$firstofmonth ,Carbon::now()])
                        ->where('user_id', $user->id)->count();
        }

        return view('dashbord', ['foroshcount' => $foroshcount, 'ejarecount' => $ejarecount,
                                        'usercount' => $usercount, 'allfiles' => $allfiles,
                                        'mysalefiles' => $mysalefiles, 'myrentfiles' => $myrentfiles,
                                        'myarchivefiles' => $myarchivefiles, 'ejarearchive' => $ejarearchive,
                                        'users' => $users]);
    }
}
