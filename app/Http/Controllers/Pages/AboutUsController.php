<?php


namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{

    public function index()
    {
        return view('layouts.about_us');
    }

}