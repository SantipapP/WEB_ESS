<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');


if (!isset($_SESSION['emp_name'])) {
    header('location: index.php');
}
$emp = $_SESSION['emp_name'];
$department = $_SESSION['emp_departmentid'];
$department2 = $_SESSION['emp_departmentid2'];
$department3 = $_SESSION['emp_departmentid3'];
$position = $_SESSION['emp_position'];
$level = $_SESSION['emp_level'];

if ($level == 'A') { //กรณีผู้ใช้งานเป็นระดับผู้ดูแลระบบ
    //เริ่มดึงข้อมูลขอลา
    $sql = "SELECT COUNT(lev_emp) AS amount FROM tbl_leave_day"; //รายการขอลาทั้งหมด
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $amountall = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(lev_emp) AS amount FROM tbl_leave_day WHERE lev_approve = ''"; //รายการขอลารออนุมัติ
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $amountpapprove = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(lev_emp) AS amount FROM tbl_leave_day WHERE lev_approve != '' and lev_approve != 'ไม่อนุมัติ'"; //รายการขอลาที่อนุมัติแล้ว
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $amountapproved = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(lev_emp) AS amount FROM tbl_leave_day WHERE lev_approve = 'ไม่อนุมัติ'"; //รายการขอลาที่ปฏิเสธ
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $amountreject = $row['amount'];
    endwhile;
    //สิ้นสุดดึงขอลา
    // ----------------------------------------------------------------------------------------------------------------
    //เริ่มต้นนับจำนวนขอล่วงเวลา
    $sql = "SELECT COUNT(ot_re_emp) AS amount FROM tbl_ot_request"; //รายการล่วงเวลาทั้งหมด
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $otall = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(ot_re_emp) AS amount FROM tbl_ot_request WHERE ot_re_approve = ''"; //รายการล่วงเวลารออนุมัติ
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $otpapprove = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(ot_re_emp) AS amount FROM tbl_ot_request WHERE ot_re_approve != '' and ot_re_approve != 'ไม่อนุมัติ'"; //รายการล่วงเวลาอนุมัติแล้ว
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $otapprove = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(ot_re_emp) AS amount FROM tbl_ot_request WHERE ot_re_approve = 'ไม่อนุมัติ'"; //รายการล่วงเวลาอนุมัติแล้ว
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $otreject = $row['amount'];
    endwhile;
    //สิ้นสุดนับจำนวนขอล่วงเวลา
} elseif ($level == 'M') { //กรณีผู้ใช้งานเป็นระดับผู้จัดการ
    //เริ่มดึงข้อมูลขอลาตามแผนกของผู้จัดการ
    $sql = "SELECT COUNT(lev_emp) AS amount FROM tbl_leave_day WHERE lev_departmentid='$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3'"; //รายการขอลาทั้งหมด
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $amountall = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(lev_emp) AS amount FROM tbl_leave_day WHERE lev_approve = '' and (lev_departmentid='$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3')"; //รายการขอลารออนุมัติ
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $amountpapprove = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(lev_emp) AS amount FROM tbl_leave_day WHERE lev_approve != '' and lev_approve != 'ไม่อนุมัติ' and (lev_departmentid='$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3')"; //รายการขอลาที่อนุมัติแล้ว
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $amountapproved = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(lev_emp) AS amount FROM tbl_leave_day WHERE lev_approve = 'ไม่อนุมัติ' and (lev_departmentid='$department' OR lev_departmentid = '$department2' OR lev_departmentid = '$department3')"; //รายการขอลาที่ปฏิเสธ
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $amountreject = $row['amount'];
    endwhile;
    //สิ้นสุดดึงขอลา
    //เริ่มต้นดึงวันล่วงเวลาแบ่งตามแผนกของผู้จัดการ
    $sql = "SELECT COUNT(ot_re_emp) AS amount FROM tbl_ot_request WHERE ot_re_department='$department' OR ot_re_department = '$department2' OR ot_re_department = '$department3'";
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $otall = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(ot_re_emp) AS amount FROM tbl_ot_request WHERE ot_re_approve = '' and (ot_re_department='$department' OR ot_re_department = '$department2' OR ot_re_department = '$department3')";
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $otpapprove = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(ot_re_emp) AS amount FROM tbl_ot_request WHERE ot_re_approve != '' and ot_re_approve != 'ไม่อนุมัติ' and (ot_re_department='$department' OR ot_re_department = '$department2' OR ot_re_department = '$department3')";
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $otapprove = $row['amount'];
    endwhile;

    $sql = "SELECT COUNT(ot_re_emp) AS amount FROM tbl_ot_request WHERE ot_re_approve = 'ไม่อนุมัติ' and (ot_re_department='$department' OR ot_re_department = '$department2' OR ot_re_department = '$department3')";
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) :
        $otreject = $row['amount'];
    endwhile;
    //สิ้นสุดดึงล่วงเวลาแบ่งตามแผนกของผู้จัดการ
} else {
    header('refresh:0; url=main.php');
    echo "<script>alert('บัญชีของคุณไม่สามารถเข้าถึงในส่วนนี้');</script>";
}


