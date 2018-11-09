<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NightModeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        session()->put('nightmode', $request->input('on_off', 'true'));

        return redirect()->back();
    }
}
