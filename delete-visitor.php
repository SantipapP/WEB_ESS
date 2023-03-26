<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];
$docrtw = $_SESSION['docrtw'];
$sql = "DELETE FROM tbl_visitor WHERE id=$id";
$result = mysqli_query($connect, $sql);

if ($result) {
    header("refresh:0; url=des-request-to-work.php?id=$docrtw");
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
