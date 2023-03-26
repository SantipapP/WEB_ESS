<?php
include('connect.php');
//session_start();
if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
} else {
    $id = $_SESSION['id'];
}

$sql = "SELECT * FROM tbl_emp WHERE emp_id='$id' ";
$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) :
    $level = $row["emp_level"];
endwhile;
if ($level == 'R') {
    header('refresh:0; url=logout.php');
    echo "<script>alert('บัญชีนี้ถูกระงับกรุณาติดต่อผู้ดูแล');</script>";
}
