<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');


if (!isset($_SESSION['emp_name'])) {
    header('location: index.php');
}
$id = $_REQUEST["id"];
$sql = "SELECT * FROM tbl_ot_request WHERE ot_re_id=$id";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>รายละเอียดคำขอ</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('nav-menu.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <!--<div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>-->
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <?php include('top-menu.php'); ?>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4"></h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card textwhite bg-primary text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">

                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card textwhite bg-success text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">

                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <p class="text-primary m-0 fw-bold">รายละเอียดคำขอ</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="approve_ot_request.php?id=<?php echo $row['ot_re_id']; ?>" method="POST">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>วัน/เดือน/ปี</strong><br></label><input class="form-control" type="text" name="date" disabled="" value="<?php echo $row['ot_re_date']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>เวลาเริ่ม</strong><br></label><input class="form-control" type="text" id="first_name-1" name="start" disabled="" value="<?php echo $row['ot_re_start']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>เวลาเลิก</strong><br></label><input class="form-control" type="text" id="first_name-2" name="end" disabled="" value="<?php echo $row['ot_re_end']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>ชั่วโมง</strong><br></label><input class="form-control" type="text" id="first_name-2" name="time" disabled="" value="<?php echo $row['ot_re_time']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>แผนก</strong></label><input class="form-control" type="text" name="department" disabled="" value="<?php echo $row['ot_re_department']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>รายละเอียดงาน</strong></label><input class="form-control" type="text" id="first_name-9" name="desciption" disabled="" value="<?php echo $row['ot_re_desciption']; ?>"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Job/PO.No</strong><br></label><input class="form-control" type="text" id="first_name-3" name="po" disabled="" value="<?php echo $row['ot_re_po']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>จำนวน</strong><br></label><input class="form-control" type="text" id="first_name-4" name="price" disabled="" value="<?php echo $row['ot_re_price']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>ผู้ขอ</strong><br></label><input class="form-control" type="text" id="first_name-5" name="emp" disabled="" value="<?php echo $row['ot_re_emp']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>ผู้อนุมัติ</strong><br></label><input class="form-control" type="text" id="first_name-6" name="manager" disabled="" value="<?php echo $row['ot_re_approve']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"></div><button class="btn btn-success btn-icon-split" type="submit"><span class="text-white-50 icon"><i class="fas fa-check"></i></span><span class="text-white text">อนุมัติ</span></button>
                                                    </div>

                                                </div>

                                            </form>
                                            <div class="row">

                                                <div class="col">
                                                    <div class="mb-3"></div><a href="reject_ot_request.php?id=<?php echo $row["ot_re_id"]; ?>" style="text-decoration:none"><button class="btn btn-danger btn-icon-split" type="button"><span class="text-white-50 icon"><i class="fas fa-trash"></i></span><span class="text-white text">ไม่อนุมัติ</span></button></a>
                                                </div>
                                            </div>
                                        <?php endwhile ?>
                                        </div>
                                    </div>
                                    <div class="card shadow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5"></div>
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