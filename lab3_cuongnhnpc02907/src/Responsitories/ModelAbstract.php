<?php
namespace App\Responsitories;

abstract class ModelAbstract {
    protected $table;

    public function save() {
        
    }

    abstract public function getById($id);

    abstract public function getAll();
}