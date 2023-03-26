<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$sql = "SELECT * FROM tbl_external_company";
$result = $connect->query($sql);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blank Page - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search-search-table.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>

<body id="page-top">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มบริษัทภายนอก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add-ext-company.php" method="POST" enctype="multipart/form-data">
                        <div class=" row">
                            <div class="col">
                                <label for="id">ตัวย่อบริษัท</label>
                            </div>
                            <div class="col">
                                <label for="name">ชื่อบริษัท</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="ecid" id="id" class="form-control" required>
                            </div>
                            <div class="col">
                                <input type="text" name="ecname" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="address">ที่อยู่</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="ecaddress" id="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="tel">เบอร์โทรศัพท์</label>
                            </div>
                            <div class="col">
                                <label for="logo">โลโก้</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="ectel" id="tel" class="
                                    form-control" required>
                            </div>
                            <div class="col">
                                <input type="file" name="eclogo" id="logo" class="form-control" required>
                            </div>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save External Company</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Model-->

    <div id="wrapper">
        <?php include('nav-menu.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <?php include('top-menu.php'); ?>
                        </ul>
                    </div>
                </nav>
                <section class="mt-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary m-0 fw-bold">รายการบริษัทภายนอก</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="m-0"></p>
                                        <section class="mt-4">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card shadow">
                                                            <div class="card-header py-2" style="margin-bottom: 0px;">
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
                                                                    เพิ่มบริษัท
                                                                </button>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive table mb-0 pt-3 pe-2">
                                                                    <table class="table table-striped table-sm my-0 mydatatable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>รหัสบริษัท</th>
                                                                                <th>โลโก้</th>
                                                                                <th>ชื่อบริษัท</th>
                                                                                <th>ที่อยู่</th>
                                                                                <th>เบอร์โทรศัพท์</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                                                <tr>
                                                                                    <td><?php echo $row['ec_id']; ?></td>
                                                                                    <td><img src='fileupload/extCompany/<?php echo $row['ec_logo']; ?>' width='100'></td>
                                                                                    <td><?php echo $row['ec_name']; ?></td>
                                                                                    <td><?php echo $row['ec_address']; ?>
                                                                                    </td>
                                                                                    <td><?php echo $row['ec_tel']; ?></td>
                                                                                </tr>
                                                                            <?php endwhile ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © ArtLongDev 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="assets/js/DataTable---Fully-BSS-Editable.js"></script>
    <script src="assets/js/Dynamically-Add-Remove-Table-Row.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>