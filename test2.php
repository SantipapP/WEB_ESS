<?php
//เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
require_once 'connect-pdo.php';
//คิวรี่ข้อมูลหาผมรวมยอดขายโดยใช้ SQL SUM
$stmt = $conn->prepare("
SELECT lev_departmentid,de_name,COUNT(lev_departmentid) as amount,SUM(lev_amount_day*8) as amoutday,SUM(lev_amount_time) as amounttime,SUM((lev_amount_day*8)+lev_amount_time) as total FROM tbl_leave_day INNER JOIN tbl_department ON tbl_leave_day.lev_departmentid = tbl_department.de_id WHERE lev_approve != '' and lev_approve != 'ไม่อนุมัติ' GROUP BY lev_departmentid;");
$stmt->execute();
$result = $stmt->fetchAll();

//นำข้อมูลที่ได้จากคิวรี่มากำหนดรูปแบบข้อมุลให้ถูกโครงสร้างของกราฟที่ใช้ 
$datesave = array();
$total = array();
foreach ($result as $rs) {
    $datesave[] = "\"" . $rs['de_name'] . "\"";
    $total[] = "\"" . $rs['total'] . "\"";
}
//ตัด commar อันสุดท้ายโดยใช้ implode เพื่อให้โครงสร้างข้อมูลถูกต้องก่อนจะนำไปแสดงบนกราฟ
$datesave = implode(",", $datesave);
$total = implode(",", $total);

?>
<html>

<head>
    <title>PHP PDO & BAR CHART : ออกรายงานกราฟแท่ง devbanban.com 2021</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- call js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <!--<h4>PHP PDO & BAR CHART : ออกรายงานในรูปแบบกราฟแท่ง</h4>-->
                <!--devbanban.com-->
                <canvas id="myChart" width="800px" height="300px"></canvas>
                <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?php echo $datesave; ?>

                            ],
                            datasets: [{
                                label: 'รายงานจำนวนชั่วโมงการลา แยกตามปี (ชั่วโมง)',
                                data: [<?php echo $total; ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>