<?php

namespace App\Services;

class LocalDistanceCalculator implements DistanceCalculator {

    public function zipCodesDistance($zip1, $zip2){
        $zipCodePoint1 = App\ZipCodePoint::find($zip1);
        $zipCodePoint2 = App\ZipCodePoint::find($zip2);
        return calcDist($zipCodePoint1->lat,$zipCodePoint1->long,$zipCodePoint2->lat,$zipCodePoint2->long);
    }
}

function calcDist($lat_A, $long_A, $lat_B, $long_B) { 

    $distance = sin(deg2rad($lat_A)) 
        * sin(deg2rad($lat_B)) 
        + cos(deg2rad($lat_A)) 
        * cos(deg2rad($lat_B)) 
        * cos(deg2rad($long_A - $long_B)); 

    $distance = (rad2deg(acos($distance))) * 69.09; 

    return $distance; 
}

?>
