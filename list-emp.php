<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
@ini_set('display_errors', '0');

if (!isset($_SESSION['emp_name'])) {
    header('location: index.php');
}
if ($_GET['name'] != "") {

    $sql = "SELECT * FROM tbl_emp WHERE emp_name Like '" . $_GET["name"] . "%'";
    $result = $connect->query($sql);
} else {
    $sql = "SELECT * FROM tbl_emp LEFT JOIN tbl_department on tbl_emp.emp_department = tbl_department.de_id";
    $result = $connect->query($sql);
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
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>รายชื่อพนักงาน</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>

<body id="page-top" class="sidebar-toggled">



    <div id="wrapper">
        <?php include('nav-menu.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <!--<input class="bg-light form-control border-0 small" type="text"
                                    placeholder="Search forff ..."><button class="btn btn-primary py-0" type="button"><i
                                        class="fas fa-search"></i></button>-->
                            </div>
                        </form>
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
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">รายชื่อพนักงาน</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span></span><a class="btn btn-primary btn-icon-split" role="button" href="register-emp.php"><span class="text-white-50 icon"><i class="fas fa-plus"></i></span><span class="text-white text">เพิ่มพนักงาน</span></a>
                                                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#" onClick='javascript:ExcelReport();'><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate
                                                    Excel Report</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">

                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
                                            <div class="input-group">
                                                <input class="bg-light form-control border-0 small" type="text" placeholder="ค้นหาพนักงาน" name="name">
                                                <button class="btn btn-primary py-0" type="submit"><i class="fas fa-search"></i></button>
                                            </div>

                                        </form>
                                        <div class="input-group">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>รหัสพนักงาน</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>แผนก</th>

                                            <th>อีเมล</th>
                                            <th>ลาพักร้อน</th>
                                            <th>ลากิจ</th>
                                            <th>ลาป่วย</th>
                                            <th>ระดับสิทธิ์</th>
                                            <th>รายงาน</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['emp_id']; ?></td>
                                                <td><?php echo $row['emp_name']; ?></td>
                                                <td><?php echo $row['de_name']; ?></td>

                                                <td><?php echo $row['emp_email']; ?></td>
                                                <td><?php echo $row['emp_annaul']; ?></td>
                                                <td><?php echo $row['emp_leave']; ?></td>
                                                <td><?php echo $row['emp_sick']; ?></td>
                                                <td><?php echo $row['emp_level']; ?></td>
                                                <td><a href="leaveday-pdf.php?id=<?php echo $row['emp_id']; ?>"><button type="button" class="btn btn-success" title="รายงานลาประจำปี"><i class="fas fa-plane" style="font-size: 15px;"></i></button></a></td>
                                                <td><a href="emp-info.php?id=<?php echo $row['emp_id']; ?>"><button type="button" class="btn btn-success" title="ข้อมูล"><i class="fas fa-user-tag" style="font-size: 15px;"></i></button></a>&nbsp;<a href="frm-update-leave.php?id=<?php echo $row['emp_id']; ?>"><button type="button" class="btn btn-primary" title="กำหนดจำนวนวันลา"><i class="fa fa-user-clock" style="font-size: 15px;"></i></button></a>&nbsp;<a href="JavaScript:if(confirm('ยืนยันเพิ่มระดับ <?php echo $row['emp_name']; ?>  เป็นผู้ดูแล ?')==true){window.location='up-to-admin.php?id=<?php echo $row['emp_id']; ?>';}"><button type="button" class="btn btn-success" title="เพิ่มระดับผู้ใช้"><i class="fas fa-user-plus" style="font-size: 15px;"></i></button></a>&nbsp;<a href="JavaScript:if(confirm('ยืนยันลดระดับ <?php echo $row['emp_name']; ?>  เป็นผู้ใช้งานทั่วไป ?')==true){window.location='down-to-user.php?id=<?php echo $row['emp_id']; ?>';}"><button type="button" class="btn btn-secondary"><i class="fas fa-user-minus" style="font-size: 15px;"></i></button></a>&nbsp;<a href="JavaScript:if(confirm('ยืนยันแก้ไข <?php echo $row['emp_name']; ?>  เป็นพนักงานลาออก ?')==true){window.location='resign-user.php?id=<?php echo $row['emp_id']; ?>';}"><button type="button" class="btn btn-danger"><i class="fas fa-user-alt-slash" style="font-size: 15px;"></i></button></a></td>
                                            </tr>
                                        <?php endwhile ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>รหัสพนักงาน</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>แผนก</th>

                                                <th>อีเมล</th>
                                                <th>ลาพักร้อน</th>
                                                <th>ลากิจ</th>
                                                <th>ลาป่วย</th>
                                                <th>ระดับสิทธิ์</th>
                                                <th>รายงาน</th>
                                                <th>จัดการ</th>
                                            </tr>
                                        </tfoot>
                                </table>
                            </div>
                            <div class="row">

                            </div>
                        </div>
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
    <script src="assets/js/theme.js"></script>
</body>

</html>