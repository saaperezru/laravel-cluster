<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class RemoteDistanceCalculator implements DistanceCalculator {


    private function getSites(){
        $MELISSA_URL = 'https://www.melissadata.com/lookups/zipdistance.asp?zip1=%s&zip2=%s';
        $MELISSA_REGEX = "/<font color=red><b>\s*([\d|\.]+)\s*<\/b><\/font>/";

        $GOOGLE_URL = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=%s,USA&destinations=%s,USA&key='.env('GOOGLE_KEY');
        $GOOGLE_REGEX = '/([\d|\.]+)\s*km"/';

        $ZIPCODE_URL = 'https://www.zipcodeapi.com/rest/'.env('ZIPCODE_KEY').'/distance.json/%s/%s/km';
        $ZIPCODE_REGEX = '([\d|\.]+)';

        $DISTANCE_CHECK_URL = 'http://distancecheck.com/zipcode-distance.php?start=%s&end=%s&key=26876292-a984-4ead-9f69-caf26e9c3f2e&submit=Calculate+Distance';
        $DISTANCE_CHECK_REGEX = '/([\d|\.]+) miles /';

        $ALLPLACES_URL = 'http://www.allplaces.us/dbz.cgi?z1=%s&z2=%s';
        $ALLPLACES_REGEX = '/is located\s*([\d|\.]+)\s*miles/';

        return array(
            "MELISSA" => array($MELISSA_URL, $MELISSA_REGEX),
            "GOOGLE" => array($GOOGLE_URL,$GOOGLE_REGEX),
            "ZIPCODE" => array($ZIPCODE_URL,$ZIPCODE_REGEX),
            "DISTANCE_CHECK" => array($DISTANCE_CHECK_URL,$DISTANCE_CHECK_REGEX),
            "ALLPLACES" => array($ALLPLACES_URL,$ALLPLACES_REGEX),
    );
    }

    public function zipCodesDistance($zip1, $zip2){
        $site = $this->getSites()["GOOGLE"];
        $url = sprintf($site[0],$zip1,$zip2);
        Log::info($url);
        $html = file_get_contents($url);
        $match = [];
        preg_match($site[1],$html,$match);
        if(sizeof($match) < 2){
            return -1;
        }else{
            Log::info("zipCodeDistance(".$zip1.",".$zip2.") = ".$match[1]);
            return (float)$match[1];
        }
    }
}

?>
