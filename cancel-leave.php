<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_REQUEST['id'];
$emp = $_SESSION['emp_name'];
$department = $_SESSION['emp_department'];

$sql = "SELECT * FROM tbl_leave_day WHERE id = $id";
$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) :
    //$lid = $row["id"];
    $approver = $row["lev_approve"];
endwhile;

if ($approver == '') {
    $sql1 = "DELETE FROM tbl_leave_day WHERE id=$id";
    $result1 = mysqli_query($connect, $sql1);

    if ($result1) {
        header("refresh:0; url=my-leave.php");
        echo "<script>alert('ยกเลิกสำเร็จ');</script>";
    } else {
        echo mysqli_error($connect);
    }
} else {
    header('refresh:0; url=my-leave.php');
    echo "<script>alert('ไม่สามารถยกเลิกคำขอที่อนุมัติแล้ว หรือ ถูกปฏิเสธแล้ว ได้');</script>";
}
