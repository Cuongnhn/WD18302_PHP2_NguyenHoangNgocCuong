<?php

namespace App\Core;

class Route
{
    public $url;
    public $nameController = "HomeController";
    public $nameMethod = "home";
    public $path = 'App/Controllers/';
    public $controller;
    function __construct()
    {
        $this->request();
        $this->renderController();
        $this->renderMethod();
    }
    function request()
    {

        $this->url = isset($_GET['url']) ? $_GET['url'] : null;

        // filter_var trong php là gì?

        if ($this->url != null) {
            $this->url = rtrim($this->url, '/');
            $this->url = explode('/', filter_var($this->url, FILTER_SANITIZE_URL));
        } else {
            unset($this->url);
        }
    }

    function renderController()
    {
        if (!isset($this->url[0])) {
            $className        = $this->path . $this->nameController;
            $className        = preg_replace("~\/~", "\\", $className);
            $this->controller = new $className;
            $this->controller->HomeController();
        } else {
            $this->nameController = $this->url[0];
            $file                 = __DIR__. '/../Controllers/'. $this->nameController . '.php';

            if (file_exists($file)) {
                require_once $file;
                $className        = $this->path . $this->nameController;
                $className        = preg_replace("~\/~", "\\", $className);
                if (class_exists($className)) {
                    $this->controller = new $className;
                } else {
                    header('Location:' . ROOT_URL . 'HomeController/Error');
                }
            } else {
           
                header('Location:' . ROOT_URL . 'HomeController/Error');
            }
        }
    }
    function renderMethod()
    {
        if (isset($this->url[2])) {
            $this->nameMethod = $this->url[1];
            // Kiểm tra xem có tồn tại method vừa gán
            if (method_exists($this->controller, $this->nameMethod)) {
                $this->controller->{$this->nameMethod}($this->url[2]);
            } else {
                header('Location:' . ROOT_URL . 'HomeController/Error');
            }
        } else {
            // kiểm tra hàm có tồn tại hàm không có tham số 
            if (isset($this->url[1])) {
                $this->nameMethod = $this->url[1];
                // Kiểm tra xem có tồn tại method vừa gán
                if (method_exists($this->controller, $this->nameMethod)) {
                    $this->controller->{$this->nameMethod}();
                } else {
                    header('Location:' . ROOT_URL . 'HomeController/Error');
                }
            }
        }
    }
}