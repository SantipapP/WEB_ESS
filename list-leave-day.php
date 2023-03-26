<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$level = $_SESSION['emp_level'];
$department = $_SESSION['emp_departmentid'];
$department2 = $_SESSION['emp_departmentid2'];
$department3 = $_SESSION['emp_departmentid3'];

$sql1 = "SELECT * FROM tbl_department ORDER BY de_company";
$result1 = $connect->query($sql1);

//$type = $_REQUEST['type'];
@ini_set('display_errors', '0');


if ($level == 'A') {
    if ($_GET['emp'] != "") {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_emp Like '%" . $_GET["emp"] . "%'";
        $result = $connect->query($sql);
    } elseif ($_GET['department'] != "") {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_departmentid Like '%" . $_GET["department"] . "%'";
        $result = $connect->query($sql);
    } elseif ($_GET['type'] != "") {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_type Like '%" . $_GET["type"] . "%'";
        $result = $connect->query($sql);
    } elseif ($_GET['stime'] != "" && $_GET['etime'] != "") {
        $skey = $_GET['stime'];
        $ekey = $_GET['etime'];
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_stime between '$skey' and '$ekey' ";
        $result = $connect->query($sql);
    } else {
        $sql = "SELECT * FROM tbl_leave_day ORDER BY id DESC";
        $result = $connect->query($sql);
    }
} else {

    if ($_GET['emp'] != "") {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_emp Like '%" . $_GET["emp"] . "%' AND lev_departmentid = '$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3'";
        $result = $connect->query($sql);
    } elseif ($_GET['department'] != "") {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_department Like '%" . $_GET["department"] . "%' AND lev_departmentid = '$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3'";
        $result = $connect->query($sql);
    } elseif ($_GET['type'] != "") {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_type Like '%" . $_GET["type"] . "%' AND lev_departmentid = '$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3'";
        $result = $connect->query($sql);
    } elseif ($_GET['stime'] != "" && $_GET['etime'] != "") {
        $skey = $_GET['stime'];
        $ekey = $_GET['etime'];
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_stime between '$skey' and '$ekey' AND lev_departmentid = '$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3'";
        $result = $connect->query($sql);
    } else {
        $sql = "SELECT * FROM tbl_leave_day WHERE lev_departmentid = '$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3'";
        $result = $connect->query($sql);
    }
}
if (isset($_GET['act'])) {
    if ($_GET['act'] == 'excel') {
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=export.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}


?>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/file-saver@1.3.3/FileSaver.js"></script>

<script>
    function ExcelReport() //function สำหรับสร้าง ไฟล์ excel จากตาราง
    {
        var sheet_name = "excel_sheet"; /* กำหหนดชื่อ sheet ให้กับ excel โดยต้องไม่เกิน 31 ตัวอักษร */
        var elt = document.getElementById('dataTable'); /*กำหนดสร้างไฟล์ excel จาก table element ที่มี id ชื่อว่า myTable*/

        /*------สร้างไฟล์ excel------*/
        var wb = XLSX.utils.table_to_book(elt, {
            sheet: sheet_name
        });
        XLSX.writeFile(wb, 'report.xlsx'); //Download ไฟล์ excel จากตาราง html โดยใช้ชื่อว่า report.xlsx
    }
</script>
<style type="text/css">
    table {
        border-collapse: collapse;
        width: 40%;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }
</style>
<style>
    tbody tr:nth-child(even) {
        background-color: burlywood;
        color: #fff;
    }
</style>

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
                    <h5 class="modal-title" id="exampleModalLabel">ค้นหาช่วงเวลา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="get">
                        <div class="row">
                            <div class="col">
                                <label for="stime">วันเริ่มต้น</label>
                            </div>
                            <div class="col">
                                <label for="stime">วันสิ้นสุด</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="date" name="stime" id="" class="form-control">
                            </div>
                            <div class="col">
                                <input type="date" name="etime" id="" class="form-control">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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

                    </div>
                </section>
                <div class="container">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-primary m-0 fw-bold">การค้นหา</h6>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#" onClick='javascript:ExcelReport();'><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Excel
                                        Report</a>
                                </div>
                                <div class="col">

                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <form method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
                                <div class="row">
                                    <div class="col"><input class="form-control" type="text" placeholder="ค้นหาพนักงาน" name="emp">
                                    </div>
                                    <div class="col"><select class="form-select" name="department">
                                            <option value="" selected="">ค้นหาตามแผนก</option>
                                            <?php while ($row1 = $result1->fetch_assoc()) : ?>
                                                <option value="<?php echo $row1['de_id']; ?>">
                                                    <?php echo $row1['de_company']; ?> :
                                                    <?php echo $row1['de_name']; ?></option>
                                            <?php endwhile ?>
                                        </select></div>
                                    <div class="col"><select class="form-select" name="type">
                                            <option value="" selected="">ค้นหาตามประเภทลา</option>
                                            <option value="ลาพักร้อน">ลาพักร้อน</option>
                                            <option value="ลากิจ">ลากิจ</option>
                                            <option value="ลาป่วย">ลาป่วย</option>
                                        </select></div>

                                    <div class="col">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-clock"></i>
                                            ค้นหาช่วงเวลา
                                        </button>
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>ค้นหา</button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 search-table-col" style="padding-top: 0px;margin-top: 39px;">
                    <div class="table-responsive table table-hover table-bordered results" style="margin-left: 40px;margin-right: -38px;padding-right: 103px;">
                        <table class="table table-hover table-bordered" id="dataTable">
                            <thead class="bill-header cs">
                                <tr>
                                    <th id="trs-hd-1" class="col-lg-1">วันที่</th>
                                    <th id="trs-hd-2" class="col-lg-2">ชื่อพนักงาน</th>
                                    <th id="trs-hd-3" class="col-lg-1">แผนก</th>
                                    <th id="trs-hd-4" class="col-lg-1">ตำแหน่ง</th>
                                    <th id="trs-hd-5" class="col-lg-1">ประเภท</th>
                                    <th id="trs-hd-6" class="col-lg-1">จำนวนวัน</th>
                                    <th id="trs-hd-7" class="col-lg-1">จำนวนชั่วโมง</th>
                                    <th id="trs-hd-8" class="col-lg-2">ผู้อนุมัติ</th>
                                    <th id="trs-hd-9" class="col-lg-2">หมายเหตุ</th>
                                    <th id="trs-hd-10" class="col-lg-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="warning no-result">
                                    <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No Result !!!</td>
                                    <td>Cell 2</td>
                                </tr>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $row['lev_stime']; ?></td>
                                        <td><?php echo $row['lev_emp']; ?></td>
                                        <td><?php echo $row['lev_department']; ?></td>
                                        <td><?php echo $row['lev_position']; ?></td>
                                        <td><?php echo $row['lev_type']; ?></td>
                                        <td><?php echo $row['lev_amount_day']; ?></td>
                                        <td><?php echo $row['lev_amount_time']; ?></td>
                                        <td><?php echo $row['lev_approve']; ?></td>
                                        <td><?php echo $row['lev_note2']; ?></td>
                                        <td><a href="desciption-leave.php?id=<?php echo $row['id']; ?>"><button class="btn btn-success" style="margin-left: 5px;" type="submit" title="รายละเอียด"><i class="fas fa-file-alt" style="font-size: 15px;"></i></button></a>
                                            <a href="JavaScript:if(confirm('ยืนยันลบคำขอลาเลขที่ <?php echo $row['id']; ?> ของ <?php echo $row['lev_emp']; ?>')==true){window.location='remove-leave-request.php?id=<?php echo $row['id']; ?>';}"><button class="btn btn-danger" style="margin-left: 5px;" type="button"><i class="fa fa-trash" style="font-size: 15px;"></i></button></a>
                                        </td>
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