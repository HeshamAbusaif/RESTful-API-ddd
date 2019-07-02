<?php

namespace App\Domain\Models;

use Illuminate\Support\Facades\Redis;

class Main {

    /**
     * Holds the store name
     *
     * @var string 
     */
    private $hsetKey = 'items';

    /**
     * 
     * This function will return all the records
     * 
     * @return array
     */
    public function all() {
        $keys = Redis::keys($this->hsetKey . ':*');
        $resultsArr = [];
        foreach ($keys as $key) {
            if (Redis::type($key) == 'string') {
                continue;
            }
            $stored = Redis::hgetall($key);
            $resultsArr[] = $stored;
        }
        return $resultsArr;
    }

    /**
     * 
     * This function will create a new record in Redis DB
     * 
     * @param array $arr
     * @return mixed
     */
    public function create(array $arr) {
        Redis::incr($this->hsetKey . ':cnt');
        $arr['id'] = Redis::get($this->hsetKey . ':cnt');
        Redis::hmset($this->hsetKey . ':' . Redis::get($this->hsetKey . ':cnt'), $arr);
        return Redis::hgetall($this->hsetKey . ':' . Redis::get($this->hsetKey . ':cnt'));
    }

    /**
     * 
     * This function will delete
     * 
     * @param int $id
     * @return bool
     */
    public function delete($id) : bool {
        Redis::del($this->hsetKey . ':' . $id);
        return Redis::exists($this->hsetKey . ':' . $id);
    }

    /**
     * 
     * This will return a record by ID
     * 
     * @param int $id
     * @return mixed
     */
    public function byId($id) {
        return Redis::hgetall($this->hsetKey . ':' . $id);
    }
    
    /**
     * 
     * This will update a record
     * 
     * @param int $id
     * @param array $newData
     * @return mixed
     */
    public function update(int $id, array $newData){
        $collection = collect($newData);
        $collection->pull('id');
        Redis::hmset($this->hsetKey . ':' . $id, $collection->all());
        return Redis::hgetall($this->hsetKey . ':' . $id);
    }

}