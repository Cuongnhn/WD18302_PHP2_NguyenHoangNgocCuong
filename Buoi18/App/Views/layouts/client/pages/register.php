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
    <div class="container">
        <h1 class="text-center">Đăng ký</h1>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <form method="POST" action="?url=ResgisterController/handleRegister"
                    class="d-flex justify-content-center flex-column">
                    <div class="mb-3">
                        <label for="lregisterInputname1" class="form-label">Họ và tên</label>
                        <input name="name" type="name" class="form-control" id="lregisterInputname1"
                            aria-describedby="nameHelp">
                            <?php if (isset($_SESSION["nameError"])): ?>
                                <div class="error text-danger">
                                    <?php echo $_SESSION["nameError"]; ?>
                                </div>
                                <?php unset($_SESSION["nameError"]); ?>
                                <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="lregisterInputEmail1" class="form-label">Email</label>
                        <input name="email" type="text" class="form-control" id="lregisterInputEmail1"
                            aria-describedby="emailHelp">
                            <?php if (isset($_SESSION["emailError"])): ?>
                                <div class="error text-danger">
                                    <?php echo $_SESSION["emailError"]; ?>
                                </div>
                                <?php unset($_SESSION["emailError"]); ?>
                                <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="lregisterInputAddress1" class="form-label">Địa chỉ</label>
                        <input name="address" type="address" class="form-control" id="lregisterInputAddress1">
                        <?php if (isset($_SESSION["addressError"])): ?>
                                <div class="error text-danger">
                                    <?php echo $_SESSION["addressError"]; ?>
                                </div>
                                <?php unset($_SESSION["addressError"]); ?>
                                <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="lregisterInputPhone1" class="form-label">Số điện thoại</label>
                        <input name="phone" type="phone" class="form-control" id="lregisterInputPhone1">
                        <?php if (isset($_SESSION["phoneError"])): ?>
                                <div class="error text-danger">
                                    <?php echo $_SESSION["phoneError"]; ?>
                                </div>
                                <?php unset($_SESSION["phoneError"]); ?>
                                <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="lregisterInputPassword1" class="form-label">Mật khẩu</label>
                        <input name="password" type="password" class="form-control" id="lregisterInputPassword1">
                        <?php if (isset($_SESSION["passwordError"])): ?>
                                <div class="error text-danger">
                                    <?php echo $_SESSION["passwordError"]; ?>
                                </div>
                                <?php unset($_SESSION["passwordError"]); ?>
                                <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="http://php2.local/Buoi18/?url=LoginController/loadViewLogin" class="btn btn-link">Login</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>