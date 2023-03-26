<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];
$sql = "SELECT * FROM tbl_visitor WHERE id=$id";
$result = $connect->query($sql);

require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8');

$pdf->SetCreator('Mindphp');
$pdf->SetAuthor('Mindphp Developer');
$pdf->SetTitle('Mindphp Example 04');
$pdf->SetSubject('Mindphp Example');
$pdf->SetKeywords('Mindphp, TCPDF, PDF, example, guide');

// กำหนดรูปแบบตัวอักษรให้กับส่วนหัวของเอกสาร 
// freeserif = ชื่อตัวอักษร
// B = กำหนดให้เป็นตัวหนา
// 12 = ขนาดตัวอักษร
$pdf->setHeaderFont(array('freeserif', 'B', 12));

//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Mindphp Example 04', 'การใช้คำสั่ง Cell(), Multicell(), WriteHTML(), writeHTMLCell()', array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

// กำหนดรูปแบบตัวอักษรให้กับเนื้อหา
$pdf->SetFont('freeserif', '', 12);

// การใช้คำสั่ง Cell()
//$pdf->Cell(55, 10, '', 1, 0, 'C', false);
while ($row = $result->fetch_assoc()) :
    //$html = '<img src="fileupload/visitor/' . $row["vi_name"];
    '." width="100">';
    $pdf->SetFont('freeserif', '', 18);
    $pdf->writeHTMLCell(55, 10, '', '', 'Visitor', 'LTR', 0, false, true, 'C');

    $pdf->writeHTMLCell(55, 5, '', '', 'ข้อกำหนดการใช้บัตร', 'LTR', 1, false, true, 'C');
    $pdf->writeHTMLCell(
        55,
        45,
        '',
        '',
        '<img src="fileupload/visitor/' . $row["vi_pic"] . '" width="85" height="120">',
        'LR',
        0,
        false,
        true,
        'C'
    );
    $pdf->SetFont('freeserif', '', 10);
    $pdf->writeHTMLCell(55, 45, '', '', '1.บัตรนี้ใช้ได้เฉพาะผู้ที่มีชื่อในบัตรเท่านั้นและต้องคืนบัตรเมื่อสิ้นสุดวันเข้าพื้นที่<br>2.ต้องปฏิบัติตามกฎความปลอดภัยอย่าง   เคร่งครัด<br>3.ต้องติดบัตรตลอดเวลาขณะปฏิบัติงานในพื้นที่<br>4.กรณีบัตรชำรุดหรือสูญหายต้องแจ้งให้<br>ฝ่ายISOหรือแผนกบุคคลทราบทันทีและ<br>รับผิดชอบค่าใช้จ่ายในการออกบัตรใหม่<br>5.ผู้เก็บบัตรนี้ได้กรุณาส่งคืน โทร.02-581-1124', 'LRB', 1);
    $pdf->SetFont('freeserif', '', 12);
    $pdf->writeHTMLCell(55, 10, '', '', $row['vi_name'], 'LR', 0, false, true, 'C');
    $pdf->writeHTMLCell(55, 10, '', '', 'location : ' . $row["vi_location"], 'LR', 1,);
    $pdf->writeHTMLCell(55, 10, '', '', $row["vi_company"], 'LR', 0, false, true, 'C');
    $pdf->writeHTMLCell(55, 10, '', '', 'วันที่ออกบัตร : ' . $row["vi_sdate"], 'LR', 1);
    $pdf->writeHTMLCell(55, 10, '', '', 'กลุ่มบริษัท อีเอสพี จำกัด', 'LRB', 0, false, true, 'C');
    $pdf->writeHTMLCell(55, 10, '', '', 'วันที่สิ้นสุด : ' . $row["vi_edate"], 'LRB', 1);
endwhile;

//$pdf->writeHTMLCell(55, 10, 10, 50, 'test', 1);

$pdf->Output('mindphp04.pdf', 'I');
