<?php
      include('connect.php');
      session_start();

      $sql = "SELECT * FROM tbl_ot_request ORDER BY ot_re_date DESC limit 10";
      $result = $connect->query($sql);

header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="myexcel.xlsx"');
header("Content-Type: application/force-download"); 
header("Content-Type: application/octet-stream"); 
header("Content-Type: application/download"); 
header("Content-Transfer-Encoding: binary"); 
header("Content-Length: ".filesize("myexcel.xlsx"));   

@readfile($filename);  



?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table>
  
  <tr>
    <td>วัน/เดือน/ปี</td>
    <td>ชื่อ - นามสกุล</td>
    <td>แผนก</td>
    <td>เวลาเริ่ม</td>
    <td>เวลาเลิก</td>
    <td>จำนวนเวลา</td>
    <td>รายละเอียดงาน</td>
    <td>ผู้อนุมัติ</td>
  </tr>
  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
  	<td><?php echo $row['ot_re_date']; ?></td>
    <td><?php echo $row['ot_re_emp']; ?></td>>
    <td><?php echo $row['ot_re_department']; ?></td>
    <td><?php echo $row['ot_re_start']; ?></td>
    <td><?php echo $row['ot_re_end']; ?></td>
    <td><?php echo $row['ot_re_time']; ?></td>
    <td><?php echo $row['ot_re_desciption']; ?></td>
    <td><?php echo $row['ot_re_approve']; ?></td>
  </tr>
  <?php endwhile ?>
  
</table>
</body>
</html>
