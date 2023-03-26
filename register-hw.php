<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

    //if($_SESSION["em_level"]!=="A") {
       // header("location: main.php");
     // }
    


    $name = $_POST['hw_name'];
    $department = $_POST['hw_department'];
    $regisdate = date("Y-m-d");
    $regisemp = $_SESSION['emp_name'];
    
      

    
    $sql = "INSERT INTO tbl_hardware(hw_name,hw_department,hw_regisdate,hw_regisemp) VALUES ('$name','$department','$regisdate','$regisemp')";
    $result = mysqli_query($connect,$sql); 
    if($result){
        header('refresh:0; url=frm-hardware.php');
        echo "<script>alert('บันทึกสำเร็จ');</script>";
        
    }else{
        echo mysqli_error($connect);
    }
