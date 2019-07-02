<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Domain\Services\CRUD;

use League\Pipeline\StageInterface;
use App\Domain\Repositories\Main as MainRepository;

/**
 * Description of SearchService
 *
 * @author Tasneem
 */
class SearchService implements StageInterface {
    
    /**
     *
     * @var MainRepository holds the main repository
     */
    private $mainRepository;
    
    /**
     * This constructor initializes the main repository (DI)
     * 
     * @param MainRepository $mainRepository
     */
    public function __construct(MainRepository $mainRepository){
        $this->mainRepository = $mainRepository;
    }
    
    /**
     * 
     * This gets all records from the repository
     * 
     * @param type $payload
     * @return type
     */
    public function __invoke($payload){
        $payload['allResults'] = $this->mainRepository->all();
        return $payload;
    }
    
}
