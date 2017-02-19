<?php

namespace App\Services;

interface DistanceCalculator {
    public function zipCodesDistance($zip1, $zip2);
}

?>
