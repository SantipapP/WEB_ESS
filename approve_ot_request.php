<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');


    $id = $_REQUEST["id"];
    $manager = $_SESSION['emp_name'];
    $department = $_SESSION['emp_department'];
    $position = $_SESSION['emp_position'];

    if($department=='HR&Admin' OR $position=='Manager'){

        $sql = "UPDATE tbl_ot_request SET ot_re_approve='$manager' where ot_re_id=$id";
        $result = mysqli_query($connect,$sql); 

    }
    
    else{
        header('refresh:0; url=list-ot.php');
        echo "<script>alert('บัญชีของคุณไม่มีสิทธิมาใช้ในส่วนนี้');</script>";
    }
 
    if($result){
        header('refresh:0; url=list-ot.php');
        echo "<script>alert('บันทึกสำเร็จ');</script>";
        
    }else{
        echo mysqli_error($connect);
    }
