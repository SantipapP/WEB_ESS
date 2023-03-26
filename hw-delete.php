<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

    $id = $_REQUEST["id"];

    $sql = "DELETE FROM tbl_hardware WHERE hw_id=$id";
    $result = mysqli_query($connect,$sql); 

    if($result){
        header('refresh:0; url=frm-hardware.php');
        echo "<script>alert('บันทึกสำเร็จ');</script>";
        
    }else{
        echo mysqli_error($connect);
    }
