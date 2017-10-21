<?php

namespace App\Http\Controllers\Importer;

ini_set('memory_limit','512M');

use App\Http\Controllers\Controller;

class ImporterController extends Controller
{

    public function show()
    {
        $json = json_decode(file_get_contents(base_path().'/storage/importer/extracted/AllSets-x.json'), true);
        dd($json["JOU"]);
    }

}