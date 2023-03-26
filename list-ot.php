<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
@ini_set('display_errors', '0');
$level = $_SESSION['emp_level'];
$department = $_SESSION['emp_department'];
$department2 = $_SESSION['emp_department2'];
$department3 = $_SESSION['emp_department3'];

if ($level == 'A') {
    if ($_GET['emp'] != "") {
        $sql = "SELECT * FROM tbl_ot_request WHERE ot_re_emp Like '%" . $_GET["emp"] . "%'";
        $result = $connect->query($sql);
    } elseif ($_GET['department'] != "") {
        $company = $_GET["department"];
        $sql = "SELECT * FROM tbl_ot_request WHERE ot_re_department Like '%" . $_GET["department"] . "%'";
        $result = $connect->query($sql);
    } elseif ($_GET['company'] != "") {
        $company = $_GET['company'];
        $sql = "SELECT * FROM tbl_ot_request WHERE ot_re_company = '$company'";
        $result = $connect->query($sql);
    } else {
        $sql = "SELECT * FROM tbl_ot_request ";
        $result = $connect->query($sql);
    }
} elseif ($level == 'M') {
    if ($_GET['emp'] != "") {
        $sql = "SELECT * FROM tbl_ot_request WHERE ot_re_emp Like '%" . $_GET["emp"] . "%' AND lev_department = '$department' OR lev_department = '$department2' OR lev_department = '$department3'";
        $result = $connect->query($sql);
    } elseif ($_GET['department'] != "") {
        $company = $_GET["department"];
        $sql = "SELECT * FROM tbl_ot_request WHERE ot_re_department Like '%" . $_GET["department"] . "%' AND lev_department = '$department' OR lev_department = '$department2' OR lev_department = '$department3'";
        $result = $connect->query($sql);
    } elseif ($_GET['company'] != "") {
        $company = $_GET['company'];
        $sql = "SELECT * FROM tbl_ot_request WHERE ot_re_company = '$company' AND lev_department = '$department' OR lev_department = '$department2' OR lev_department = '$department3'";
        $result = $connect->query($sql);
    } else {
        $sql = "SELECT * FROM tbl_ot_request AND lev_department = '$department' OR lev_department = '$department2' OR lev_department = '$department3' ";
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
                <section class="mt-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary m-0 fw-bold">รายการยื่นขอล่วงเวลา</h6>
                                    </div>
                                    <div class="card-body">
                                        <form method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" style="padding-bottom: 0px;margin-bottom: -74px;">
                                            <div class="row">
                                                <div class="col"><input class="form-control" type="text" placeholder="ค้นหาพนักงาน" name="emp"></div>
                                                <div class="col"><select class="form-select" name="department">
                                                        <option value="" selected="">ค้นหาตามแผนก</option>
                                                        <optgroup label="ESPOWER">
                                                            <option value="Management">Management</option>
                                                            <option value="Sales">Sales</option>
                                                            <option value="Marketing">Marketing</option>
                                                            <option value="Accounting">Accounting</option>
                                                            <option value="Finance">Finance</option>
                                                            <option value="Corporate">Corporate</option>
                                                            <option value="HR&amp;Admin">HR&amp;Admin</option>
                                                            <option value="IT&amp;Facilities">IT&amp;Facilities</option>
                                                            <option value="Technical &amp; Services">Technical &amp;
                                                                Services
                                                            </option>
                                                            <option value="Inventory">Inventory</option>
                                                        </optgroup>
                                                        <optgroup label="ESP">
                                                            <option value="ISO">ISO</option>
                                                            <option value="Control Component(101)">Control
                                                                Component(101)</option>
                                                            <option value="Switchboard(102)">Switchboard(102)</option>
                                                            <option value="Metal Works(103)">Metal Works(103)</option>
                                                            <option value="QA(104)">QA(104)</option>
                                                            <option value="D&amp;D(105)">D&amp;D(105)</option>
                                                            <option value="Procurement">Procurement</option>
                                                            <option value="Stock">Stock</option>
                                                        </optgroup>
                                                    </select></div>
                                                <div class="col"><select class="form-select" name="company">

                                                        <option value="">เลือกบริษัท</option>
                                                        <option value="ESPOWER">ESPOWER</option>
                                                        <option value="ESP">ESP</option>

                                                    </select></div>
                                                <div class="col">
                                                    <div class="btn-group" role="group"><button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>
                                                            ค้นหา
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-clock"></i>
                                                        ค้นหาช่วงเวลา
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="col-md-12 search-table-col">
                                            <div class="table-responsive table table-hover table-bordered results" style="margin-top: 0px;padding-top: 0px;">
                                                <table class="table table-hover table-bordered">
                                                    <thead class="bill-header cs">
                                                        <tr>
                                                            <th id="trs-hd-1" class="col-lg-1">วันที่</th>
                                                            <th id="trs-hd-2" class="col-lg-1">จำนวนชั่วโมง</th>
                                                            <th id="trs-hd-3" class="col-lg-1">บริษัท</th>
                                                            <th id="trs-hd-4" class="col-lg-1">แผนก</th>
                                                            <th id="trs-hd-5" class="col-lg-1">ผู้ขอ</th>
                                                            <th id="trs-hd-6" class="col-lg-1">ผู้อนุมัติ</th>
                                                            <th id="trs-hd-7" class="col-lg-2">การจัดการ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="warning no-result">
                                                            <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No
                                                                Result !!!</td>
                                                            <td>Cell 2</td>
                                                        </tr>
                                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                                            <tr>
                                                                <td><?php echo $row['ot_re_date']; ?></td>
                                                                <td><?php echo $row['ot_re_time']; ?></td>
                                                                <td><?php echo $row['ot_re_company']; ?></td>
                                                                <td><?php echo $row['ot_re_department']; ?></td>
                                                                <td><?php echo $row['ot_re_emp']; ?></td>
                                                                <td><?php echo $row['ot_re_approve']; ?></td>
                                                                <td><a href="des_ot_request.php?id=<?php echo $row['ot_re_id']; ?>"><button class="btn btn-success" style="margin-left: 5px;" type="submit"><i class="fa fa-check" style="font-size: 15px;"></i></button></a><button class="btn btn-danger" style="margin-left: 5px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button></td>
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
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>