<?php
/*if (!isset($_COOKIE['id'])) {
    header('refresh:0; url=logout.php');
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อนใช้งาน');</script>";
} elseif (!isset($_SESSION['id'])) {
    header('refresh:0; url=logout.php');
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อนใช้งาน');</script>";
} else {
    include('set-session.php');
    @ini_set('display_errors', '0');
}*/

if (isset($_COOKIE['id'])) {
    include('set-session.php');
    @ini_set('display_errors', '0');
} elseif (isset($_SESSION['id'])) {
} else {
    header('refresh:0; url=logout.php');
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อนใช้งาน');</script>";
}
