<?php

namespace App\Http\Controllers\Search;


use App\Http\Controllers\Controller;
use App\Models\Card;
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
        $request->flash();
        $request->validate([
            'search' => 'required|string|min:4',
        ]);
        $search = $request->get('search');
        $results = Card::where('name', 'LIKE', "%$search%")->orderBy('name','ASC')->get();
        return view('layouts.search.card', [
            'results' => $results
        ]);
    }
}