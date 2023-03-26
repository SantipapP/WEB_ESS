<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

    $department = $_SESSION['emp_department'];
    if($department=='HR&Admin'){
        header('refresh:0; url=main-admin-hr.php');
        echo "<script>alert('อีเมลหรือรหัสผ่านไม่ถูกต้องกรุณาตรวจสอบแล้วเข้าสู่ระบบอีกครั้ง');</script>";
    }
