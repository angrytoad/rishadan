<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14/10/2017
 * Time: 12:02
 */

namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
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

    /**
     * Show the collection index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.collection.index')->with([
            'user' => Auth::user(),
            'collections' => Auth::user()->collections
        ]);

    }
    
    public function view($uuid)
    {
        return view('layouts.collection.view')->with([
            'user' => Auth::user(),
            'collection' => Collection::find($uuid)
        ]);
    }
}