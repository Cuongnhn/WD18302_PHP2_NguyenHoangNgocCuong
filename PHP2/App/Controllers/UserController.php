<?php

namespace App\Controllers;

use App\Core\RenderBase;
use App\Models\Database;
use App\Models\UserModel;
use App\Mail\Mailer;

class UserController extends BaseController
{
    public $userModel;
    public $mailModel;
    public $adddressMail='';
    public $title = '';
    public $content = '';
    
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

        // Kiểm tra email
        if (empty($email)) {
            $emailError = "Vui lòng nhập địa chỉ email.";
        } else if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            $emailError = "Địa chỉ email không hợp lệ.";
        } else if (!empty($email)) {
            $userModel = new UserModel();
            $user = $userModel->checkUserExist($email);
            if ($user) {
                $emailError = "Email đã tồn tại vui lòng thử lại.";
            }
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
            $_SESSION["error_message"] = "Cập nhật thành công.";
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

    public function userForget(){
        // $this->checkUserLoggedIn();

        if (isset($_POST['submit'])) {
            $error = array();
            $email = $_POST['email'];
            // $emailuser = $_SESSION['user']['email'];

            $userModel = new UserModel();
            $user = $this->userModel->getAllUser();
            // var_dump($user);
            // var_dump($emailuser);
        
            if ($email == '') {
                $error['email'] = 'Vui lòng nhập email.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'Email không đúng định dạng.';
            } else {
                $emailExists = false;
                foreach ($user as $userData) {
                    if ($email == $userData['email']) {
                        $emailExists = true;
                        break;
                    }
                }if (!$emailExists) {
                    $error['email'] = 'Email không tồn tại.';
                }
            }
            
            if (empty($error)) {
                $result = $emailuser;
                $code = substr(rand(0, 999999), 0, 6);
                $title = "Quên mật khẩu.";
                $content = "Mã xác nhận của bạn là: " . $code . "";
                // var_dump($email);
                // die;
                $this->mailModel = new Mailer();
                $this->mailModel->sendMail($title, $content, $email);

                
                // Lấy thời gian hiện tại
                $currentTime = time();
                // Lấy thời gian hết hạn sau 60 giây
                $expirationTime = $currentTime + 30;

                // Lưu thời gian hết hạn vào session
                $_SESSION['mail'] = $email;
                $_SESSION['code'] = $code;
                $_SESSION['expirationTime'] = $expirationTime;

                $redirectUrl = "http://PHP2/?url=UserController/validate";
                header("Location: " . $redirectUrl);
                exit;
            }
        }

        $data = array();
        if (isset($error['email'])) {
            $_SESSION["emailError"] = $error['email'];
            $data["emailError"] = $error['email'];
        }
        
        $this->load->render('layouts/client/pages/forget',$data);
    }

    public function validate(){
        // var_dump($_SESSION['code']);

        $this->load->render('layouts/client/pages/validate');
    }

    public function reset_pass(){
        $mail = $_SESSION['mail'];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $error = array();
            
            if (empty($_POST['repass']) || empty($_POST['newpass'])) {
                $error['fail'] = 'Mật khẩu không được để trống!';
            } else if ($_POST['repass'] != $_POST['newpass']){
                $error['fail'] = 'Nhập lại mật khẩu không khớp !';
            } else {
                $newpass = $_POST["newpass"];
                $hashedPassword = password_hash($newpass, PASSWORD_DEFAULT);

                $userData = [
                    "password" => $hashedPassword
                ];
                
                $this->userModel->forgotUser($mail, $userData);
                $error['success'] = 'Đã đổi mật khẩu thành công! Đổi hướng sau 3 giây.';
                header('refresh:3;http://php2/');
            }
        }

        $data = array();
        if (isset($error['fail'])) {
            $_SESSION["passError"] = $error['fail'];
            $data["passError"] = $error['fail'];
        }
        if (isset($error['success'])) {
            $_SESSION["passSuccess"] = $error['success'];
            $data["passSuccess"] = $error['success'];
        }

        $this->load->render('layouts/client/pages/reset_pass', $data);
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