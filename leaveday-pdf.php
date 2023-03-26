<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$year = date('Y');
$titleyear = date('Y') + 543;
$id = $_REQUEST['id'];



$sql0 = "SELECT * FROM tbl_emp WHERE emp_id='$id'";
$result0 = $connect->query($sql0);
while ($row0 = $result0->fetch_assoc()) :
    $emp = $row0["emp_name"];
    $position = $row0["emp_position"];
    $department = $row0["emp_department"];
endwhile;

$sql = "SELECT * FROM tbl_leave_day WHERE lev_emp='$emp' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year'";
$result = $connect->query($sql);


//รวมวันลาพักร้อน
$sql1 = "SELECT SUM(lev_amount_day) AS amount_userd FROM `tbl_leave_day` WHERE lev_emp = '$emp' AND lev_type = 'ลาพักร้อน' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result1 = $connect->query($sql1);
while ($row1 = $result1->fetch_assoc()) :
    $userdannaul = $row1["amount_userd"];
endwhile;
$sql2 = "SELECT SUM(lev_amount_time) AS time_userd FROM `tbl_leave_day` WHERE lev_emp = '$emp' AND lev_type = 'ลาพักร้อน' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result2 = $connect->query($sql2);
while ($row2 = $result2->fetch_assoc()) :
    $timeannaul = $row2["time_userd"];
endwhile;

while ($timeannaul >= 8) {
    $userdannaul = $userdannaul + 1;
    $timeannaul = $timeannaul - 8;
}
//จบรวมวันพักร้อน

//รวมวันลากิจ
$sql3 = "SELECT SUM(lev_amount_day) AS amount_userd FROM `tbl_leave_day` WHERE lev_emp = '$emp' AND lev_type = 'ลากิจ' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result3 = $connect->query($sql3);
while ($row3 = $result3->fetch_assoc()) :
    $userdleave = $row3["amount_userd"];
endwhile;
$sql4 = "SELECT SUM(lev_amount_time) AS time_userd FROM `tbl_leave_day` WHERE lev_emp = '$emp' AND lev_type = 'ลากิจ' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result4 = $connect->query($sql4);
while ($row4 = $result4->fetch_assoc()) :
    $timeleave = $row4["time_userd"];
endwhile;

while ($timeleave >= 8) {
    $userdleave = $userdleave + 1;
    $timeleave = $timeleave - 8;
}
//จบรวมวันลากิจ
//รวมวันลาป่วย
$sql5 = "SELECT SUM(lev_amount_day) AS amount_userd FROM `tbl_leave_day` WHERE lev_emp = '$emp' AND lev_type = 'ลาป่วย' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result5 = $connect->query($sql5);
while ($row5 = $result5->fetch_assoc()) :
    $userdsick = $row5["amount_userd"];
endwhile;
$sql6 = "SELECT SUM(lev_amount_time) AS time_userd FROM `tbl_leave_day` WHERE lev_emp = '$emp' AND lev_type = 'ลาป่วย' AND lev_approve !='' AND lev_approve !='ไม่อนุมัติ' AND YEAR(lev_stime)='$year' ";
$result6 = $connect->query($sql6);
while ($row6 = $result6->fetch_assoc()) :
    $timesick = $row6["time_userd"];
endwhile;

while ($timesick >= 8) {
    $userdsick = $userdsick + 1;
    $timesick = $timesick - 8;
}
//จบรวมวันลาป่วย

define('FPDF_FONTPATH', 'font/');
require('fpdf.php');

class PDF extends FPDF
{
    //Override คำสั่ง (เมธอด) Footer
    function Footer()
    {

        //นับจากขอบกระดาษด้านล่างขึ้นมา 10 มม.
        $this->SetY(-10);

        //กำหนดใช้ตัวอักษร Arial ตัวเอียง ขนาด 5
        $this->SetFont('angsa', 'I', 5);

        //พิมพ์วัน-เวลา ตรงมุมขวาล่าง
        $this->Cell(0, 10, 'Time ' . date('d') . '/' . date('m') . '/' . (date('Y') + 543) . ' ' . date('H:i:s'), 0, 0, 'R');
    }
}



