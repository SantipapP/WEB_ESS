<?php

session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_SESSION["id"];
$email = $_POST['email'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$department = $_POST['departmant'];
$position = $_POST['position'];

$sql = "UPDATE tbl_emp SET emp_email='$email',emp_name = '$name',emp_tel='$tel',emp_department='$department',emp_position='$position' WHERE emp_id='$id'";
$result = $connect->query($sql);




if ($result) {
    header('refresh:0; url=main.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
