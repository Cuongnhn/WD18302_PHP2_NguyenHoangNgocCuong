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
                            <li><a href="#">Sinh Viên</a></li>
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
                                <strong class="card-title">Danh Sách Sinh Viên</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên </th>
                                            <th scope="col">MSSV</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Địa Chỉ</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // var_dump($data);
                                    // exit;
                                    $counter = 1;
                                    foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <th scope="row"><?= $counter++; ?></th>
                                            <td><?= isset($value['first_name']) ? $value['first_name'] : ''; ?></td>
                                            <td><?= isset($value['student_code']) ? $value['student_code'] : ''; ?></td>
                                            <td><?= isset($value['email']) ? $value['email'] : ''; ?></td>
                                            <td><?= isset($value['address']) ? $value['address'] : ''; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" onclick="editItem(<?= isset($value['id']) ? $value['id'] : ''; ?>)">Sửa</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteItem(<?= isset($value['id']) ? $value['id'] : ''; ?>)">Xóa</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination-container">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->