<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class RemoteDistanceCalculator implements DistanceCalculator {

    private $sites = array(array('https://www.melissadata.com/lookups/zipdistance.asp?zip1=%s&zip2=%s',"/<font color=red><b>\s*([\d|\.]+)\s*<\/b><\/font>/"),
        array('http://distancecheck.com/zipcode-distance.php?start=%s&end=%s&key=26876292-a984-4ead-9f69-caf26e9c3f2e&submit=Calculate+Distance','/([\d|\.]+) miles /'),
        array('http://www.allplaces.us/dbz.cgi?z1=%s&z2=%s','/is located\s*([\d|\.]+)\s*miles/')
    );

    public function zipCodesDistance($zip1, $zip2){
        $site = $this->sites[1];
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
