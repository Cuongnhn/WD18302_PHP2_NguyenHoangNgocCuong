<div class="container">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1 style="margin: 10px 0;">Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?=APP_URL?>">Dashboard</a></li>
                    <li><a href="#">Sinh Viên</a></li>
                    <li class="active">Cập Nhật</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<h1 style="margin: 10px 0;">Cập Nhật thông tin Sinh viên</h1>
<!-- Form và các trường input -->
<?php foreach ($data as $key => $value) { ?>
    
<form style="padding: 20px;" action="?url=StudentController/handleUpdate" method="POST">
    <div class="form-group">
        <label for="student_code1" class="form-label">Mã số sinh viên:</label>
        <input type="text" class="form-control" id="student_code1" name="student_code" value="<?= isset($value['student_code']) ? $value['student_code'] : ''; ?>">
        <?php if (isset($_SESSION["student_codeError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["student_codeError"]; ?>
        </div>
        <?php unset($_SESSION["student_codeError"]); ?>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="ho">Họ:</label>
        <input type="text" class="form-control" id="ho" name="last_name" value="<?= isset($value['last_name']) ? $value['last_name'] : ''; ?>">
        <span id="hoError" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="first_name1">Tên:</label>
        <input type="text" class="form-control" id="first_name1" name="first_name" value="<?= isset($value['first_name']) ? $value['first_name'] : ''; ?>">
        <?php if (isset($_SESSION["first_nameError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["first_nameError"]; ?>
        </div>
        <?php unset($_SESSION["first_nameError"]); ?>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="diaChi">Địa chỉ:</label>
        <input type="text" class="form-control" id="diaChi" name="address" value="<?= isset($value['address']) ? $value['address'] : ''; ?>">
        <span id="diaChiError" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="class1">Lớp:</label>
        <input type="text" class="form-control" id="class1" name="class" value="<?= isset($value['class']) ? $value['class'] : ''; ?>">
        <?php if (isset($_SESSION["classError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["classError"]; ?>
        </div>
        <?php unset($_SESSION["classError"]); ?>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="ngaySinh">Ngày sinh:</label>
        <input type="date" class="form-control" id="ngaySinh" name="birthday" value="<?= isset($value['birthday']) ? $value['birthday'] : ''; ?>">
        <?php if (isset($_SESSION["birthdayError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["birthdayError"]; ?>
        </div>
        <?php unset($_SESSION["birthdayError"]); ?>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="queQuan">Quê quán:</label>
        <input type="text" class="form-control" id="queQuan" name="home_town" value="<?= isset($value['home_town']) ? $value['home_town'] : ''; ?>">
        <span id="queQuanError" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="sdt">Số điện thoại:</label>
        <input type="tel" class="form-control" id="sdt" name="phone" value="<?= isset($value['phone']) ? $value['phone'] : ''; ?>">
        <span id="sdtError" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="email1">Email:</label>
        <input type="text" class="form-control" id="email1" name="email" value="<?= isset($value['email']) ? $value['email'] : ''; ?>">
        <?php if (isset($_SESSION["emailError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["emailError"]; ?>
        </div>
        <?php unset($_SESSION["emailError"]); ?>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary btn-submit">Lưu</button>
</form>
<?php
}
?>