<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$numrand = (mt_rand());
$id = $_POST['ecid'] . '-' . date("ymd");
$ecname = $_POST['ecname'];
$ecaddress = $_POST['ecaddress'];
$ectel = $_POST['ectel'];


//เพิ่มไฟล์
$upload = $_FILES['eclogo'];
if ($upload <> '') {   //not select file
    //โฟลเดอร์ที่จะ upload file เข้าไป 
    $path = "fileupload/extCompany/";

    //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
    $type = strrchr($_FILES['eclogo']['name'], ".");

    //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
    $newname = $numrand . $type;
    $path_copy = $path . $newname;
    $path_link = "fileupload/extCompany/" . $newname;

    //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
    move_uploaded_file($_FILES['eclogo']['tmp_name'], $path_copy);
}
$sql = "INSERT INTO tbl_external_company(ec_id,ec_name,ec_address,ec_tel,ec_logo) VALUES ('$id','$ecname','$ecaddress','$ectel','$newname')";
$result = mysqli_query($connect, $sql);

if ($result) {
    header('refresh:0; url=list-ext-company.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
