<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$level = $_SESSION['emp_level'];
$department = $_SESSION['emp_departmentid'];
$department2 = $_SESSION['emp_departmentid2'];
$department3 = $_SESSION['emp_departmentid3'];
$type = $_REQUEST['type'];

if ($level == 'A') {
    if ($type == 'W') {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_approve='' ORDER BY id DESC";
        $result = $connect->query($sql);
    } elseif ($type == 'A') {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_approve!='' AND lev_approve!='ไม่อนุมัติ' ORDER BY id DESC";
        $result = $connect->query($sql);
    } elseif ($type == 'R') {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_approve='ไม่อนุมัติ' ORDER BY id DESC";
        $result = $connect->query($sql);
    }
} elseif ($level == 'M') {

    if ($type == 'W') {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_approve='' AND (lev_departmentid='$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3') ORDER BY id DESC";
        $result = $connect->query($sql);
    } elseif ($type == 'A') {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_approve!='' AND lev_approve!= 'ไม่อนุมัติ' AND (lev_departmentid='$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3') ORDER BY id DESC";
        $result = $connect->query($sql);
    } elseif ($type == 'R') {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_approve='ไม่อนุมัติ' AND (lev_departmentid='$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3') ORDER BY id DESC";
        $result = $connect->query($sql);
    }
}


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
                <div class="col-md-12 search-table-col" style="padding-left: 37px;padding-right: 41px;padding-top: 0px;margin-top: 0px;">
                    <div class="table-responsive table table-hover table-bordered results" style="padding-left: 30px;padding-right: 41px;margin-bottom: 0px;">
                        <table class="table table-hover table-bordered">
                            <thead class="bill-header cs">
                                <tr>
                                    <th id="trs-hd-1" class="col-lg-2">ชื่อพนักงาน</th>
                                    <th id="trs-hd-2" class="col-lg-2">แผนก</th>
                                    <th id="trs-hd-3" class="col-lg-2">ตำแหน่ง</th>
                                    <th id="trs-hd-4" class="col-lg-1">ประเภท</th>
                                    <th id="trs-hd-5" class="col-lg-1">จำนวนวัน</th>
                                    <th id="trs-hd-6" class="col-lg-1">จำนวนชั่วโมง</th>
                                    <th id="trs-hd-7" class="col-lg-2">ผู้อนุมัติ</th>
                                    <th id="trs-hd-8" class="col-lg-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="warning no-result">
                                    <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No Result !!!</td>
                                    <td>Cell 2</td>
                                    <td>Cell 3</td>
                                </tr>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $row['lev_emp']; ?></td>
                                        <td><?php echo $row['lev_department']; ?></td>
                                        <td><?php echo $row['lev_position']; ?></td>
                                        <td><?php echo $row['lev_type']; ?></td>
                                        <td><?php echo $row['lev_amount_day']; ?></td>
                                        <td><?php echo $row['lev_amount_time']; ?></td>
                                        <td><?php echo $row['lev_approve']; ?></td>
                                        <td><a href="desciption-leave.php?id=<?php echo $row['id']; ?>"><button class="btn btn-success" style="margin-left: 5px;" type="submit"><i class="far fa-file-alt" style="font-size: 15px;"></i></button></a><button class="btn btn-danger" style="margin-left: 5px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button></td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>