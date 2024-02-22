<?php

namespace App\Controllers;

use App\Core\RenderBase;
use App\Models\Database;
use App\Models\UserModel;

class UserController extends BaseController
{
    public $userModel;
    /**
     * Thuốc trị đau lưng
     * Copy lại là hết đau lưng
     * 
    */
    function __construct()
    {
        parent::__construct();
        $this->_renderBase = new RenderBase();
        $this->userModel = new UserModel();
    }

    private function checkUserLoggedIn(){
        if(empty($_SESSION['user'])){
            header('Location: http://PHP2/?url=LoginController/loadViewLogin');
            exit();
        }
    }

    public function handleUpdate()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST["user_id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $role = $_POST["role"];

        $nameError = "";
        $emailError = "";
        $phoneError = "";
        $roleError = "";

        // Kiểm tra trường 'name'
        if (empty($name)) {
            $nameError = "Tên không được để trống";
        }

        // Kiểm tra trường 'email'
        if (empty($email)) {
            $emailError = "Email không được để trống";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Email không đúng định dạng";
        }

        // Kiểm tra trường 'phone'
        if (empty($phone)) {
            $phoneError = "Số điện thoại không được để trống";
        } elseif (!preg_match('/^[0-9]{10,12}$/', $phone)) {
            $phoneError = "Số điện thoại phải chứa từ 10 đến 12 chữ số";
        }

        // Kiểm tra trường 'role'
        if ($role !== 'admin' && $role !== 'student' && $role !== 'teacher') {
            $roleError = "Giá trị 'role' không hợp lệ";
        } else {
            // Chuyển đổi giá trị 'role' sang kiểu số nguyên
            if ($role === 'admin') {
                $role_id = 0;
            } elseif ($role === 'student') {
                $role_id = 1;
            } elseif ($role === 'teacher') {
                $role_id = 2;
            }
        }

        if (empty($nameError) && empty($emailError) && empty($phoneError) && empty($roleError)) {
            $userData = [
                "name" => $name,
                "email" => $email,
                "address" => $address,
                "phone" => $phone,
                "role" => $role_id
            ];

            $this->userModel->updateUser($user_id, $userData);

            $redirectUrl = "http://PHP2/?url=UserController/userUpdate/" . $user_id;
            header("Location: " . $redirectUrl);
            exit;
        } else {
            // Lưu thông tin lỗi vào session hoặc thông báo lỗi cho người dùng tùy thuộc vào yêu cầu của ứng dụng
            // Ví dụ: Lưu thông tin lỗi vào session
            $_SESSION["nameError"] = $nameError;
            $_SESSION["emailError"] = $emailError;
            $_SESSION["phoneError"] = $phoneError;
            $_SESSION["roleError"] = $roleError;

            // Chuyển hướng đến trang UserController/userUpdate để hiển thị thông tin lỗi
            $redirectUrl = "http://PHP2/?url=UserController/userUpdate/" . $user_id;
            header("Location: " . $redirectUrl);
            exit;
        }
    }
}

    public function userList(){
        $this->checkUserLoggedIn();

        $data = $this->userModel->getAllUser();
        
        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/listuser',$data);
        $this->_renderBase->renderFooter();
    }

    public function userUpdate($user_id){
        $this->checkUserLoggedIn();

        $data = $this->userModel->getUser($user_id);

        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/updateuser', $data);
        $this->_renderBase->renderFooter();
    }

    public function userDelete($user_id){
        $this->checkUserLoggedIn();
        
        $this->userModel->deleteUser($user_id); 

        $data = $this->userModel->getAllUser();
        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/list', $data);
        $this->_renderBase->renderFooter();
    }
}