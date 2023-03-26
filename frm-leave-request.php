<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$year = date('Y');
$id = $_SESSION["id"];
$emp = $_SESSION["emp_name"];

$sql = "SELECT * FROM tbl_emp WHERE emp_id = '$id'";
$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) :
    $annaul = $row["emp_annaul"];
    $leave = $row["emp_leave"];
    $sick = $row["emp_sick"];
    $tannaul = $row["emp_annaul_time"];
    $tleave = $row["emp_leave_time"];
    $tsick = $row["emp_sick_time"];
endwhile;

//เริ่มนับจำนวนวันพักร้อน

$sql = "SELECT SUM(lev_amount_day) AS amount_userd FROM `tbl_leave_day` WHERE lev_empid = '$id' AND lev_type = 'ลาพักร้อน' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result = $connect->query($sql);
while ($row = $result->fetch_assoc()) :
    $userdannaul = $row["amount_userd"];
endwhile;
$sql1 = "SELECT SUM(lev_amount_time) AS time_userd FROM `tbl_leave_day` WHERE lev_empid = '$id' AND lev_type = 'ลาพักร้อน' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result1 = $connect->query($sql1);
while ($row1 = $result1->fetch_assoc()) :
    $timeannaul = $row1["time_userd"];
endwhile;

while ($timeannaul >= 8) {
    $userdannaul = $userdannaul + 1;
    $timeannaul = $timeannaul - 8;
}
//สิ้นสุดนับจำนวนวันพักร้อน
//เริ่มคำนวนวันพักร้อนคงเหลือ
$remainday = 0;
$alltime = ($annaul * 8) + $tannaul;
$userdhour = ($userdannaul * 8) + $timeannaul;

$remainall = $alltime - $userdhour;
while ($remainall >= 8) {
    $remainday++;
    $remainall = $remainall - 8;
}
//สิ้นสุดคำนวนวันพักร้อนคงเหลือ

//เริ่มนับจำนวนวันลากิจ

$sql2 = "SELECT SUM(lev_amount_day) AS amount_userd FROM `tbl_leave_day` WHERE lev_empid = '$id' AND lev_type = 'ลากิจ' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result2 = $connect->query($sql2);
while ($row2 = $result2->fetch_assoc()) :
    $userdleave = $row2["amount_userd"];
endwhile;
$sql3 = "SELECT SUM(lev_amount_time) AS time_userd FROM `tbl_leave_day` WHERE lev_empid = '$id' AND lev_type = 'ลากิจ' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result3 = $connect->query($sql3);
while ($row3 = $result3->fetch_assoc()) :
    $timeleave = $row3["time_userd"];
endwhile;

while ($timeleave >= 8) {
    $userdleave = $userdleave + 1;
    $timeleave = $timeleave - 8;
}
//สิ้นสุดนับจำนวนวันลากิจ
//เริ่มคำนวนวันลากิจคงเหลือ
$remaindayleave = 0;
$alltimeleave = ($leave * 8) + $tleave;
$userdhourleave = ($userdleave * 8) + $timeleave;

$remainallleave = $alltimeleave - $userdhourleave;
while ($remainallleave >= 8) {
    $remaindayleave++;
    $remainallleave = $remainallleave - 8;
}
//สิ้นสุดคำนวนวันลากิจคงเหลือ

//เริ่มนับจำนวนวันลาป่วย

$sql4 = "SELECT SUM(lev_amount_day) AS amount_userd FROM `tbl_leave_day` WHERE lev_empid = '$id' AND lev_type = 'ลาป่วย' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result4 = $connect->query($sql4);
while ($row4 = $result4->fetch_assoc()) :
    $userdsick = $row4["amount_userd"];
endwhile;
$sql5 = "SELECT SUM(lev_amount_time) AS time_userd FROM `tbl_leave_day` WHERE lev_empid = '$id' AND lev_type = 'ลาป่วย' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result5 = $connect->query($sql5);
while ($row5 = $result5->fetch_assoc()) :
    $timesick = $row5["time_userd"];
endwhile;

while ($timesick >= 8) {
    $userdsick = $userdsick + 1;
    $timesick = $timesick - 8;
}
//สิ้นสุดนับจำนวนวันลาป่วย
//เริ่มคำนวนวันลาป่วยคงเหลือ
$remaindaysick = 0;
$alltimesick = ($sick * 8) + $tsick;
$userdhoursick = ($userdsick * 8) + $timesick;

