<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return \App::make('auth0')->login(null, null, ['scope' => 'openid profile email'], 'code');
    }
    public function logout()
    {
        \Auth::logout();
        return  \Redirect::intended('/');
    }
    public function dump()
    {
        $isLoggedIn = \Auth::check();
        return view('dump')
            ->with('isLoggedIn', $isLoggedIn)
            ->with('user',\Auth::user()->getUserInfo())
            ->with('accessToken',\Auth::user()->getAuthPassword());
    }
}
