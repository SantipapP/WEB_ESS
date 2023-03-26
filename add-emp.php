<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

//if($_SESSION["em_level"]!=="A") {
// header("location: main.php");
// }



$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['fname'] . "   " . $_POST['lname'];
$company = $_POST['company'];
$department = $_POST['department'];
$position = $_POST['position'];
$tel = $_POST['tel'];
$ipaddress = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$logdate = date('Y-M-d');
$logdes = 'เพิ่มพนักงาน : ' . $emp;

if ($position == 'Manager') {
    $level = 'M';
} else {
    $level = 'U';
}



$sql = "INSERT INTO tbl_emp(emp_id,emp_email,emp_name,emp_company,emp_department,emp_position,emp_tel,emp_password,emp_level) VALUES ('$id','$email','$name','$company','$department','$position','$tel','$password','$level')";
$result = mysqli_query($connect, $sql);
if ($result) {
    $sql1 = "INSERT INTO tbl_log (log_date,log_des,log_ip) VALUES ('$logdate','$logdes','$ipaddress')";
    $result1 = mysqli_query($connect, $sql1);
    if ($result1) {
        header("refresh:0; url=list-emp.php");
        echo "<script>alert('บันทึกสำเร็จ');</script>";
    }
} else {
    echo mysqli_error($connect);
}
