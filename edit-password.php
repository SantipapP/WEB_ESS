<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');


//$id = $_REQUEST["id"];
$id = $_SESSION['id'];
$Cupassword = $_SESSION['emp_password'];
$Opassword = $_POST['Opassword'];
$Npassword = $_POST['Npassword'];
$Cpassword = $_POST['Cpassword'];
$ipaddress = getenv('REMOTE_ADDR');
$logdate = date('Y-M-d');
$logdes = 'เปลี่ยนรหัสผ่าน';


if ($Opassword !== $Cupassword) {
    header('refresh:0; url=frm-edit-password.php');
    echo "<script>alert('รหัสผ่านเก่าไม่ถูกต้อง');</script>";
} else if ($Npassword !== $Cpassword) {
    header('refresh:0; url=frm-edit-password.php');
    echo "<script>alert('รหัสผ่านใหม่ไม่ตรงกับช่องยืนยัน');</script>";
} else if ($Npassword == $Cupassword) {
    header('refresh:0; url=frm-edit-password.php');
    echo "<script>alert('รหัสผ่านใหม่ต้องไม่ตรงกับอันเก่า');</script>";
} else {
    $sql = "UPDATE tbl_emp SET emp_password='$Npassword' WHERE emp_id='$id'";
    $result = mysqli_query($connect, $sql);
    if ($result) {

        $sql1 = "INSERT INTO tbl_log (log_date,log_des,log_ip) VALUES ('$logdate','$logdes','$ipaddress')";
        $result1 = mysqli_query($connect, $sql1);
        if ($result1) {
            header('refresh:0; url=logout.php');
            echo "<script>alert('บันทึกสำเร็จ');</script>";
        }
    } else {
        echo mysqli_error($connect);
    }
}
