<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DistanceCalculator;

use Illuminate\Support\Facades\Storage;

class DistributionController extends Controller
{
    private $distanceCalculator;

    public function __construct(DistanceCalculator $calculator){
        $this->distanceCalculator = $calculator;
    }

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
     * Calculates and renders the distribution of 
     *
     * @param  Request A request with agent1ZipCode and agent2ZipCode values from a form
     * @return \Illuminate\Http\Response
     *
    */
    public function distribute(Request $request){
        $agents = array($request->agent1ZipCode,$request->agent2ZipCode);
        $distribution = json_encode($this->distributeContacts($agents,$this->getContacts()));
        //$test= 
        //    $this->distanceCalculator->zipCodesDistance($request->agent1ZipCode,$request->agent2ZipCode);
        return view('welcome', compact('distribution'));
    }

    private function getContacts(){
        $csv = Storage::get('contacts.csv');
        return array_map('str_getcsv', str_getcsv($csv, "\n"));
    }

    private function distributeContacts($agentsZipCodes, $contacts){
        $result = [];
        for( $i=0; $i<count($contacts); $i++ ){
            $distances = [];
            foreach($agentsZipCodes as &$zipCode){
                $distances[] = $this->distanceCalculator->zipCodesDistance($contacts[$i][1],$zipCode);
            }
            $min_indexes = array_keys($distances, min($distances));
            if(count($min_indexes) > 1){
                $result[] = array(1,$contacts[$i][0],$contacts[$i][1]);
            }else{
                $result[] = array($min_indexes[0] + 1,$contacts[$i][0],$contacts[$i][1]);
            }
        }
        return $result;
    }
}
