<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;

class pagesController extends Controller
{

    public function index(){
        return view('index');
    }


}
