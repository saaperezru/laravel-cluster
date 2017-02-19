<?php

namespace App\Services;

class RemoteDistanceCalculator implements DistanceCalculator {

    public function zipCodesDistance($zip1, $zip2){
        $html = file_get_contents('https://www.melissadata.com/lookups/zipdistance.asp?zip1=47683&zip2=47954');
        $patt = "/<font color=red><b>\s*([\d|\.]+)\s*<\/b><\/font>/";
        $match = [];
        preg_match($html,$patt,$match);
        if(sizeof($match) < 2){
        }else{
            return (float)$match[1];
        }
    }
}

?>
