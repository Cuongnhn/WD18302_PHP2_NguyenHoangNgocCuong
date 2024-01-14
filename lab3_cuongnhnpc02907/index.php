<?php
require_once 'vendor/autoload.php';

use App\Core\Route;
use App\Core\Field;
use App\Core\Form;
use App\Controller\BaseController;
use App\Model\BaseModel;
use App\Responsitories\ModelAbstract;
use App\Responsitories\ModelInterface;

$BaseModel = new BaseModel;
$Field = new Field('attribute_name');
$Form = new Form;

$updatedDate = $BaseModel->getUpdatedDate();
echo $updatedDate->format('Y-m-d H:i:s');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Create an account</h1>
        <?php $form= Form::begin('','post');?>
        <div class="row">
            <div class="col">
                <?php echo $form->field('firstname'); ?>
            </div>
            <div class="col">
                <?php echo $form->field('lastname'); ?>
            </div>
        </div>
        <?php echo $form->field('email'); ?>
        <?php echo $form->field('password')->passwordField(); ?>
        <?php echo $form->field('confirmPassword')->passwordField(); ?>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php echo Form::end(); ?>
    </div>
</body>
</html>