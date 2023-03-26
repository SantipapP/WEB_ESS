<?
include('connect-pdo.php');

$sql = "SELECT * FROM tbl_hw_out WHERE hw_out_emp = '$emp' ORDER BY hw_out_id DESC";
$result = $connect->query($sql);

$select = mysqli_query("select * from product ORDER BY DESC LIMIT 1") or die(mysql_error());
$pro = mysql_fetch_array($select);
$OrderID = $pro['OrderID']; //สมมุติ 2-1  2 คือเดือน 1 รันตามนัมเบอร์
$explode = explode("-", $OrderID);
if ($explode[0] < date("m")) { // ถ้าเดือนจากฐานข้อมูลน้อยกว่า เดือนปัจจุบัน
    $OrderIDnew = date("m") . "-1";
} else {
    $OrderIDnew = $explode[0] . "-" . $explode[1] + 1; // ถ้าไม่ใช่รันต่อไปเรื่อย	
}
