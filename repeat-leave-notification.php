<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_REQUEST['id'];
$emp = $_SESSION['emp_name'];
$department = $_SESSION['emp_department'];

$sql = "SELECT * FROM tbl_leave_day WHERE id = $id";
$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) :
    //$lid = $row["id"];
    $approver = $row["lev_approve"];
endwhile;

if ($approver == '') {
    define('LINE_API', "https://notify-api.line.me/api/notify");
    $token = ""; //ใส่Token ที่copy เอาไว้
    $str = "แจ้งเตือน !! คำขอลาเลขที่ " . $id . " ของคุณ  " . $emp . "แผนก " . $department . " กำลังรอการอนุมัติ ขอให้ผู้จัดการยืนยันผ่านลิงค์ http://esptechnologies.ddns.net:889/WEB_ESPG/desciption-leave.php?id=" . $id . ""; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร

    $res = notify_message($str, $token);
    print_r($res);

    //https://havespirit.blogspot.com/2017/02/line-notify-php.html
    //https://medium.com/@nattaponsirikamonnet/%E0%B8%A1%E0%B8%B2%E0%B8%A5%E0%B8%AD%E0%B8%87-line-notify-%E0%B8%81%E0%B8%B1%E0%B8%99%E0%B9%80%E0%B8%96%E0%B8%AD%E0%B8%B0-%E0%B8%9E%E0%B8%B7%E0%B9%89%E0%B8%99%E0%B8%90%E0%B8%B2%E0%B8%99-65a7fc83d97f

} else {
    header('refresh:0; url=my-leave.php');
    echo "<script>alert('ไม่สามารถส่งแจ้งเตือนคำขอที่อนุมัติแล้ว หรือ ถูกปฏิเสธแล้ว ได้');</script>";
}

function notify_message($message, $token)
{
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData, '', '&');
    $headerOptions = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                . "Authorization: Bearer " . $token . "\r\n"
                . "Content-Length: " . strlen($queryData) . "\r\n",
            'content' => $queryData
        ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API, FALSE, $context);
    $res = json_decode($result);
    return $res;
}
