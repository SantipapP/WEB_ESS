<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

    
    


    
    $date = date("Y-m-d");
    $name = $_POST['hw_name'];
    $amount = $_POST['hw_amount'];
    $pr = $_POST['hw_pr'];
    $supplier =$_POST['hw_supplier'];
    $emp = $_SESSION['emp_name'];

    
      

    
    $sql = "INSERT INTO tbl_hw_in(hw_in_date,hw_in_name,hw_in_amount,hw_in_pr,hw_in_supplier,hw_in_emp) VALUES ('$date','$name','$amount','$pr','$supplier','$emp')";
    $result = mysqli_query($connect,$sql); 

    $sql2 = "INSERT INTO tbl_amount(am_hardware,am_in) VALUES ('$name','$amount')";
    $result2 = mysqli_query($connect,$sql2); 

    if($result){

        if($result2){
            header('refresh:0; url=hw-in.php');
            echo "<script>alert('บันทึกสำเร็จ');</script>";
        }
        
        
    }else{
        echo mysqli_error($connect);
    }