$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetMargins(10, 10, 10);
$pdf->AddFont('regula', '', 'THSarabun.php', true);
$pdf->AddFont('bold', '', 'THSarabun Bold.php', true);

$pdf->AddPage();
$pdf->Image('assets/img/logo.png', 10, 15);
$pdf->SetFont('bold', '', 36);
$pdf->Cell(280, 10, iconv('UTF-8', 'TIS-620', 'ใบบันทึกสถิติการลา ปี ' . $titleyear), 0, 1, "C");
$pdf->SetFont('bold', '', 20);
$pdf->Cell(280, 15, iconv('UTF-8', 'TIS-620', 'ชื่อ - นามสกุล  ' . $emp . '  ตำแหน่ง  ' . $position . '  แผนก  ' . $department), 0, 1, "C");
$pdf->Line(10, 35, 290, 35);

$pdf->SetFont('bold', '', 18);
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'วันที่'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(25, 10, iconv('UTF-8', 'TIS-620', 'ประเภท'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(25, 10, iconv('UTF-8', 'TIS-620', 'จำนวนวัน'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(25, 10, iconv('UTF-8', 'TIS-620', 'จำนวนชั่วโมง'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(80, 10, iconv('UTF-8', 'TIS-620', 'วัตถุประสงค์การลา'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'ผู้อนุมัติ'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(45, 10, iconv('UTF-8', 'TIS-620', 'หมายเหตุ'), 1, 1, "C");

while ($row = $result->fetch_assoc()) :

    $pdf->SetFont('bold', '', 9);
    $pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', $row['lev_stime'] . '  -  ' . $row['lev_etime']), 1, 0, "C");
    $pdf->SetFont('bold', '', 12);
    $pdf->Cell(25, 8, iconv('UTF-8', 'TIS-620', $row['lev_type']), 1, 0, "C");
    $pdf->SetFont('bold', '', 12);
    $pdf->Cell(25, 8, iconv('UTF-8', 'TIS-620', $row['lev_amount_day']), 1, 0, "C");
    $pdf->SetFont('bold', '', 12);
    $pdf->Cell(25, 8, iconv('UTF-8', 'TIS-620', $row['lev_amount_time']), 1, 0, "C");
    $pdf->SetFont('bold', '', 12);
    $pdf->Cell(80, 8, iconv('UTF-8', 'TIS-620', $row['lev_objective']), 1, 0, "L");
    $pdf->SetFont('bold', '', 12);
    $pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', $row['lev_approve']), 1, 0, "C");
    $pdf->SetFont('bold', '', 12);
    $pdf->Cell(45, 8, iconv('UTF-8', 'TIS-620', ''), 1, 1, "C");

endwhile;
$pdf->SetFont('bold', '', 18);
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'รวม'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(38, 10, iconv('UTF-8', 'TIS-620', 'วัน'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(37, 10, iconv('UTF-8', 'TIS-620', 'ชั่วโมง'), 1, 1, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'ลาพักร้อน'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(38, 10, iconv('UTF-8', 'TIS-620', $userdannaul), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(37, 10, iconv('UTF-8', 'TIS-620', $timeannaul), 1, 1, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'ลากิจ'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(38, 10, iconv('UTF-8', 'TIS-620', $userdleave), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(37, 10, iconv('UTF-8', 'TIS-620', $timeleave), 1, 1, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'ลาป่วย'), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(38, 10, iconv('UTF-8', 'TIS-620', $userdsick), 1, 0, "C");
$pdf->SetFont('bold', '', 18);
$pdf->Cell(37, 10, iconv('UTF-8', 'TIS-620', $timesick), 1, 1, "C");


$pdf->Line(5, 250, 200, 250);


$pdf->Output();
