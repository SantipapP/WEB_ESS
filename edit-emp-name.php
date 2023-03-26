<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_SESSION['id'];
$name = $_POST['fname'] . "   " . $_POST['lname'];
$ipaddress = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$logdate = date('Y-M-d');
$logdes = 'เปลี่ยนรหัสผ่าน';

$sql = "UPDATE tbl_emp SET emp_name='$name' WHERE emp_id='$id'";
$result = mysqli_query($connect, $sql);
if ($result) {

    $sql1 = "INSERT INTO tbl_log (log_date,log_des,log_ip) VALUES ('$logdate','$logdes','$ipaddress')";
    $result1 = mysqli_query($connect, $sql1);
    if ($result1) {
        header("refresh:0; url=profile.php?id=$id");
        echo "<script>alert('บันทึกสำเร็จ');</script>";
    }
} else {
    echo mysqli_error($connect);
}
