<?php

namespace App\Models;

class StudentModel extends BaseModel{

    protected $name ="StudentModel";
    public $tableName = 'students';
    public $tables = "students";

    public function __construct(){
  
        parent::__construct();
    }

    public function getAllStudents(){
        return $this->getAll()->get();
    }

    public function getStudents($id){
        return $this->select()->where('id', '=',$id )->first();
    }

    public function insertStudents($data){
        // $tableName = $this->tableName;   
        $student = $this->insert($this->tableName,$data);
    }

    public function updateStudents($id, $data)
    {
        $updateQuery = $this->updateData($this->tableName, $data,'id='. $id);
    }

    public function deleteStudents($id){
        // $tableName = $this->tableName;
        $student = $this->deleteData($this->tableName, 'id='.$id);
    }

    public function getAllWithPaginate(int $limit = 10,int  $offset = 0){
        // return $this->select()->where('email', '=', $email)->first();
    }

    public function create($data){
        var_dump($this->tableName);
    }
}