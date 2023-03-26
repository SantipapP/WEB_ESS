<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_REQUEST['id'];

$sql = "DELETE FROM tbl_department WHERE de_id='$id'";
$result = mysqli_query($connect, $sql);

if ($result) {
    header('refresh:0; url=list-department.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
