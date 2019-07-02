<?php

namespace App\Domain\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Pipelining
 */
use League\Pipeline\Pipeline;

/**
 * Basic CRUD
 */
use App\Domain\Services\CRUD\SearchService;
use App\Domain\Services\CRUD\CreateService;
use App\Domain\Services\CRUD\EditService;
use App\Domain\Services\CRUD\UpdateService;
use App\Domain\Services\CRUD\DeleteService;

/**
 * Filtration
 */
use App\Domain\Services\Filtration\ByDate as FilterByDate;
use App\Domain\Services\Filtration\ByTitle as FilterByTitle;

/**
 * Sorting
 */
use App\Domain\Services\Sorting\ByField as SortByField;

/**
 * Response Formatters
 */
use App\Domain\Services\Responses\ProperResponse;
use App\Domain\Services\Responses\ProperError;

/**
 * Validation
 */
use App\Http\Requests\ValidateCreate;
use App\Http\Requests\ValidateUpdate;

class CrudRestController extends Controller
{
    
    private $searchService;
    private $createService;
    private $editService;
    private $updateService;
    private $deleteService;
    private $filterByDate;
    private $filterByTitle;
    private $sortByField;
    private $properResponse;
    private $properError;
    
    /**
     * 
     * This constructor instantiates the main services (DI)
     * 
     * @param SearchService $searchService
     * @param CreateService $createService
     * @param EditService $editService
     * @param UpdateService $updateService
     * @param DeleteService $deleteService
     * @param FilterByDate $filterByDate
     * @param FilterByTitle $filterByTitle
     * @param SortByField $sortByField
     * @param ProperResponse $properResponse
     * @param ProperError $properError
     * 
     */
    public function __construct(
        SearchService $searchService, 
        CreateService $createService, 
        EditService $editService,
        UpdateService $updateService, 
        DeleteService $deleteService,
        FilterByDate $filterByDate,
        FilterByTitle $filterByTitle,
        SortByField $sortByField,
        ProperResponse $properResponse,
        ProperError $properError
    ){
        $this->searchService = $searchService;
        $this->createService = $createService;
        $this->editService = $editService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->filterByDate = $filterByDate;
        $this->filterByTitle = $filterByTitle;
        $this->sortByField = $sortByField;
        $this->properResponse = $properResponse;
        $this->properError = $properError;
    }
    
    /**
     * 
     * This function will return all records
     * 
     * @return mixed
     */
    public function index(ValidateFilters $request){
        try{
            $pipe = (new Pipeline)
                    ->pipe($this->searchService)
                    ->pipe($this->filterByDate)
                    ->pipe($this->filterByTitle)
                    ->pipe($this->sortByField)
                    ->pipe($this->properResponse);
            $payload = [];
            $payload['userRequest'] = (array)$request->all();
            return $pipe->process($payload);
        }catch(\Exception $e){
            $pipe = (new Pipeline)
                    ->pipe($this->properError);
            return $pipe->process($e);
        }
    }
    
    /**
     * 
     * This function will create a new record
     * 
     * @param ValidateCreate $request
     * @return mixed
     */
    public function create(ValidateCreate $request){
        try{
            $pipe = (new Pipeline)
                ->pipe($this->createService)
                ->pipe($this->properResponse);
            return $pipe->process((array)$request->all());
        }catch(\Exception $e){
            $pipe = (new Pipeline)
                ->pipe($this->properError);
            $pipe->process($e);
        }
    }
    
    /**
     * 
     * This function will return the single record to be edited
     * 
     * @param int $id
     * @return mixed
     */
    public function edit($id){
        try{
            $pipe = (new Pipeline)
                ->pipe($this->editService)
                ->pipe($this->properResponse);
            return $pipe->process(['id' => (int)$id]);
        }catch(\Exception $e){
            $pipe = (new Pipeline)
                ->pipe($this->properError);
            $pipe->process($e);
        }
    }
    
    /**
     * 
     * This will be updating an existing record
     * 
     * @param ValidateUpdate $request
     * @return mixed
     */
    public function update(ValidateUpdate $request){
        try{
            $pipe = (new Pipeline)
                ->pipe($this->updateService)
                ->pipe($this->properResponse);
            return $pipe->process((array)$request->all());
        }catch(\Exception $e){
            $pipe = (new Pipeline)
                ->pipe($this->properError);
            $pipe->process($e);
        }
    }
    
    /**
     * 
     * This function will delete an existing record
     * 
     * @param int $id
     * @return mixed
     */
    public function delete($id){
        try{
            $pipe = (new Pipeline)
                ->pipe($this->deleteService)
                ->pipe($this->properResponse);
            return $pipe->process(['id' => (int)$id]);
        }catch(\Exception $e){
            $pipe = (new Pipeline)
                ->pipe($this->properError);
            $pipe->process($e);
        }
    }
}