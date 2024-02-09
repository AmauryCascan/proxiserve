<?php

namespace App\Models;


abstract class CoreModel
{

    protected $id;
    protected $created_at;
    protected $updated_at;



    public abstract function insert();
    public abstract function delete();
    public abstract static function find($id);
    public abstract static function findAll();


    public function getId()
    {
        return $this->id;
    }
    

   /**
     * Get the value of created_at
     *
     * @return  string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
