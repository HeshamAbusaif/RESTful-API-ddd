<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Domain\Services\Filtration;

use League\Pipeline\StageInterface;

/**
 * Description of FilterByTitle
 *
 * @author Tasneem
 */
class ByTitle implements StageInterface {
    
    /**
     * 
     * This will process the filter 
     * 
     * @param array $payload
     */
    public function __invoke($payload){
        if(isset($payload['userRequest']['title'])){
            $collection = collect($payload['allResults']);
            $filtered = $collection->filter(function ($value, $key) use ($payload) {
                if(isset($value['title'])){
                    return ((string)$value['title'] == (string)$payload['userRequest']['title']);
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