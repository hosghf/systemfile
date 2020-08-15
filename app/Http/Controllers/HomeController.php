<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
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
        $usercount = User::count();

        $mysalefiles = File::where('user_id', auth()->user()->id)->where('forosh', 1)->where('archive', 0)->count();
        $myrentfiles = File::where('user_id', auth()->user()->id)->where('forosh', 0)->where('archive', 0)->count();
        $myarchivefiles = File::where('user_id', auth()->user()->id)->where('forosh', 1)->where('archive', 1)->count();
        $ejarearchive = File::where('user_id', auth()->user()->id)->where('forosh', 0)->where('archive', 1)->count();


//        report

        return view('dashbord', ['foroshcount' => $foroshcount, 'ejarecount' => $ejarecount,
                                        'usercount' => $usercount, 'allfiles' => $allfiles,
                                        'mysalefiles' => $mysalefiles, 'myrentfiles' => $myrentfiles,
                                        'myarchivefiles' => $myarchivefiles, 'ejarearchive' => $ejarearchive]);
    }
}
