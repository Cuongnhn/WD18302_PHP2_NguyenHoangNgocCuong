<?php

namespace App\Controllers;
use App\Core\RenderBase;
use App\Models\UserModel;

class ResgisterController extends BaseController{

    function __construct(){
        parent::__construct();
        $this->_renderBase = new RenderBase();
    }
    

    public function loadViewRegister(){

        // if(!empty($_SESSION['user'])){
        //     $this->redirect(ROOT_URL);
        // }

        $this->load->render('layouts/client/pages/register');
    }


    public function handleRegister(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];
        
            $nameError = "";
            $emailError = "";
            $addressError = "";
            $phoneError = "";
            $passwordError = "";
        
            // Kiểm tra tên
            if (empty($name)) {
                $nameError = "Vui lòng nhập tên.";
            }

            // Kiểm tra địa chỉ
            if (empty($address)) {
                $addressError = "Vui lòng nhập địa chỉ.";
            }
        
            // Kiểm tra số điện thoại
            if (empty($phone)) {
                $phoneError = "Vui lòng nhập số điện thoại.";
            } else if (!preg_match('/^0\d{9,10}$/', $phone)) {
                $phoneError = "Số điện thoại không hợp lệ.";
            }
        
            // Kiểm tra mật khẩu
            if (empty($password)) {
                $passwordError = "Vui lòng nhập mật khẩu.";
            } else if (!preg_match("/^.{6,}$/", $password)) {
                $passwordError = "Mật khẩu phải chứa ít nhất 6 ký tự.";
            }
            
            // Kiểm tra email
            if (empty($email)) {
                $emailError = "Vui lòng nhập địa chỉ email.";
            } else if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
                $emailError = "Địa chỉ email không hợp lệ.";
            } else if (!empty($email)) {
                $userModel = new UserModel();
                $user = $userModel->checkUserExist($email);
                if ($user) {
                    $emailError = "Email đã tồn tại vui lòng đăng nhập.";
                }
            } 
        }

        if (!empty($nameError) || !empty($emailError) || !empty($phoneError) || !empty($addressError) || !empty($passwordError))  {
            // Lưu thông tin lỗi vào session
            $_SESSION["nameError"] = $nameError;
            $_SESSION["emailError"] = $emailError;
            $_SESSION["phoneError"] = $phoneError;
            $_SESSION["addressError"] = $addressError;
            $_SESSION["passwordError"] = $passwordError;
        } else{     
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Tạo một mảng chứa thông tin người dùng
            $userData = [
                "name" => $name,
                "email" => $email,
                "address" => $address,
                "phone" => $phone,
                "password" => $hashedPassword
            ];
            
            // Gọi phương thức đăng ký người dùng và chuyển đến trang đăng nhập
            $userModel = new UserModel();
            $userModel->registerUser($userData);
        }
        // $userModel->registerUser($_POST);
        $redirectUrl = "http://PHP2/?url=ResgisterController/loadViewRegister";
        header("Location: " . $redirectUrl);
        exit();
    }

}