$remainallsick = $alltimesick - $userdhoursick;
while ($remainallsick >= 8) {
    $remaindaysick++;
    $remainallsick = $remainallsick - 8;
}
//สิ้นสุดคำนวนวันลาป่วยคงเหลือ

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
    <script>
        function EnableDisableTextBoxNext(opt) {

            if (opt == "hour") {
                document.getElementById("addmoreDetailsOnSelection1").disabled = false;
                document.getElementById("addmoreDetailsOnSelection2").disabled = false;
                document.getElementById("addmoreDetailsOnSelection3").disabled = true;
                document.getElementById("addmoreDetailsOnSelection4").disabled = false;
            } else if (opt == "fhalf" || opt == "shalf") {
                document.getElementById("addmoreDetailsOnSelection1").disabled = false;
                document.getElementById("addmoreDetailsOnSelection2").disabled = true;
                document.getElementById("addmoreDetailsOnSelection3").disabled = true;
                document.getElementById("addmoreDetailsOnSelection4").disabled = true;

            } else if (opt == 'full') {
                document.getElementById("addmoreDetailsOnSelection1").disabled = false;
                document.getElementById("addmoreDetailsOnSelection2").disabled = true;
                document.getElementById("addmoreDetailsOnSelection3").disabled = false;
                document.getElementById("addmoreDetailsOnSelection4").disabled = true;
            } else {
                document.getElementById("addmoreDetailsOnSelection1").disabled = true;
                document.getElementById("addmoreDetailsOnSelection2").disabled = true;
                document.getElementById("addmoreDetailsOnSelection3").disabled = true;
                document.getElementById("addmoreDetailsOnSelection4").disabled = true;
            }
        }
    </script>

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
                                        <h6 class="text-primary m-0 fw-bold">จำนวนวันลาพักร้อน</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col"><label class="col-form-label">ทั้งหมด
                                                    :&nbsp;<?php echo $annaul . 'วัน' ?><?php echo $tannaul . 'ชั่วโมง' ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><label class="col-form-label">ใช้แล้ว&nbsp;
                                                    :&nbsp;<?php echo $userdannaul . 'วัน' . $timeannaul . 'ชั่วโมง' ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><label class="col-form-label">คงเหลือ&nbsp;:&nbsp;<?php echo $remainday . 'วัน' . $remainall . 'ชั่วโมง' ?></label>
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
                                            <div class="col"><label class="col-form-label">ทั้งหมด
                                                    :&nbsp;<?php echo $leave . 'วัน' ?><?php echo $tleave . 'ชั่วโมง' ?><br></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><label class="col-form-label">ใช้แล้ว&nbsp; :
                                                    &nbsp;<?php echo $userdleave . 'วัน' . $timeleave . 'ชั่วโมง' ?><br></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><label class="col-form-label">คงเหลือ&nbsp;:&nbsp;<?php echo $remaindayleave . 'วัน' . $remainallleave . 'ชั่วโมง' ?><br></label>
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
                                            <div class="col"><label class="col-form-label">ทั้งหมด
                                                    :&nbsp;<?php echo $sick . 'วัน' ?><?php echo $tsick . 'ชั่วโมง' ?><br></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><label class="col-form-label">ใช้แล้ว&nbsp;
                                                    :&nbsp;<?php echo $userdsick . 'วัน' . $timesick . 'ชั่วโมง' ?><br></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><label class="col-form-label">คงเหลือ&nbsp;:&nbsp;<?php echo $remaindaysick . 'วัน' . $remainallsick . 'ชั่วโมง' ?><br></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary m-0 fw-bold">แบบยื่นขอลา</h6>
                        </div>
                        <div class="card-body">
                            <form action="add-leave-request.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col"><label class="form-label">ประเภทการลา</label><select class="form-select" name="type">
                                            <option value="">เลือกประเภทลา</option>
                                            <option value="ลาพักร้อน">ลาพักร้อน</option>
                                            <option value="ลากิจ">ลากิจ</option>
                                            <option value="ลาป่วย">ลาป่วย</option>
                                            <option value="ลาพิเศษ">ลาพิเศษ</option>
                                        </select></div>
                                    <div class="col"><label class="form-label">รูปแบบการลา</label><br>

                                        <label class="radio-inline"><input type="radio" name="ty" id="chk1" onchange="EnableDisableTextBoxNext('full')" value="Full Day">
                                            เต็มวัน</label><br>
                                        <label class="radio-inline"><input type="radio" name="ty" id="chk2" onchange="EnableDisableTextBoxNext('fhalf')" value="First Half">
                                            ครึ่งวันเช้า </label><br>
                                        <label class="radio-inline"><input type="radio" name="ty" id="chk3" onchange="EnableDisableTextBoxNext('shalf')" value="Second Half">
                                            ครึ่งวันบ่าย </label><br>
                                        <label class="radio-inline"><input type="radio" name="ty" id="chk4" onchange="EnableDisableTextBoxNext('hour')" value="Hour">
                                            ชั่วโมง</label><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="form-label">เริ่มวันที่</label><input class="form-control" type="date" id="addmoreDetailsOnSelection1" disabled="disabled" required name="sdate">
                                        <label class="form-label">เวลา</label><input class="form-control" type="time" id="addmoreDetailsOnSelection2" disabled="disabled" required name="stime">
                                    </div>
                                    <div class="col"><label class="form-label">สิ้นสุดวันที่</label><input class="form-control" type="date" id="addmoreDetailsOnSelection3" disabled="disabled" required name="edate">
                                        <label class="form-label">เวลา</label><input class="form-control" type="time" id="addmoreDetailsOnSelection4" disabled="disabled" required name="etime">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><label class="form-label">วัตถุประสงค์ในการลา</label><textarea class="form-control" name="body"></textarea></div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="file" class="form-label">แนบไฟล์หลักฐาน</label>
                                        <input type="file" class="form-control" name="fileupload" id="fileupload">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <label for="note" class="form-label">
                                            <b> **หมายเหตุ**
                                                ในกรณีที่การลามีวันเสาร์ - วันอาทิตย์คั่นกลางให้ยื่นลาถึงวันศุกร์ 1
                                                ครั้ง
                                                และ ยื่นลาวันจันทร์อีก 1 ครั้ง</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col" style="margin-top: 4px;padding-top: 19px;">
                                        <div class="btn-group" role="group"><button class="btn btn-primary" type="submit">ส่งคำร้อง</button><button class="btn btn-danger" type="reset" style="margin-left: 22px;">ล้างค่า</button></div>
                                    </div>
                                </div>
                            </form>
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