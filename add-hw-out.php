<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

    
    


    
    $date = date("Y-m-d");
    $rdate = $_POST['hw_rdate'];
    $name = $_POST['hw_name'];
    $amount = $_POST['hw_amount'];
    $emp = $_SESSION['emp_name'];
    $department = $_SESSION['emp_department'];
    $status = "รอเจ้าหน้าที่ตรวจสอบ";

    $sql = "INSERT INTO tbl_hw_out(hw_out_date,hw_out_rdate,hw_out_name,hw_out_amount,hw_out_emp,hw_out_department,hw_out_status) VALUES ('$date','$rdate','$name','$amount','$emp','$department','$status')";
    $result = mysqli_query($connect,$sql); 

    $sql2 = "INSERT INTO tbl_amount(am_hardware,am_out) VALUES ('$name','$amount')";
    $result2 = mysqli_query($connect,$sql2); 
    if($result){
        //include('hw_line_notify.php');
        header('refresh:0; url=hw-out.php');
        echo "<script>alert('บันทึกสำเร็จ');</script>";
        
    }else{
        echo mysqli_error($connect);
    }
