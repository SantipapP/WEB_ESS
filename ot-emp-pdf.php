<?php


    $id = $_REQUEST["id"];
    define('FPDF_FONTPATH','font/');
    require('fpdf.php');
    $pdf=new FPDF('L' , 'mm' , 'A4' );
    $pdf->AddFont('regula','','THSarabun.php',true);
    $pdf->AddFont('bold','','THSarabun Bold.php',true);

    
    $pdf->AddPage();
    $pdf->Image('assets/img/logo.png',20,20);
    $pdf->SetFont('bold','',36);
    $pdf->Cell(280,35,iconv( 'UTF-8','TIS-620','รายละเอียดการทำงานล่วงเวลา'),0,1,"C");
    $pdf->Line(5,40,290,40);
    
    $link = mysqli_connect("localhost","root","admin@1234");
    $sql = "use espg_db";
    $result = mysqli_query($link,$sql);
    $sql = "select * from tbl_ot_request WHERE ot_re_emp LIKE '$id%' ORDER BY ot_re_date DESC";
    $result = mysqli_query($link,$sql);
    $line = 25;

        $pdf->SetFont('bold','',18);
        $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','วันที่'),0,0,"C");
        
        $pdf->SetFont('bold','',18);
        $pdf->Cell(50,10,iconv( 'UTF-8','TIS-620','ชื่อ - นามสกุล'),0,0,"C");
        
        $pdf->SetFont('bold','',18);
        $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','แผนก'),0,0,"C");
        
        $pdf->SetFont('bold','',18);
        $pdf->Cell(25,10,iconv( 'UTF-8','TIS-620','เวลาเริ่ม'),0,0,"C");
        
        $pdf->SetFont('bold','',18);
        $pdf->Cell(25,10,iconv( 'UTF-8','TIS-620','เวลาเลิก'),0,0,"C");

        $pdf->SetFont('bold','',18);
        $pdf->Cell(25,10,iconv( 'UTF-8','TIS-620','จำนวนเวลา'),0,0,"C");
        
        $pdf->SetFont('bold','',18);
        $pdf->Cell(47,10,iconv( 'UTF-8','TIS-620','รายละเอียดงาน'),0,0,"C");

        $pdf->SetFont('bold','',18);
        $pdf->Cell(40,10,iconv( 'UTF-8','TIS-620','ผู้อนุมัติ'),0,1,"C");

        

        //$pdf->Line(5,60,290,60);

    while($dbarr=mysqli_fetch_array($result))
    {
        
        
        $pdf->SetFont('regula','',18);
        $pdf->Cell(30,15,iconv( 'UTF-8','TIS-620',$dbarr['ot_re_date']),1,0,"L");
        $pdf->SetFont('regula','',18);
        $pdf->Cell(45,15,iconv( 'UTF-8','TIS-620',$dbarr['ot_re_emp']),1,0,"L");
        $pdf->SetFont('regula','',18);
        $pdf->Cell(35,15,iconv( 'UTF-8','TIS-620',$dbarr['ot_re_department']),1,0,"L");
        $pdf->SetFont('regula','',18);
        $pdf->Cell(27,15,iconv( 'UTF-8','TIS-620',$dbarr['ot_re_start']),1,0,"L");
        $pdf->SetFont('regula','',18);
        $pdf->Cell(23,15,iconv( 'UTF-8','TIS-620',$dbarr['ot_re_end']),1,0,"L");
        $pdf->SetFont('regula','',18);
        $pdf->Cell(23,15,iconv( 'UTF-8','TIS-620',$dbarr['ot_re_time']),1,0,"L");
        $pdf->SetFont('regula','',10);
        $pdf->Cell(50,15,iconv( 'UTF-8','TIS-620',$dbarr['ot_re_desciption']),1,0,"L");
        $pdf->SetFont('regula','',18);
        $pdf->Cell(40,15,iconv( 'UTF-8','TIS-620',$dbarr['ot_re_approve']),1,1,"L");
        
        
        $line=$line+5;
    }

    $pdf->SetFont('bold','',18);
    $pdf->cell(250,10,iconv( 'UTF-8','TIS-620','ผู้อนุมัติ'),0,1,"R");
    $pdf->SetFont('bold','',18);
    $pdf->cell(265,10,iconv( 'UTF-8','TIS-620','........................................'),0,1,"R");
    $pdf->SetFont('bold','',18);
    $pdf->cell(266,10,iconv( 'UTF-8','TIS-620','(.......................................)'),0,1,"R");
    
    

    mysqli_close($link);
    $pdf->Line(5,250,200,250);
    $pdf->Output();
?>