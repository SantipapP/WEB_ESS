<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

    $title = $_POST['title'];
    $body = $_POST['body'];
    $emp = $_SESSION['emp_name'];
    $date = date("Y-m-d");

    if($title==''){
        echo "<script>alert('กรุณาใส่หัวข้อเรื่อง');</script>"; 
        header('refresh:0; url=frm-borad.php');
    }else{
        $sql = "INSERT INTO tbl_board(boa_title,boa_description,boa_emp,boa_date) VALUES ('$title','$body','$emp','$date')";
        $result = mysqli_query($connect,$sql); 

        if($result){

            header('refresh:0; url=main.php');
            echo "<script>alert('บันทึกสำเร็จ');</script>";
            
            
        }else{
            echo mysqli_error($connect);
        }
    }
