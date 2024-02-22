<?php

namespace App\Controllers;

use App\Core\RenderBase;

class HomeController extends BaseController
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

    function HomeController()
    {
        $this->homePage();
    }

    function homePage()
    {
        // dữ liệu ở đây lấy từ responsitories hoặc model
        // $data = [
        //     "products" => [
        //         [
        //             "id" => 1,
        //             "name" => "Sản phẩm"
        //         ]
        //     ]
        // ];
        if(empty($_SESSION['user'])){
            header('Location: http://php2.local/Buoi18/?url=LoginController/loadViewLogin');
            exit();
        }

        $this->_renderBase->renderSlider();
        $this->_renderBase->renderHeader();
        $this->_renderBase->renderHome();
        $this->_renderBase->renderFooter();

        // $this->load->render('layouts/client/home', $data);
    }


}