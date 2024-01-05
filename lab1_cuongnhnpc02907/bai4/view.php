<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        tr {
            padding: 10px; 
            margin: 10px;
        }
    </style>
</head>
<body>
    <h3>thông tin của sinh viên</h3>
    <?php if ($user !== null): ?>
        <th class="mb3">
            <tr>mssv: <?=$user['mssv']?></tr>
            <tr>tên: <?=$user['ten']?></tr>
            <tr>họ: <?=$user['ho']?></tr>
            <tr>địa chỉ: <?=$user['dia_chi']?></tr>
            <tr>lớp: <?=$user['lop']?></tr>
            <tr>ngày sinh: <?=$user['ngay_sinh']?></tr>
            <tr>quê quán: <?=$user['que_quan']?></tr>
            <tr>số điện thoại: <?=$user['sdt']?></tr>
            <tr>số cccd: <?=$user['so_cccd']?></tr>
            <tr>email: <?=$user['email']?></tr>
            <tr>nguyên quán: <?=$user['nguyen_quan']?></tr>
        </th>
    <?php else: ?>
        <p>bạn chưa nhập email.</p>
    <?php endif; ?>
    <form action="" method="post">
        <input type="email" name="email" id="">
        <input type="submit" value="submit">
    </form>
</body>
</html>