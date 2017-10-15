<?php

namespace App\Http\Controllers\Collection;


use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
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

    public function post_create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $collection = new Collection();
        $collection->user_id = Auth::user()->id;
        $collection->name = $request->get('name');
        $collection->save();

        return response()->json([
            'uuid' => $collection->id
        ]);
        
    }

    public function delete(Request $request, $uuid)
    {
        $collection = Collection::find($uuid);
        $collection->delete();
    }
}