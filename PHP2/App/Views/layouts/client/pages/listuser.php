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
                            <button class="btn btn-primary btn-sm" onclick="editItem(<?= $value['id']; ?>)">
                                <a href="http://php2/?url=UserController/userUpdate/<?= $value['id'] ?>">Sửa</a>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= isset($value['id']) ? $value['id'] : '0'; ?>)">
                                <a href="javascript:void(0);">Xóa</a>
                            </button>
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
                            <?php
                            $totalRows = $counter; // Số lượng dòng dữ liệu
                            $rowsPerPage = 10; // Số lượng dòng trên mỗi trang
                            $totalPages = ceil($totalRows / $rowsPerPage);
                            for ($page = 1; $page <= $totalPages; $page++) { ?>
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
function confirmDelete(id) {
    if (confirm("Bạn có chắc chắn muốn xóa?")) {
        // Thực hiện các hành động xóa với id
        console.log("Đồng ý xóa với id:", id);
        // Chuyển hướng đến trang xóa với tham số id
        window.location.href = "http://php2/?url=UserController/userDelete/" + id;
    } else {
        // Không thực hiện hành động gì
    }
}
</script>