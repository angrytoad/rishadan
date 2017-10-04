<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use Closure;


class EmailVerified
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->verified) {
            return $next($request);
        }

        $loginController = new LoginController();
        $loginController->logout($request);

        session(['message' => 'Account not verified, have you recieved the verification email?']);
        return redirect('/verified');
    }
}