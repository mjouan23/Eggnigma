<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Egg;

class EggController extends Controller
{
    public function show($code)
    {
        $egg = Egg::where('code', strtoupper($code))->firstOrFail();

        return view('egg.show', compact('egg'));
    }
}
