<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$numrand = (mt_rand());
$id = $_POST['doc'];

$sql1 = "SELECT * FROM tbl_request_to_work WHERE rtw_id='$id'";
$result1 = $connect->query($sql1);

while ($row1 = $result1->fetch_assoc()) :
    $docstatus = $row1["rtw_status"];
endwhile;

if ($docstatus == 'เสร็จสิ้น') {
    header("refresh:0; url=des-request-to-work.php?id=$id");
    echo "<script>alert('ไม่สามารถเพิ่มผู้เข้าปฏิบัติงานได้เนื่องจากใบแจ้งนี้เสร็จสิ้นกระบวนการเรียบร้อยแล้ว กรุณาติดต่อเจ้าหน้าที่');</script>";
} else {

    $name = $_POST['tname'] . ' ' . $_POST['fname'] . ' ' . $_POST['lname'];
    $ext = $_POST['ext'];
    $deslocation = $_POST['deslocation'];
    $dessdate = $_POST['dessdate'];
    $desedate = $_POST['desedate'];
    //เพิ่มไฟล์
    $upload = $_FILES['pic'];
    if ($upload <> '') {   //not select file
        //โฟลเดอร์ที่จะ upload file เข้าไป 
        $path = "fileupload/visitor/";

        //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
        $type = strrchr($_FILES['pic']['name'], ".");

        //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
        $newname = $numrand . $type;
        $path_copy = $path . $newname;
        $path_link = "fileupload/visitor/" . $newname;

        //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
        move_uploaded_file($_FILES['pic']['tmp_name'], $path_copy);
    }

    $sql = "INSERT INTO tbl_visitor(vi_doc,vi_name,vi_company,vi_location,vi_sdate,vi_edate,vi_pic) VALUES ('$id','$name','$ext','$deslocation','$dessdate','$desedate','$newname')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        //header("location: des-request-to-work.php?id=$id");
        header("refresh:0; url=des-request-to-work.php?id=$id");
        echo "<script>alert('บันทึกสำเร็จ');</script>";
    } else {
        echo mysqli_error($connect);
    }
}
