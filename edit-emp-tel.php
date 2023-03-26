<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_SESSION['id'];
$tel = $_POST['tel'];
$ipaddress = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$logdate = date('Y-M-d');
$logdes = 'เปลี่ยนเบอร์โทรของพนักงานรหัส : ' . $id;

$sql = "UPDATE tbl_emp SET emp_tel='$tel' WHERE emp_id='$id'";
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
