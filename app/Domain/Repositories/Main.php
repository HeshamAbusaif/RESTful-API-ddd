<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Domain\Repositories;

use App\Domain\Models\Main as MainModel;

/**
 * Description of CreateRepository
 * 
 * This repository will be acting with the main functionality
 * of the CRUD operations, filtration, and sorting mechanisms
 * 
 * @method __construct
 * @method all
 * @method create
 * @method update
 * @method delete
 * @method byId
 *
 * @author Tasneem
 */
class Main {
    
    /**
     *
     * @var MainModel holds the Main Model
     */
    private $mainModel;
    
    /**
     * 
     * This constructor initializes the Main Model
     * 
     * @param Main $main
     */
    public function __construct(MainModel $main){
        $this->mainModel = $main;
    }
    
    /**
     * 
     * This will return all the results
     * 
     * @return mixed
     */
    public function all(){
        return $this->mainModel->all();
    }
    
    /**
     * 
     * This will create a new record
     * 
     * @param array $newData
     * @return mixed
     */
    public function create(array $newData){
        return $this->mainModel->create($newData);
    }
    
    /**
     * 
     * This will get record by ID
     * 
     * @param int $id
     * @return type
     */
    public function byId(int $id){
        return $this->mainModel->byId($id);
    }
    
    /**
     * 
     * This will update a record by ID
     * 
     * @param int $id
     * @param array $newData
     * @return mixed
     */
    public function update(int $id, array $newData){
        return $this->mainModel->update($id, $newData);
    }
    
    /**
     * 
     * This will delete a record by ID
     * 
     * @param int $id
     * @return mixed
     */
    public function delete(int $id){
        return $this->mainModel->delete($id);
    }
    
}
