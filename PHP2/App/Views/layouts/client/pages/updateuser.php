<div class="container">
    <div class="row">
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
    <h1 style="margin: 10px 0;">Cập nhật tài khoản</h1>
    <form id="signupForm" style="padding: 20px;" action="?url=UserController/handleUpdate" method="POST">
    <div class="form-group">
        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $id; ?>">
        <?php if (isset($_SESSION["error_message"])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION["error_message"]; ?>
        </div>
        <?php unset($_SESSION["error_message"]); ?>
        <?php endif; ?>
    </div>
        <div class="form-group">
            <label for="fullName">Tên tài khoản</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($data['name']) ? $data['name'] : ''; ?>">
            <?php if (isset($_SESSION["nameError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["nameError"]; ?>
        </div>
        <?php unset($_SESSION["nameError"]); ?>
        <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= isset($data['email']) ? $data['email'] : ''; ?>">
            <?php if (isset($_SESSION["emailError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["emailError"]; ?>
        </div>
        <?php unset($_SESSION["emailError"]); ?>
        <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= isset($data['address']) ? $data['address'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?= isset($data['phone']) ? $data['phone'] : ''; ?>">
            <?php if (isset($_SESSION["phoneError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["phoneError"]; ?>
        </div>
        <?php unset($_SESSION["phoneError"]); ?>
        <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="role">Vai trò</label>
            <select class="form-control" id="role" name="role">
                <option value="">Chọn vai trò</option>
                <option value="admin" <?= isset($data['role']) && $data['role'] == 0 ? 'selected' : ''; ?>>Admin</option>
                <option value="student" <?= isset($data['role']) && $data['role'] == 1 ? 'selected' : ''; ?>>Sinh viên</option>
                <option value="teacher" <?= isset($data['role']) && $data['role'] == 2 ? 'selected' : ''; ?>>Giáo viên</option>
            </select>
            <?php if (isset($_SESSION["roleError"])): ?>
        <div class="error text-danger">
            <?php echo $_SESSION["roleError"]; ?>
        </div>
        <?php unset($_SESSION["roleError"]); ?>
        <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary btn-submit">Lưu</button>
    </form>