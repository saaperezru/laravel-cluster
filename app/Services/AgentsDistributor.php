<?php

namespace App\Services;

interface AgentsDistributor {

    /**
     * Distribute contacts among agents based on their zipcode and using 
     * the configured DistanceCalculator.
     *
     * @param  agentsZipCodes A list of zip codes of each agent.
     * @param  contastList An array of tuples name,zipCode.
     * @return An array of triples agentIndex,contactName,contactZipCode
     *
    */
    public function distributeContacts($agentsZipCodes , $contactsList);
}

?>
