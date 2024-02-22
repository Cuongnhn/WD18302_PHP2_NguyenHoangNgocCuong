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
    <form id="signupForm" style="padding: 20px;" onsubmit="validateForm(event)">
        <div class="form-group">
            <label for="fullName">Tên tài khoản</label>
            <input type="text" class="form-control" id="fullName" name="fullName">
            <span id="fullNameError" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
            <span id="emailError" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address">
            <span id="addressError" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="tel" class="form-control" id="phone" name="phone">
            <span id="phoneError" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="role">Vai trò</label>
            <select class="form-control" id="role" name="role">
                <option value="">Chọn vai trò</option>
                <option value="student">Sinh viên</option>
                <option value="teacher">Giáo viên</option>
                <option value="admin">Admin</option>
            </select>
            <span id="roleError" class="text-danger"></span>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
    </form>

    <script>
  function validateForm(event) {
    event.preventDefault(); // Ngăn chặn hành vi mặc định của nút submit

    var fullName = document.getElementById("fullName").value;
    var email = document.getElementById("email").value;
    var address = document.getElementById("address").value;
    var phone = document.getElementById("phone").value;
    var role = document.getElementById("role").value;

    var errors = {};

    // Kiểm tra tên tài khoản
    if (fullName.trim() === "") {
      errors["fullName"] = "Vui lòng nhập tên tài khoản.";
    }

    // Kiểm tra email
    var emailPattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    if (!emailPattern.test(email)) {
      errors["email"] = "Email không hợp lệ. Vui lòng nhập đúng định dạng email.";
    }

    // Kiểm tra địa chỉ
    if (address.trim() === "") {
      errors["address"] = "Vui lòng nhập địa chỉ.";
    }

    // Kiểm tra số điện thoại
    var phonePattern = /^\d{10}$/;
    if (!phonePattern.test(phone)) {
      errors["phone"] = "Số điện thoại không hợp lệ. Số điện thoại phải gồm 10 chữ số.";
    }

    // Kiểm tra vai trò
    if (role === "") {
      errors["role"] = "Vui lòng chọn vai trò.";
    }

    // Hiển thị thông báo lỗi
    var fullNameError = document.getElementById("fullNameError");
    fullNameError.textContent = errors["fullName"] || "";

    var emailError = document.getElementById("emailError");
    emailError.textContent = errors["email"] || "";

    var addressError = document.getElementById("addressError");
    addressError.textContent = errors["address"] || "";

    var phoneError = document.getElementById("phoneError");
    phoneError.textContent = errors["phone"] || "";

    var roleError = document.getElementById("roleError");
    roleError.textContent = errors["role"] || "";

    // Kiểm tra nếu không có lỗi
    if (Object.keys(errors).length === 0) {
      // Thực hiện các thao tác khác khi dữ liệu hợp lệ
      // ...
    }
  }
</script>