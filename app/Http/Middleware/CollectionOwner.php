<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use App\Models\Collection;
use Closure;
use Illuminate\Support\Facades\Auth;


class CollectionOwner
{
    public function handle($request, Closure $next)
    {
        $collection = Collection::find($request->route('uuid'));
        if($collection && $collection->user->id === Auth::user()->id){
            return $next($request);
        }

        return redirect(route('collection'))->withErrors(['You do not have permission to access this collection']);
    }
}