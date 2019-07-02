<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Domain\Services\Filtration;

use League\Pipeline\StageInterface;

/**
 * Description of FilterByDate
 *
 * @author Tasneem
 */
class ByDate implements StageInterface {
    
    /**
     * 
     * This will process the filter 
     * 
     * @param array $payload
     */
    public function __invoke($payload){
        if(isset($payload['userRequest']['date'])){
            $collection = collect($payload['allResults']);
            $filtered = $collection->filter(function ($value, $key) use ($payload) {
                if(isset($value['date'])){
                    return ((string)$value['date'] == (string)$payload['userRequest']['date']);
                }else{
                    return FALSE;
                }
            });
            $payload['allResults'] = $filtered->all();
            return $payload;
        }else{
            return $payload;
        }
    }
    
}
