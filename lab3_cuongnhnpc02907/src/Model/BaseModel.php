<?php
namespace App\Model;
use App\Responsitories\ModelInterface;
use App\Responsitories\ModelAbstract;
use DateTime;

class BaseModel extends ModelAbstract implements ModelInterface {
    protected $updatedBy;
    protected $updatedDate;
    protected $db;

    public function __construct() {
        $this->updatedDate = new DateTime();

        // Kết nối cơ sở dữ liệu
        $dsn = 'mysql:host=localhost;dbname=management';
        $username = 'root';
        $password = 'mysql';
    }
       

    public function getById($id) {
       
    }

    public function getAll() {
        $query = "SELECT * FROM student"; 
        $stmt = $this->db->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    public function getUpdatedDate() {
        return $this->updatedDate;
    }
}