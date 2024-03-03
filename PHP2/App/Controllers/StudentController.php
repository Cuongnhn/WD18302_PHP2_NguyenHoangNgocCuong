<?php

namespace App\Controllers;

use App\Core\RenderBase;
use App\Models\Database;
use App\Models\StudentModel;

class StudentController extends BaseController
{
    public $studentModel;
    /**
     * Thuốc trị đau lưng
     * Copy lại là hết đau lưng
     * 
    */
    function __construct()
    {
        parent::__construct();
        $this->_renderBase = new RenderBase();
        $this-> studentModel= new StudentModel();
    }

    private function checkUserLoggedIn(){
        if(empty($_SESSION['user'])){
            header('Location: http://PHP2/?url=LoginController/loadViewLogin');
            exit();
        }
    }

    public function handleAdd(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_code = $_POST["student_code"];
            $email = $_POST["email"];
            $class = $_POST["class"];
            $first_name = $_POST["first_name"];
            $birthday = $_POST["birthday"];
        
            $student_codeError = "";
            $emailError = "";
            $classError = "";
            $first_nameError = "";
            $birthdayError = "";
        
            // Kiểm tra tên
            if (empty($student_code)) {
                $student_codeError = "Vui lòng nhập mã số sinh viên.";
            } else if (strlen($student_code) < 7 || strlen($student_code) > 10) {
                $student_codeError = "Mã số sinh viên phải có độ dài từ 7 đến 10 ký tự.";
            }
            
            // Kiểm tra email
            if (empty($email)) {
                $emailError = "Vui lòng nhập địa chỉ email.";
            } else if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
                $emailError = "Địa chỉ email không hợp lệ.";
            } else if (!empty($email)) {
                $StudentModel = new StudentModel();
                $student = $StudentModel->checkStudentExist($email);
                if ($student) {
                    $emailError = "Email đã tồn tại vui lòng thử lại.";
                }
            } 

            if (empty($birthday)) {
                $birthdayError = "Vui lòng nhập ngày sinh.";
            } else {
                // Kiểm tra định dạng ngày
                $dateTime = \DateTime::createFromFormat('Y-m-d', $birthday);
                if (!$dateTime || $dateTime->format('Y-m-d') !== $birthday) {
                    $birthdayError = "Ngày sinh không hợp lệ. Vui lòng nhập đúng định dạng Y-m-d.";
                } else if ($dateTime > new \DateTime()) {
                    $birthdayError = "Ngày sinh không được lớn hơn ngày hiện tại.";
                }
            }

            if (empty($class)) {
                $classError = "Vui lòng nhập lớp.";
            } else if (!preg_match('/^.{7,}$/', $class)) {
                    $classError = "Lớp phải chứa ít nhất 7 ký tự.";
            }
    
