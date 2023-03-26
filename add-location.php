<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_POST['lid'];
$lname = $_POST['lname'];
$intendant = $_POST['lintendant'];

$sql = "INSERT INTO tbl_location(lo_id,lo_name,lo_intendant) VALUES ('$id','$lname','$intendant')";
$result = mysqli_query($connect, $sql);

if ($result) {
    header('refresh:0; url=list-location.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
