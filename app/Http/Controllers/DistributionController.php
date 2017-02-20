<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AgentsDistributor;

use Illuminate\Support\Facades\Storage;

class DistributionController extends Controller
{
    private $distributor;

    public function __construct(AgentsDistributor $calculator){
        $this->distributor = $calculator;
    }

    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
    */
    public function welcome(Request $request){
        return view('welcome', [
            'distribution' => array(),
            'agent1ZipCode' => "",
            'agent2ZipCode' => ""
        ]);
    }

    /**
     * Calculates and renders the distribution of 
     *
     * @param  Request A request with agent1ZipCode and agent2ZipCode values from a form
     * @return \Illuminate\Http\Response
     *
    */
    public function distribute(Request $request){
        $agents = array($request->agent1ZipCode,$request->agent2ZipCode);
        $distribution = $this->distributeContacts($agents,$this->getContacts());
        return view('welcome', [
            'distribution' => $distribution,
            'agent1ZipCode' => $agents[0],
            'agent2ZipCode' => $agents[1]
        ]);
    }

    private function getContacts(){
        $csv = Storage::get('contacts.csv');
        return array_map('str_getcsv', str_getcsv($csv, "\n"));
    }

    private function distributeContacts($agents,$contacts){
        return $this->distributor->distributeContacts($agents,$contacts);
    }
}
