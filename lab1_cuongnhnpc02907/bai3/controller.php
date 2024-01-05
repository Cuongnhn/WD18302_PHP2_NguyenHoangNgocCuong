<?php
    include 'model.php';
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $user = get_user($email);
    } else {
        echo "vui lòng nhập email <br>";
        $email = "";
        $user = get_user($email);
    }

    include 'view.php';
?>