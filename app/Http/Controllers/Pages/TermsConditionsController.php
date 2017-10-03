<?php


namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class TermsConditionsController extends Controller
{

    public function index()
    {
        return view('layouts.terms_and_conditions');
    }

}