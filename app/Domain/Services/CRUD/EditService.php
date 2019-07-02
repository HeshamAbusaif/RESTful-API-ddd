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
 * Description of EditService
 *
 * @author Tasneem
 */
class EditService implements StageInterface {
    
    /**
     *
     * @var MainRepository holds the main repository
     */
    private $mainRepository;
    
    /**
     * 
     * The constructor holds the main repository
     * 
     * @param MainRepository $mainRepository
     */
    public function __construct(MainRepository $mainRepository){
        $this->mainRepository = $mainRepository;
    }
    
    /**
     * 
     * This function picks a record from the database to be edited
     * 
     * @param array $payload
     * @return mixed
     */
    public function __invoke($payload){
        return $this->mainRepository->byId($payload['id']);
    }
    
}
