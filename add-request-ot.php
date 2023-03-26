<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

//if($_SESSION["em_level"]!=="A") {
// header("location: main.php");
// }



$date = $_POST['date'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];
$time = $etime - $stime;
$company = $_SESSION['emp_company'];
$department = $_SESSION['emp_department'];
$desciption = $_POST['desciption'];
$po = $_POST['po'];
$price = $_POST['price'];
$emp = $_SESSION['emp_name'];






$sql = "INSERT INTO tbl_ot_request(ot_re_date,ot_re_start,ot_re_end,ot_re_time,ot_re_company,ot_re_department,ot_re_desciption,ot_re_po,ot_re_price,ot_re_emp) VALUES ('$date','$stime','$etime','$time','$company','$department','$desciption','$po','$price','$emp')";
$result = mysqli_query($connect, $sql);
if ($result) {
    include('ot_line_notify.php');
    header('refresh:5; url=main-hr.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
