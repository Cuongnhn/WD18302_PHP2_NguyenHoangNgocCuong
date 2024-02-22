<?php

namespace App\Controllers;

use App\Core\RenderBase;
use App\Models\Database;
use App\Models\StudentModel;

class StudentController extends BaseController
{

    /**
     * Thuốc trị đau lưng
     * Copy lại là hết đau lưng
     * 
    */
    function __construct()
    {
        parent::__construct();
        $this->_renderBase = new RenderBase();
    }

    private function checkUserLoggedIn(){
        if(empty($_SESSION['user'])){
            header('Location: http://php2.local/Buoi18/?url=LoginController/loadViewLogin');
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
            }else if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $student_code)) {
                $student_codeError = "mã số sinh viên phải đủ 6 đến 12 ký tự.";
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

        if (isset($student_codeError) || isset($emailError) || isset($classError) || isset($first_nameError) || isset($birthdayError))  {
            // Lưu thông tin lỗi vào session
            $_SESSION["student_codeError"] = $student_codeError;
            $_SESSION["emailError"] = $emailError;
            $_SESSION["classError"] = $classError;
            $_SESSION["first_nameError"] = $first_nameError;
            $_SESSION["birthdayError"] = $birthdayError;
        } else {
            $StudentModel = new StudentModel();
            $StudentModel->insertStudents($_POST);
        }

        // header('Location: ' . $_SERVER['PHP_SELF']);
        // exit;
        $redirectUrl = "http://php2.local/Buoi18/?url=StudentController/studentAdd";
        header("Location: " . $redirectUrl);
        exit;
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
            }else if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $student_code)) {
                $student_codeError = "mã số sinh viên phải đủ 6 đến 12 ký tự.";
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

        if (isset($student_codeError) || isset($emailError) || isset($classError) || isset($first_nameError) || isset($birthdayError)) {
            // Lưu thông tin lỗi vào session
            $_SESSION["student_codeError"] = $student_codeError;
            $_SESSION["emailError"] = $emailError;
            $_SESSION["classError"] = $classError;
            $_SESSION["first_nameError"] = $first_nameError;
            $_SESSION["birthdayError"] = $birthdayError;
        }

        // Tạo một mảng chứa thông tin người dùng
        $userData = [
            "student_code" => $student_code,
            "email" => $email,
            "class" => $class,
            "first_name" => $first_name,
            "birthday" => $birthday
        ];
        
        $studentModel = new StudentModel();
        $data = $studentModel->getAllStudents();
        foreach ($data as $student) {
            var_dump($student['id']);
        }
        $studentModel->updateStudents($student['id'], $userData);
        
        // header('Location: ' . $_SERVER['PHP_SELF']);
        // exit;
        $redirectUrl = "http://php2.local/Buoi18/?url=StudentController/studentUpdate";
        header("Location: " . $redirectUrl);
        exit;
    }

    public function studentUpdate(){
        $this->checkUserLoggedIn();

        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/update', $data);
        $this->_renderBase->renderFooter();
    }
    
    public function studentList(){
        $this->checkUserLoggedIn();

        $studentModel = new StudentModel();
        $data = $studentModel->getAllStudents();

        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/list', $data);
        $this->_renderBase->renderFooter();
    }
    
    // public function studentHistoryDelete(){
    //     $this->checkUserLoggedIn();
    
    //     $this->_renderBase->renderSlider();
    //     $this->_renderBase->renderHeader();
    //     $this->load->render('layouts/client/pages/historydelete', $data);
    //     $this->_renderBase->renderFooter();
    // }
}