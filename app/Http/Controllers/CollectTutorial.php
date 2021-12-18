<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectTutorial extends Controller
{
    public function testCollection(){

        // $num = [2,4,6,5,3,8];
        // $col = collect($num)->average();
        // $details = collect(['name','age']);
        // return  $details->combine(['ali',22]);
        // $details = collect(['name','age',1,'jjd']);
        // return  $details->count();

        // $details = collect([1,2,4,2,1,1,3,4]); 
        // return  $details->countBy(); //=> بيشوف كل رقم متكرر كام مره

        $details = collect([1,2,4,2]); 
        return  $details->duplicates(); // => بيشوف الارقام المتكرره بس وربيقولك متكرره كام مره

        // each - transform - filter - search
    }
}
