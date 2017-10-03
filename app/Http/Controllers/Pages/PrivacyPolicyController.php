<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller
{

    public function index()
    {
        return view('layouts.privacy_policy');
    }

}
