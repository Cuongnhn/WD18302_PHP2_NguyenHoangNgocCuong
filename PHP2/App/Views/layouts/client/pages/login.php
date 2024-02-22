<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>


    <body class="">


        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
            <h1 class="text-center">Đăng Nhập</h1>
                <div class="login-content col-12 d-flex content-items-center justify-content-center">

                    <div class="login-form col-6">
                        <div class="login-logo">
                            <a href="#">
                                <img class="align-content" src="<?= APP_URL?>public/assets/images/logo.png" alt="">
                            </a>
                        </div>
                        <form method="POST" action="?url=LoginController/handleLogin"
                            class="d-flex justify-content-center flex-column">

                            <div class="form-group">
                                <label>Email address</label>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                                <?php if (isset($_SESSION["emailError"])): ?>
                                <div class="error text-danger">
                                    <?php echo $_SESSION["emailError"]; ?>
                                </div>
                                <?php unset($_SESSION["emailError"]); ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <?php if (isset($_SESSION["passwordError"])): ?>
                                <div class="error text-danger">
                                    <?php echo $_SESSION["passwordError"]; ?>
                                </div>
                                <?php unset($_SESSION["passwordError"]); ?>
                                <?php endif; ?>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                                <label class="pull-right">
                                    <a href="<?=APP_URL?>forget">Forgotten Password?</a>
                                </label>

                            </div>
                            <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    </body>

</html>