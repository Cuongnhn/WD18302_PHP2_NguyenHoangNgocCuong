<?php

namespace App\Controllers;

use App\Core\RenderBase;

use App\Models\UserModel;

class LoginController extends BaseController{

    function __construct(){
        parent::__construct();
        $this->_renderBase = new RenderBase();
        
    }
    

    public function loadViewLogin(){

        if(!empty($_SESSION['user'])){
            $this->redirect(ROOT_URL);
        }

        $this->load->render('layouts/client/pages/login');

    }


    public function handleLogin(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
        
            $emailError = "";
            $passwordError = "";
        
            // Kiểm tra email
            if (empty($email)) {
                $emailError = "Vui lòng nhập địa chỉ email.";
            } else if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
                $emailError = "Địa chỉ email không hợp lệ.";
            }
        
            // Kiểm tra mật khẩu
            if (empty($password)) {
                $passwordError = "Vui lòng nhập mật khẩu.";
            } else if (!preg_match("/^.{6,}$/", $password)) {
                $passwordError = "Mật khẩu phải chứa ít nhất 6 ký tự.";
            }
        }

        // Kiểm tra nếu không có lỗi
        if (empty($emailError) || empty($passwordError)) {
            $userModel = new UserModel();
            $user = $userModel->checkUserExist($email);
            // var_dump ($user);
            // var_dump($user['password']);
            // var_dump($user['role']);
            // exit;

            // if (empty($user)) {
            //     $emailError = "Email không tồn tại.";
            //     $_SESSION["emailError"] = $emailError;
            // } else {
            //     if (password_verify($password, $user['password'])) {
            //         // xử lý session
            //         $_SESSION['user'] = $user;
            //         $redirectUrl = "http://PHP2/";
            //         header("Location: " . $redirectUrl);
            //         // header("Location: " . ROOT_URL);
            //         exit();
            //     } else {
            //         $passwordError = "Mật khẩu sai. Vui lòng nhập lại.";
            //         $_SESSION["passwordError"] = $passwordError;
            //     }
            // }
            if (empty($user)) {
                $emailError = "Email không tồn tại.";
                $_SESSION["emailError"] = $emailError;
            } else {
                if ($user['role'] == 0) {
                    $password = $_POST["password"];
                    if (password_verify($password, $user['password'])) {
                        // Xử lý session
                        $_SESSION['user'] = $user;
                        $redirectUrl = "http://PHP2/";
                        header("Location: " . $redirectUrl);
                        exit();
                    } else {
                        $passwordError = "Mật khẩu sai. Vui lòng nhập lại.";
                        $_SESSION["passwordError"] = $passwordError;
                    }
                } else {
                    $roleError = "Không phải tài khoản admin.";
                    $_SESSION["roleError"] = $roleError;
                }
            }
        }
        
        if (isset($passwordError) || isset($emailError) || isset($roleError))  {
            // Lưu thông tin lỗi vào session
            $_SESSION["emailError"] = $emailError;
            $_SESSION["passwordError"] = $passwordError;
            $_SESSION["roleError"] = $roleError;
        }
    $redirectUrl = "http://PHP2/?url=LoginController/loadViewLogin";
    header("Location: " . $redirectUrl);
    exit();
    }
    

    public function logout() {
        session_unset(); // Xóa tất cả các biến session
        session_destroy(); // Hủy phiên làm việc
    
        // Chuyển hướng người dùng đến trang đăng nhập hoặc trang khác tùy ý
        $redirectUrl = "http://PHP2/?url=LoginController/loadViewLogin";
        header("Location: " . $redirectUrl);
        exit(); // Đảm bảo không có mã PHP tiếp tục được thực thi sau chuyển hướng
    }
}