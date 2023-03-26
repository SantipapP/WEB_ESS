<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$docid = $_POST['id'];
$company = $_POST['company'];
$date = date('d-m-Y');
$informent = $_POST['informent'];
$extcompany = $_POST['extcompany'];
$job = $_POST['job'];
$location = $_POST['location'];
$sdate = $_POST['sdate'];
$edate = $_POST['edate'];
$time = '08:00 - 17:00';
$amount = $_POST['amount'];
$male = $_POST['male'];
$female = $_POST['female'];
$tool = $_POST['tool'];
$car = 'ประเภทรถ : ' . $_POST['cartype'] . ' ยี่ห้อ : ' . $_POST['carbrand'] . ' ทะเบียน : ' . $_POST['carid'] . ' สีรถ : ' . $_POST['carcolor'];
$status = 'รอเพิ่มผู้เข้างาน';

$sql = "INSERT INTO tbl_request_to_work(rtw_id,rtw_company,rtw_date,rtw_informent,rtw_extcompany,rtw_job,rtw_location,rtw_sdate,rtw_edate,rtw_time,rtw_amount,rtw_male,rtw_female,rtw_tool,rtw_car,rtw_status) VALUES ('$docid','$company','$date','$informent','$extcompany','$job','$location','$sdate','$edate','$time','$amount','$male','$female','$tool','$car','$status')";
$result = mysqli_query($connect, $sql);

if ($result) {
    header('refresh:0; url=list-request-to-work.php');
    echo "<script>alert('บันทึกสำเร็จ');</script>";
} else {
    echo mysqli_error($connect);
}
