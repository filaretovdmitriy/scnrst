<?php


namespace App\Http\Controllers;

use App\Models\Script;
use Illuminate\Http\Request;

class ScriptController extends Controller

{
    public function index()
    {
        $scripts = Script::all();
        return response()->json($scripts);


    }

}
