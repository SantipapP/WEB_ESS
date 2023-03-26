<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];
$de = $_POST['de'];
$po = $_POST['po'];

$sql = "UPDATE tbl_emp SET emp_department3='$de',emp_position3='$po' WHERE emp_id='$id'";
$result = $connect->query($sql);




if ($result) {
    header('refresh:0; url=list-emp.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