//$sql = "SELECT * FROM tbl_leave_day WHERE lev_ = '$emp' ORDER BY ot_re_date DESC";
//$result = $connect->query($sql);
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
    <link rel="stylesheet" href="assets/css/gradient.css">
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
                <section class="mt-4"></section>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary m-0 fw-bold">การจัดการส่วนงานลา</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="list-leave-day.php" style="text-decoration:none">
                                                <div class="card shadow border-start-primary py-2" style="background: linear-gradient(145deg, cyan, white);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(0,0,0);">ทั้งหมด</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $amountall; ?>&nbsp;รายการ</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto"><i class="far fa-list-alt fa-2x text-black-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="leave-status.php?type=<?php echo 'W'; ?>" style="text-decoration:none">
                                                <div class="card shadow border-start-primary py-2" style="background: linear-gradient(145deg, yellow, white);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(0,0,0);">รออนุมัติ</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $amountpapprove; ?>&nbsp;รายการ</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto"><i class="far fa-clock fa-2x text-black-300"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="leave-status.php?type=<?php echo 'A'; ?>" style="text-decoration:none">
                                                <div class="card shadow border-start-primary py-2" style="background: linear-gradient(145deg, lightgreen, white);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(0,0,0);">อนุมัติแล้ว</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $amountapproved; ?>&nbsp;รายการ</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto"><i class="fas fa-check-circle fa-2x text-black-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="leave-status.php?type=<?php echo 'R'; ?>" style="text-decoration:none">
                                                <div class="card shadow border-start-primary py-2" style="background: linear-gradient(145deg, red, white);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(0,0,0);">ปฏิเสธแล้ว</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $amountreject; ?>&nbsp;รายการ</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto"><i class="far fa-times-circle fa-2x text-black-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary m-0 fw-bold">การจัดการขอล่วงเวลา</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="list-ot.php" style="text-decoration:none">
                                                <div class="card shadow border-start-primary py-2"
                                                    style="background: linear-gradient(145deg, cyan, white);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div
                                                                    class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(0,0,0);">ทั้งหมด</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $otall; ?>&nbsp;รายการ</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto"><i
                                                                    class="fas fa-circle-notch fa-2x text-black-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="ot-status.php?type=<?php echo 'W'; ?>"
                                                style="text-decoration:none">
                                                <div class="card shadow border-start-primary py-2"
                                                    style="background: linear-gradient(145deg, yellow, white);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div
                                                                    class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(0,0,0);">รออนุมัติ</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $otpapprove; ?>&nbsp;รายการ</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto"><i
                                                                    class="far fa-clock fa-2x text-black-300"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="ot-status.php?type=<?php echo 'A'; ?>"
                                                style="text-decoration:none">
                                                <div class="card shadow border-start-primary py-2"
                                                    style="background: linear-gradient(145deg, lightgreen, white);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div
                                                                    class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(0,0,0);">อนุมัติแล้ว</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $otapprove; ?>&nbsp;รายการ</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto"><i
                                                                    class="far fa-check-circle fa-2x text-black-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="ot-status.php?type=<?php echo 'R'; ?>"
                                                style="text-decoration:none">
                                                <div class="card shadow border-start-primary py-2"
                                                    style="background: linear-gradient(145deg, red, white);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div
                                                                    class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(0,0,0);">ปฏิเสธแล้ว</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $otreject ?>&nbsp;รายการ</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto"><i
                                                                    class="far fa-times-circle fa-2x text-black-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--!>
                <!--<div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary m-0 fw-bold">การจัดการอุปกรณ์ในแผนก</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card shadow border-start-primary py-2">
                                                <div class="card-body">
                                                    <div class="row align-items-center no-gutters">
                                                        <div class="col me-2">
                                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                <span>ทั้งหมด</span>
                                                            </div>
                                                            <div class="text-dark fw-bold h5 mb-0">
                                                                <span>CommingSoon</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto"><i class="fas fa-table fa-2x text-gray-300"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow border-start-primary py-2">
                                                <div class="card-body">
                                                    <div class="row align-items-center no-gutters">
                                                        <div class="col me-2">
                                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                <span style="color: rgb(250,0,255);">รออนุมัติ</span>
                                                            </div>
                                                            <div class="text-dark fw-bold h5 mb-0">
                                                                <span>CommingSoon</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto"><i class="far fa-clock fa-2x text-gray-300"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow border-start-primary py-2">
                                                <div class="card-body">
                                                    <div class="row align-items-center no-gutters">
                                                        <div class="col me-2">
                                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                <span style="color: rgb(66,255,0);">อนุมัติแล้ว</span>
                                                            </div>
                                                            <div class="text-dark fw-bold h5 mb-0">
                                                                <span>CommingSoon</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto"><i class="far fa-check-circle fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow border-start-primary py-2">
                                                <div class="card-body">
                                                    <div class="row align-items-center no-gutters">
                                                        <div class="col me-2">
                                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                <span style="color: rgb(255,0,0);">ปฏิเสธแล้ว</span>
                                                            </div>
                                                            <div class="text-dark fw-bold h5 mb-0">
                                                                <span>CommingSoon</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto"><i class="far fa-times-circle fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © ESPG 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js">
    </script>
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