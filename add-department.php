<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$emp = $_SESSION['emp_name'];
$company = $_POST['company'];
$id = $_POST['deid'];
$name = $_POST['name'];
$ipaddress = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$logdate = date('Y-M-d');
$logdes = 'เพิ่มแผนกโดย : ' . $emp;

$sql = "INSERT INTO tbl_department(de_id,de_company,de_name) VALUES ('$id','$company','$name')";
$result = mysqli_query($connect, $sql);

if ($result) {
    $sql1 = "INSERT INTO tbl_log (log_date,log_des,log_ip) VALUES ('$logdate','$logdes','$ipaddress')";
    $result1 = mysqli_query($connect, $sql1);
    if ($result1) {
        header("refresh:0; url=list-department.php");
        echo "<script>alert('บันทึกสำเร็จ');</script>";
    }
} else {
    echo mysqli_error($connect);
}
