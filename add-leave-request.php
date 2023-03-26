<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$ty = $_POST['ty'];
$amountdate = '0';
$amounttime = '0';
if ($ty == 'Full Day') {
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $stime = '08:00';
    $etime = '17:00';
    $note2 = $stime . '-' . $etime;
    function DateDiff($strDate1, $strDate2)
    {
        return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);  // 1 day = 60*60*24
    }
    $amountdate = (DateDiff($sdate, $edate)) + 1;
} else if ($ty == 'First Half') {
    $sdate = $_POST['sdate'];
    $edate = $sdate;
    $stime = '08:00';
    $etime = '12:00';
    $note2 = $stime . '-' . $etime;
    function DateDiff($strDate1, $strDate2)
    {
        return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);  // 1 day = 60*60*24
    }
    function TimeDiff($strTime1, $strTime2)
    {
        return (strtotime($strTime2) - strtotime($strTime1)) /  (60 * 60); // 1 Hour =  60*60
    }
    $amountdate = DateDiff($sdate, $edate);
    $amounttime = TimeDiff($stime, $etime);
} else if ($ty == 'Second Half') {
    $sdate = $_POST['sdate'];
    $edate = $sdate;
    $stime = '13:00';
    $etime = '17:00';
    $note2 = $stime . '-' . $etime;
    function DateDiff($strDate1, $strDate2)
    {
        return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);  // 1 day = 60*60*24
    }
    function TimeDiff($strTime1, $strTime2)
    {
        return (strtotime($strTime2) - strtotime($strTime1)) /  (60 * 60); // 1 Hour =  60*60
    }
    $amountdate = DateDiff($sdate, $edate);
    $amounttime = TimeDiff($stime, $etime);
} else {
    $sdate = $_POST['sdate'];
    $edate = $sdate;
    $stime = $_POST['stime'];
    $etime = $_POST['etime'];
    $note2 = $stime . '-' . $etime;
    function DateDiff($strDate1, $strDate2)
    {
        return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);  // 1 day = 60*60*24
    }
    function TimeDiff($strTime1, $strTime2)
    {
        return (strtotime($strTime2) - strtotime($strTime1)) /  (60 * 60); // 1 Hour =  60*60
    }
    $amountdate = DateDiff($sdate, $edate);
    $amounttime = TimeDiff($stime, $etime);
}

/*echo 'รูปแบบการลา' . $ty;
echo "<br/>";
echo 'เริ่มวันที่' . $sdate;
echo 'เวลา' . $stime;
echo "<br/>";
echo 'ถึง';
echo "<br/>";
echo 'วันที่' . $edate;
echo 'เวลา' . $etime;
echo "<br/>";
echo 'จำนวนวัน = ' . $amountdate;
echo "<br/>";
echo 'จำนวนชั่วโมง = ' . $amounttime;
echo "<br/>";*/
$empid = $_SESSION['id'];
$emp = $_SESSION['emp_name'];
$departmentid = $_SESSION['emp_departmentid'];
$department = $_SESSION['emp_department'];
$position = $_SESSION['emp_position'];
$ltype = $_POST['type'];
$begin = $sdate . ' ' . $stime;
$finish = $edate . ' ' . $etime;
$objective = $_POST['body'];

date_default_timezone_set('Asia/Bangkok');
$date = date("Ymd");

$fileupload = $_POST['fileupload'];
$numrand = (mt_rand());
$upload = $_FILES['fileupload'];
echo "Uploadname: " . $fileupload . "<br />";
echo "Upload: " . $_FILES["fileupload"]["name"] . "<br />";
echo "Type: " . $_FILES["fileupload"]["type"] . "<br />";
echo "Size: " . ($_FILES["fileupload"]["size"] / 1024) . " Kb<br />";
echo "Stored in: " . $_FILES["fileupload"]["tmp_name"];
$path = "fileupload/";
$fname =  ($_FILES["fileupload"]["size"] * 1024) . $_FILES["fileupload"]["name"];
$path_copy = $path . $fname;
move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);


if ($emp == '' || $department == '' || $position == '' || $ltype == '' || $begin == '' || $finish == '' || $objective == '') {
    header('refresh:0; url=frm-leave-request.php');
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
} else {
    $sql = "INSERT INTO tbl_leave_day(lev_empid,lev_emp,lev_departmentid,lev_department,lev_position,lev_type,lev_stime,lev_etime,lev_amount_day,lev_amount_time,lev_objective,lev_file,lev_note2) VALUES ('$empid','$emp','$departmentid','$department','$position','$ltype','$begin','$finish',$amountdate,$amounttime,'$objective','$fname','$note2')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        include('leaveday_line_notify.php');
        header('refresh:0; url=frm-leave-request.php');
        echo "<script>alert('บันทึกสำเร็จ');</script>";
    } else {
        echo mysqli_error($connect);
    }
}
