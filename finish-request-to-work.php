<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];
$sql = "UPDATE tbl_request_to_work SET rtw_status='เสร็จสิ้น' WHERE rtw_id='$id'";
$result = $connect->query($sql);


if ($result) {
    header('refresh:0; url=list-request-to-work.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
