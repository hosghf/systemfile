<?php

namespace App\Http\Controllers\file;

use App\Http\Controllers\Controller;
use App\Models\File;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class fileSearchController extends Controller
{
    public function list(){
        $files = File::paginate(12);
        $now  = \verta();
        foreach ($files as $f){
            $f->tarikh = verta($f->created_at);
            $f->tarikh = $f->tarikh->formatDifference($now);
        }
        return view('files.list_melk', ['files' => $files, 'now' => $now]);

    }

    public function searchFilter(){

    }

}
