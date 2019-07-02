<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Domain\Services\Responses;

use League\Pipeline\StageInterface;
use Illuminate\Http\Response;

/**
 * Description of ProperResponseService
 *
 * @author Tasneem
 */
class ProperResponse implements StageInterface{
    
    /**
     * 
     * This function will return the proper response as JSON payload
     * 
     * @param array $payload
     * @return Response
     */
    public function __invoke($payload){
        return (new Response($payload, 200))
            ->header('Content-Type', 'application/json');
    }
    
}
