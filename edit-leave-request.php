<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];
$ty = $_POST['ty'];
$amountdate = '0';
$amounttime = '0';
if ($ty == 'Full Day') {
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $stime = '08:00';
    $etime = '17:00';
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
$emp = $_SESSION['emp_name'];
$department = $_SESSION['emp_department'];
$position = $_SESSION['emp_position'];
$type = $_POST['type'];
$begin = $sdate . ' ' . $stime;
$finish = $edate . ' ' . $etime;
$objective = $_POST['body'];

if ($emp == '' || $department == '' || $position == '' || $type == '' || $begin == '' || $finish == '' || $objective == '') {
    header('refresh:0; url=frm-leave-request.php');
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
} else {
    $sql = "UPDATE tbl_leave_day SET lev_emp='$emp',lev_department='$department',lev_position='$position',lev_type='$type',lev_stime='$begin',lev_etime='$finish',lev_amount_day='$amountdate',lev_amount_time='$amounttime',lev_objective='$objective' WHERE id='$id'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        include('leaveday_edit_notify.php');
        header('refresh:0; url=my-leave.php');
        echo "<script>alert('บันทึกสำเร็จ');</script>";
    } else {
        echo mysqli_error($connect);
    }
}
