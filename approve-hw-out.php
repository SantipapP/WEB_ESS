<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_REQUEST["id"];

$sql = "UPDATE tbl_hw_out SET hw_out_status='พร้อมรับของ' WHERE hw_out_id='$id'";
$result = mysqli_query($connect, $sql);
if ($result) {
    header('refresh:0; url=hw-manage.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