            if (empty($first_name)) {
                $first_nameError = "Vui lòng nhập tên.";
            } else if (!preg_match('/^[a-zA-Z0-9]{2,7}$/', $first_name)) {
                    $first_nameError = "Tên phải chứa ít nhất 2 ký tự.";
                }
        }

        if (empty($student_codeError) && empty($emailError) && empty($classError) && empty($first_nameError) && empty($birthdayError)) {
            // Thực hiện truy vấn SQL
        if ($this->studentModel->insertStudents($_POST)) {
            $_SESSION["error_message"] = "Thêm thành công.";
        } else {
            $error_message = mysqli_error($connection);
            echo "Lỗi SQL: " . $error_message;
        }
        $redirectUrl = "http://PHP2/?url=StudentController/studentAdd";
        header("Location: " . $redirectUrl);
        exit;
        
        } else {
            // Lưu thông tin lỗi vào session
            $_SESSION["student_codeError"] = $student_codeError;
            $_SESSION["emailError"] = $emailError;
            $_SESSION["classError"] = $classError;
            $_SESSION["first_nameError"] = $first_nameError;
            $_SESSION["birthdayError"] = $birthdayError;
            $redirectUrl = "http://PHP2/?url=StudentController/studentAdd";
        header("Location: " . $redirectUrl);
        exit;
    }
}

    public function studentAdd(){
        $this->checkUserLoggedIn();
    
        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/add');
        $this->_renderBase->renderFooter();
    }
    
    public function handleUpdate(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_id = $_POST["student_id"];
            $student_code = $_POST["student_code"];
            $email = $_POST["email"];
            $class = $_POST["class"];
            $first_name = $_POST["first_name"];
            $birthday = $_POST["birthday"];
        
            $student_codeError = "";
            $emailError = "";
            $classError = "";
            $first_nameError = "";
            $birthdayError = "";
        
            // Kiểm tra tên
            if (empty($student_code)) {
                $student_codeError = "Vui lòng nhập mã số sinh viên.";
            } else if (strlen($student_code) < 7 || strlen($student_code) > 10) {
                $student_codeError = "Mã số sinh viên phải có độ dài từ 7 đến 10 ký tự.";
            }
            
            // Kiểm tra email
            if (empty($email)) {
                $emailError = "Vui lòng nhập địa chỉ email.";
            } else if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
                $emailError = "Địa chỉ email không hợp lệ.";
            }

            if (empty($birthday)) {
                $birthdayError = "Vui lòng nhập ngày sinh.";
            } else {
                // Kiểm tra định dạng ngày
                $dateTime = \DateTime::createFromFormat('Y-m-d', $birthday);
                if (!$dateTime || $dateTime->format('Y-m-d') !== $birthday) {
                    $birthdayError = "Ngày sinh không hợp lệ. Vui lòng nhập đúng định dạng Y-m-d.";
                } else if ($dateTime > new \DateTime()) {
                    $birthdayError = "Ngày sinh không được lớn hơn ngày hiện tại.";
                }
            }

            if (empty($class)) {
                $classError = "Vui lòng nhập lớp.";
            } else if (!preg_match('/^.{7,}$/', $class)) {
                    $classError = "Lớp phải chứa ít nhất 7 ký tự.";
            }
    
            if (empty($first_name)) {
                $first_nameError = "Vui lòng nhập tên.";
            } else if (!preg_match('/^[a-zA-Z0-9]{2,7}$/', $first_name)) {
                    $first_nameError = "Tên phải chứa ít nhất 2 ký tự.";
                }
        }

        if (empty($student_codeError) && empty($emailError) && empty($classError) && empty($first_nameError) && empty($birthdayError)) {
            // Tạo một mảng chứa thông tin người dùng
            $userData = [
                "student_code" => $student_code,
                "email" => $email,
                "class" => $class,
                "first_name" => $first_name,
                "birthday" => $birthday
            ];

            // Thực hiện truy vấn SQL
            $this->studentModel->updateStudents($student_id, $userData);
            $_SESSION["success_message"] = "Cập nhật thành công.";
            $redirectUrl = "http://PHP2/?url=StudentController/studentUpdate/".$student_id;
            header("Location: " . $redirectUrl);
            exit;
        } else {
            // Lưu thông tin lỗi vào session
            $_SESSION["student_codeError"] = $student_codeError;
            $_SESSION["emailError"] = $emailError;
            $_SESSION["classError"] = $classError;
            $_SESSION["first_nameError"] = $first_nameError;
            $_SESSION["birthdayError"] = $birthdayError;
            $redirectUrl = "http://PHP2/?url=StudentController/studentUpdate/".$student_id;
            header("Location: " . $redirectUrl);
            exit;
        }
    }

    public function studentUpdate($student_id){
        $this->checkUserLoggedIn();
        
        $data = $this->studentModel->getStudents($student_id);

        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/update', $data);
        $this->_renderBase->renderFooter();
    }

    public function studentDelete($student_id){
        $this->checkUserLoggedIn();
        
        $this->studentModel->deleteStudents($student_id); 

        $data = $this->studentModel->getAllStudents();
        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/list', $data);
        $this->_renderBase->renderFooter();
    }
    
    public function studentList(){
        $this->checkUserLoggedIn();

        $data = $this->studentModel->getAllStudents();

        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/list', $data);
        $this->_renderBase->renderFooter();
    }
}