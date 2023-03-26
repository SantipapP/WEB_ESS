<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];
$level = $_SESSION['emp_level'];
if ($level == 'A' or $level == 'M') {
    $approver = $_SESSION['emp_name'];

    $sql = "UPDATE tbl_leave_day SET lev_approve='ไม่อนุมัติ' , lev_note='ไม่อนุมัติโดย $approver' where id=$id";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header('refresh:0; url=list-leave-day.php');
        echo "<script>alert('บันทึกสำเร็จ');</script>";
    } else {
        echo mysqli_error($connect);
    }
} else {
    header('refresh:0; url=list-leave-day.php');
    echo "<script>alert('บัญชีของคุณไม่มีสิทธิมาใช้ในส่วนนี้');</script>";
}
