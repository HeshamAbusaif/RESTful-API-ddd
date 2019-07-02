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
 * Description of CreateService
 *
 * @author Tasneem
 */
class CreateService implements StageInterface {
    
    private $mainRepository;
    
    /**
     * 
     * This constructor instantiates the MainRepository (DI)
     * 
     * @param MainRepository $mainRepository
     */
    public function __construct(MainRepository $mainRepository) {
        $this->mainRepository = $mainRepository;
    }
    
    /**
     * 
     * This function is to create a new record
     * 
     * @param array $payload
     * @return mixed
     */
    public function __invoke($payload){
        return $this->mainRepository->create($payload);
    }
    
}
