<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_REQUEST['id'];

$sql = "SELECT * FROM tbl_emp WHERE emp_id=$id";
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
</head>

<body id="page-top">
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
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="container">
                        <div class="row">
                            <div class="col" style="margin-bottom: 30px;"><label class="col-form-label fs-4">แก้ไขจำนวนวันลาของ
                                    -&nbsp;&nbsp;<?php echo $row['emp_name']; ?></label></div>
                        </div>
                    </div>
                    <div class="container" style="padding-left: 207px;padding-right: 169px;">
                        <form action="update-leave.php?id=<?php echo $row['emp_id']; ?>" method="POST">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="text-primary m-0 fw-bold">จำนวนวันลาพักร้อน</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-control" type="number" name="annaul" value="<?php echo $row['emp_annaul']; ?>">
                                                        </div>
                                                        <div class="col">
                                                            <label for="leaveday">วัน</label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-control" type="number" name="tannaul" value="<?php echo $row['emp_annaul_time']; ?>">
                                                        </div>
                                                        <div class="col">
                                                            <label for="leaveday">ชั่วโมง</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="text-primary m-0 fw-bold">จำนวนวันลากิจ</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-control" type="number" name="leave" value="<?php echo $row['emp_leave']; ?>">
                                                        </div>
                                                        <div class="col">
                                                            <label for="leaveday">วัน</label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-control" type="number" name="tleave" value="<?php echo $row['emp_leave_time']; ?>">
                                                        </div>
                                                        <div class="col">
                                                            <label for="leaveday">ชั่วโมง</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="text-primary m-0 fw-bold">จำนวนวันลาป่วย</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-control" type="number" name="sick" value="<?php echo $row['emp_sick']; ?>">
                                                        </div>
                                                        <div class="col">
                                                            <label for="leaveday">วัน</label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-control" type="number" name="tsick" value="<?php echo $row['emp_sick_time']; ?>">
                                                        </div>
                                                        <div class="col">
                                                            <label for="leaveday">ชั่วโมง</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <div class="btn-group" role="group"><button class="btn btn-primary" type="submit" style="margin-left: -1px;">บันทึกข้อมูล</button><button class="btn btn-danger" type="button" style="margin-left: 16px;">ล้างค่าวันลา</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        <?php endwhile ?>
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
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>