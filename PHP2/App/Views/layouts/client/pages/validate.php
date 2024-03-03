<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="<?= APP_URL?>public/assets/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_URL?>public/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= APP_URL?>public/assets/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= APP_URL?>public/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= APP_URL?>public/assets/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= APP_URL?>public/assets/vendors/jqvmap/dist/jqvmap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    <link rel="stylesheet" href="<?= APP_URL?>public/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body class="">
<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <h1 style="margin: 10px 0;">Quên mật khẩu</h1>
            <form action="?url=UserController/validate" class="form" method="post">
                <?php
                    if(isset($_POST['submit'])){
                        $error = array();
                        $currentTime = time();
                        if (isset($_SESSION['expirationTime'])) {
                            if ($currentTime < $_SESSION['expirationTime']) {
                            
                                if($_POST['text'] != $_SESSION['code']){
                                    $error['fail'] = 'Mã xác minh không hợp lệ !';
                                }else{
                                    header('location: http://php2/?url=UserController/reset_pass');
                                }
                            }else {
                                $errorTime = 'Mã hết hạn thời gian';
                            }
                        } else {
                            $error['fail'] = '';
                        }
                    }
                ?>
                <div class="form-group">
                    <?php if(isset($error['fail'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error['fail'] ?>
                    </div>
                    <?php else : ?>
                    <div class="alert alert-primary" role="alert">
                        <?php
                        if (isset($errorTime)) {
                            echo $errorTime;
                        }else{
                            echo 'Vui lòng nhập mã xác nhận chúng tôi đã gửi đến email của bạn';
                        }
                        ?>
                    </div>
                    <?php endif ?>
                    <input type="text" class="form-control" name="text" placeholder="Enter the confirmation code">
                </div>
                    <button type="submit" class="btn btn-primary btn-flat m-b-15" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?= APP_URL?>public/assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= APP_URL?>public/assets/js/main.js"></script>


    <script src="<?= APP_URL?>public/assets/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="<?= APP_URL?>public/assets/js/dashboard.js"></script>
    <script src="<?= APP_URL?>public/assets/js/widgets.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    </body>

</html>