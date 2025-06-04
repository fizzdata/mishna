<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MainController extends Controller
{
       public function index(){


        return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);

    }

    public function home($family_id)
    {
        $family = DB::table('family')->where('uid', $family_id)->first();

    //    dump($family);

        if (!$family) {
          // dd(DB::table('family')->get('uuid'));
            abort(404, 'Family not found');
        }


        return Inertia::render('Mishna', [
            'family' => $family,
        ]);
    }

}
