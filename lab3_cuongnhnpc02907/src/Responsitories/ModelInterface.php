<?php
namespace App\Responsitories;

interface ModelInterface {
    public function getUpdatedBy();

    public function getUpdatedDate();
}