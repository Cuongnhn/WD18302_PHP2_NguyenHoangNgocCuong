<?php

namespace App\Models;

class StudentModel extends BaseModel{

    protected $name ="StudentModel";
    public $tableName = 'students';
    public $table = "students";

    public function __construct(){
  
        parent::__construct();
    }

    public function getAllStudents(){
        return $this->getAll()->get();
    }

    public function insertStudents($data){
        // $tableName = $this->tableName;   
        $student = $this->insert($this->table,$data);
    }

    public function updateStudents($id, $data)
    {
        $whereUpdate = "WHERE id = " . $id; // Sử dụng $id để xác định điều kiện WHERE
        $tableName = $this->tableName;
        $updateQuery = $this->updateData($tableName, $data, $whereUpdate);
        $updateStatus = $this->query($updateQuery);
        if (!$updateStatus)
                return false;
            return true;
    }

    // public function deleteStudents(){
    //     // $tableName = $this->tableName;
    //     $student = $this->delete($this->table);
    // }

    public function getAllWithPaginate(int $limit = 10,int  $offset = 0){
        // return $this->select()->where('email', '=', $email)->first();
    }

    public function create($data){
        var_dump($this->tableName);
    }
}