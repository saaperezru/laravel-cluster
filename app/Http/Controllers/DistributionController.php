<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
    */
    public function welcome(Request $request){
        return view('welcome', [
            'distribution' => "Input the agent's Zip codes and click on the Match Button"
        ]);
    }

    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
    */
    public function distribute(Request $request){
        return view('welcome', [
            'distribution' => $request->agent1Name
        ]);
    }
}
