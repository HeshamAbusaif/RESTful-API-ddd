<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Domain\Services\Sorting;

use League\Pipeline\StageInterface;

/**
 * Description of ByField
 *
 * @author Tasneem
 */
class ByField implements StageInterface{
    
    public function __invoke($payload){
        if(isset($payload['userRequest']['sortBy'])){
            $collection = collect($payload['allResults']);
            if(isset($payload['userRequest']['sortType'])){
                if(strtolower($payload['userRequest']['sortType']) == 'asc'){
                    $sorted = $collection->sortBy($payload['userRequest']['sortBy']);
                }elseif(strtolower($payload['userRequest']['sortType']) == 'desc'){
                    $sorted = $collection->sortByDesc($payload['userRequest']['sortBy']);
                }
            }else{
                $sorted = $collection->sortBy($payload['userRequest']['sortBy']);
            }
            $payload['allResults'] = $sorted->all();
        }
        return $payload;
    }
    
}
