<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentController extends Controller
{
    public function index(){
        return view("admin.registroventa");
    }
}
