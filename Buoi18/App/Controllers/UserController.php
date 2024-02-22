<?php

namespace App\Controllers;

use App\Core\RenderBase;
use App\Models\Database;
use App\Models\UserModel;

class UserController extends BaseController
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

    public function userList(){
        $this->checkUserLoggedIn();

        $userModel = new UserModel();
        $data = $userModel->getAllUser();
        
        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/listuser',$data);
        $this->_renderBase->renderFooter();
    }

    public function userUpdate(){
        $this->checkUserLoggedIn();

        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/updateuser', $data);
        $this->_renderBase->renderFooter();

    }
}