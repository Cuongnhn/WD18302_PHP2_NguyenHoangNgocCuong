<?php

namespace App\Models;

class UserModel extends BaseModel{
    protected $name ="UserModel";
    public $tableName = 'users';

    public $table = "users";


    public function __construct(){
  
        parent::__construct();
    }

    public function getAllUser(){
        return $this->getAll()->get();
    }

    public function getUser($id){
        return $this->select()->where('id', '=',$id )->first();
    }
    public function checkUserExist($email){
        return $this->select()->where('email', '=', $email)->first();
    }

    public function getAllWithPaginate(int $limit = 10,int  $offset = 0){
        // return $this->select()->where('email', '=', $email)->first();
    }

    public function registerUser($data){
        $user = $this->insert($this->table,$data);
    }

    public function deleteUser($id){
        $user = $this->deleteData($this->tableName, 'id='.$id);
    }

    public function updateUser($id, $data)
    {
        $updateQuery = $this->updateData($this->tableName, $data,'id='. $id);
    }

    public function forgotUser($email, $data)
    {
        $updateQuery = $this->updateData($this->tableName, $data,"email='$email'");
    }

    public function create($data){
        var_dump($this->tableName);
    }
}