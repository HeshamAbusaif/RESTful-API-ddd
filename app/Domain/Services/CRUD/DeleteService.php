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
class DeleteService implements StageInterface {
    
    /**
     * 
     * This holds the Main Repository
     *
     * @var MainRepository 
     */
    private $mainRepository;
    
    /**
     * This will be constructing the MainRepository (DI)
     * 
     * @param MainRepository $mainRepository
     */
    public function __construct(MainRepository $mainRepository){
        $this->mainRepository = $mainRepository;
    }
    
    /**
     * 
     * This will be executing the deletion of an existing record
     * 
     * @param type $payload
     * @return type
     */
    public function __invoke($payload){
        return ((bool)$this->mainRepository->delete($payload['id'])) ? [
                'status' => 'not_deleted'
            ] : [
                'status' => 'deleted'
            ];
    }
    
}
