<?php

namespace App\Services;

use DistanceCalculator;

class BiasedAgentsDistributor implements AgentsDistributor {

    public function distributeContacts($agentsZipCodes, $contacts){

        $distanceCalculator = resolve('App\Services\DistanceCalculator');
        $result = [];
        for( $i=0; $i<count($contacts); $i++){
            $distances = [];
            foreach($agentsZipCodes as &$zipCode){
                $distances[] = $distanceCalculator->zipCodesDistance($contacts[$i][1],$zipCode);
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

?>
