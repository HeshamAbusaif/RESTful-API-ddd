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
 * Description of ProperError
 * 
 * This class returns the Proper Error to the Consumer
 *
 * @method __construct
 * @method __invoke
 * 
 * @author Tasneem
 */
class ProperError implements StageInterface {
    
    /**
     * 
     * This function will return the proper response as JSON payload
     * 
     * @param array $payload
     * @return Response
     */
    public function __invoke($payload){
        return (new Response(['error' => [
            $payload->getMessage(), 
            $payload->getLine(), 
            $payload->getFile(), 
            $payload->getCode()
        ]], 500))
            ->header('Content-Type', 'application/json');
    }
    
}
