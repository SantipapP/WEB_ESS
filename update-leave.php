<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];
$annaul = $_POST['annaul'];
$leave = $_POST['leave'];
$sick = $_POST['sick'];
$tannaul = $_POST['tannaul'];
$tleave = $_POST['tleave'];
$tsick = $_POST['tsick'];

$sql = "UPDATE tbl_emp SET emp_annaul = $annaul, emp_leave=$leave, emp_sick=$sick,emp_annaul_time = $tannaul, emp_leave_time=$tleave, emp_sick_time=$tsick WHERE emp_id='$id'";
$result = mysqli_query($connect, $sql);
if ($result) {
    header('refresh:0; url=list-emp.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
