<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NightModeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  boolean $on_off
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $on_off)
    {
        session()->put('nightmode', $on_off);

        return redirect()->back();
    }
}