<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_REQUEST['id'];
$level = $_SESSION['emp_level'];
$name = $_SESSION['emp_name'];
$logdate = date('Y-M-d');
$logdes = 'ลบข้อมูลวันลา โดย ' . $name;
$ipaddress = $_SERVER['REMOTE_ADDR'];
if ($level == 'A') {
    $sql = "DELETE FROM tbl_leave_day WHERE id='$id'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $sql1 = "INSERT INTO tbl_log (log_date,log_des,log_ip) VALUES ('$logdate','$logdes','$ipaddress')";
        $result1 = mysqli_query($connect, $sql1);
        if ($result1) {
            header('refresh:0; url=list-leave-day.php');
            echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
        }
    } else {
        echo mysqli_error($connect);
    }
} else {
    header('refresh:0; url=list-leave-day.php');
    echo "<script>alert('บัญชีของคุณไม่สามารถใช้งานในส่วนนี้ได้');</script>";
}
