<?php
session_start();
include('connect.php');


$id = $_POST['id'];
$password = $_POST['password'];
$log = $_POST['log'];


//
$sql = "SELECT * FROM `tbl_emp` INNER JOIN tbl_department on tbl_emp.emp_department = tbl_department.de_id WHERE emp_id = '$id'";
$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) :
    $de = $row["de_name"];

endwhile;

$sql = "SELECT * FROM `tbl_emp` INNER JOIN tbl_department on tbl_emp.emp_department2 = tbl_department.de_id WHERE emp_id = '$id'";
$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) :
    $de2 = $row["de_name"];

endwhile;

$sql = "SELECT * FROM `tbl_emp` INNER JOIN tbl_department on tbl_emp.emp_department3 = tbl_department.de_id WHERE emp_id = '$id'";
$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) :
    $de3 = $row["de_name"];

endwhile;



//

$sql = "SELECT * FROM tbl_emp WHERE emp_id = '$id' and emp_password = '$password'";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);

    $_SESSION["id"] = $row["emp_id"];
    $_SESSION["emp_email"] = $row["emp_email"];
    $_SESSION["emp_password"] = $row["emp_password"];
    $_SESSION["emp_name"] = $row["emp_name"];
    $_SESSION["emp_company"] = $row["emp_company"];
    $_SESSION["emp_departmentid"] = $row["emp_department"];
    $_SESSION["emp_department"] = $de;
    $_SESSION["emp_position"] = $row["emp_position"];
    $_SESSION["emp_departmentid2"] = $row["emp_department2"];
    $_SESSION["emp_department2"] = $de2;
    $_SESSION["emp_position2"] = $row["emp_position2"];
    $_SESSION["emp_departmentid3"] = $row["emp_department3"];
    $_SESSION["emp_department3"] = $de3;
    $_SESSION["emp_position3"] = $row["emp_position3"];
    $_SESSION["emp_tel"] = $row["emp_tel"];
    $_SESSION["emp_level"] = $row["emp_level"];
    $_SESSION["emp_annaul"] = $row["emp_annaul"];
    $_SESSION["emp_leave"] = $row["emp_leave"];
    $_SESSION["emp_sick"] = $row["emp_sick"];

    if ($log == 'savelog') {
        include('set-cookie.php');
    }

    if ($_SESSION["emp_level"] == 'A' || $_SESSION["emp_level"] == 'M') {
        header("location: notify-admin.php");
    } elseif ($_SESSION["emp_level"] == 'U') {
        header("location: main.php");
    } else {
        header('refresh:0; url=index.php');
        echo "<script>alert('บัญชีนี้ถูกระงับการใช้งานกรุณาติดต่อผู้ดูแล');</script>";
    }
} else {
    header('refresh:0; url=index.php');
    echo "<script>alert('อีเมลหรือรหัสผ่านไม่ถูกต้องกรุณาตรวจสอบแล้วเข้าสู่ระบบอีกครั้ง');</script>";
    exit;
}
