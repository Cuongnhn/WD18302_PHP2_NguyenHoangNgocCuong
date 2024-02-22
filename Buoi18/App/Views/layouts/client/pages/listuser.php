<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?=APP_URL?>">Dashboard</a></li>
                    <li><a href="#">User</a></li>
                    <li class="active">Danh Sách</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <strong class="card-title">Danh Sách User</strong>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="search-container">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Tìm kiếm">
                                    <button class="btn btn-primary" onclick="searchTable()">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên tài khoản</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Địa Chỉ</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <?php
                            // Tổng số tài khoản
                            $totalAccounts = count($data);

                            // Số lượng tài khoản trên mỗi trang
                            $accountsPerPage = 8;

                            // Tính toán số lượng trang
                            $totalPages = ceil($totalAccounts / $accountsPerPage);

                            // Xác định trang hiện tại
                            $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

                            // Tính toán vị trí bắt đầu và kết thúc của tài khoản trên trang hiện tại
                            $startIndex = ($currentpage - 1) * $accountsPerPage;
                            $endIndex = ($startIndex + $accountsPerPage) - 1;
                            ?>
                            <tbody>
                            <?php
                            // var_dump($data);
                            // var_dump($userModel->getAllUser());
                            // exit;    
                            $counter = 1;
                            foreach ($data as $key => $value) { ?>
                                <tr>
                                    <th scope="row"><?= $counter++; ?></th>
                                    <td><?= $value['name']; ?></td>
                                    <td><?= $value['email']; ?></td>
                                    <td><?= $value['address']; ?></td>
                                    <td><?= $value['phone']; ?></td>
                                    <td>
                                    <button class="btn btn-primary btn-sm" onclick="editItem(<?= $value['id']; ?>)">Sửa</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteItem(<?= $value['id']; ?>)">Xóa</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="pagination-container">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
                                <li class="page-item <?php if ($page == $currentpage) { echo 'active'; } ?>">
                                    <a class="page-link" href="?page=<?= $page; ?>"><?= $page; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<script>
    function editItem(itemId) {
        var confirmEdit = confirm("Bạn có chắc chắn muốn sửa?");
        if (confirmEdit) {
            // Thực hiện hành động sửa ở đây
            // Ví dụ: chuyển hướng đến trang sửa với item ID
            window.location.href = "/edit?id=" + itemId;
        }
    }

    function deleteItem(itemId) {
        var confirmDelete = confirm("Bạn có chắc chắn muốn xóa?");
        if (confirmDelete) {
            // Thực hiện hành động xóa ở đây
            // Ví dụ: gửi yêu cầu xóa đến máy chủ với item ID
            // Sau đó cập nhật giao diện người dùng hoặc chuyển hướng đến trang danh sách cập nhật
        }
    }
</script>