<?php

namespace App\Http\Controllers\Search;


use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardSearchController extends Controller
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

    public function index()
    {
        return view('layouts.search.card');
    }

    public function search(Request $request)
    {
        dd('THIS CODE NEEDS FINISHING');
    }
}