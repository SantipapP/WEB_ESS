<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_REQUEST['id'];

$sql = "UPDATE tbl_emp SET emp_level='R',emp_department='Resign',emp_position='Resign' WHERE emp_id='$id'";
$result = mysqli_query($connect, $sql);
if ($result) {
    header('refresh:0; url=list-emp.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
