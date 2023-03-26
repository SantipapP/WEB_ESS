<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$sql = "SELECT * FROM tbl_hw_out WHERE hw_out_status = 'รอเจ้าหน้าที่ตรวจสอบ' ORDER BY hw_out_id DESC";
$result = $connect->query($sql);

$sql1 = "SELECT * FROM tbl_hw_out WHERE hw_out_status = 'พร้อมรับของ' ORDER BY hw_out_id DESC";
$result1 = $connect->query($sql1);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>การจัดการอุปกรณ์</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search-search-table.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search.css">
</head>

<body id="page-top" class="sidebar-toggled">
    <div id="wrapper">
        <?php include('nav-menu.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <?php include('top-menu.php'); ?>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-1">การจัดการ</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 26px;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col"><a class="btn btn-primary btn-icon-split" role="button" href="frm-hardware.php"><span class="text-white-50 icon"><i class="fas fa-edit"></i></span><span class="text-white text">จัดการอุปกรณ์</span></a></div>
                                        <div class="col"><a class="btn btn-primary btn-icon-split" role="button" href="hw-in.php"><span class="text-white-50 icon"><i class="fas fa-plus-circle"></i></span><span class="text-white text">รายการนำเข้า</span></a></div>
                                        <div class="col"><a class="btn btn-primary btn-icon-split" role="button" href="list-hw-out.php"><span class="text-white-50 icon"><i class="fas fa-minus-circle"></i></span><span class="text-white text">รายการเบิกอุปกรณ์</span></a></div>
                                        <div class="col"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <h3 class="text-dark mb-1">รายการเบิกอุปกรณ์ที่ยังไม่อนุมัติ</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 search-table-col" style="padding-top: 0px;margin-top: 0px;"><span class="counter pull-right"></span>
                            <div class="table-responsive table table-hover table-bordered results">
                                <table class="table table-hover table-bordered">
                                    <thead class="bill-header cs">
                                        <tr>
                                            <th id="trs-hd-1" class="col-lg-1">ลำดับ</th>
                                            <th id="trs-hd-2" class="col-lg-2">รายละเอียด</th>
                                            <th id="trs-hd-3" class="col-lg-1">จำนวน</th>
                                            <th id="trs-hd-4" class="col-lg-2">ผู้เบิก</th>
                                            <th id="trs-hd-5" class="col-lg-2">แผนก</th>
                                            <th id="trs-hd-6" class="col-lg-2">วันที่ต้องการ</th>
                                            <th id="trs-hd-7" class="col-lg-2">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="warning no-result">
                                            <td colspan="12"></td>
                                        </tr>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>

                                                <td><?php echo $row['hw_out_id']; ?></td>
                                                <td><?php echo $row['hw_out_name']; ?></td>
                                                <td><?php echo $row['hw_out_amount']; ?></td>
                                                <td><?php echo $row['hw_out_emp']; ?></td>
                                                <td><?php echo $row['hw_out_department']; ?></td>
                                                <td><?php echo $row['hw_out_rdate']; ?></td>
                                                <td><a href="JavaScript:if(confirm('ยืนยันอนุมัติคำขอเบิกที่ <?php echo $row['hw_out_id']; ?>')==true){window.location='approve-hw-out.php?id=<?php echo $row['hw_out_id']; ?>';}"><button class="btn btn-success" style="margin-left: 5px;" type="submit"><i class="fa fa-check" style="font-size: 15px;"></i></button></a>
                                                    <a href="JavaScript:if(confirm('ยืนยันปฏิเสธคำขอเบิกที่ <?php echo $row['hw_out_id']; ?>')==true){window.location='reject-hw-out.php?id=<?php echo $row['hw_out_id']; ?>';}"><button class="btn btn-danger" style="margin-left: 5px;" type="submit"><i class="fas fa-times" style="font-size: 15px;"></i></button></a>
                                                </td>

                                            </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <h3 class="text-dark mb-1">รายการเบิกอุปกรณ์ที่รอมารับของ</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 search-table-col" style="padding-top: 0px;margin-top: 0px;"><span class="counter pull-right"></span>
                            <div class="table-responsive table table-hover table-bordered results">
                                <table class="table table-hover table-bordered">
                                    <thead class="bill-header cs">
                                        <tr>
                                            <th id="trs-hd-1" class="col-lg-1">ลำดับ</th>
                                            <th id="trs-hd-2" class="col-lg-2">รายละเอียด</th>
                                            <th id="trs-hd-3" class="col-lg-1">จำนวน</th>
                                            <th id="trs-hd-4" class="col-lg-2">ผู้เบิก</th>
                                            <th id="trs-hd-5" class="col-lg-2">แผนก</th>
                                            <th id="trs-hd-6" class="col-lg-2">วันที่ต้องการ</th>
                                            <th id="trs-hd-7" class="col-lg-2">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="warning no-result">
                                            <td colspan="12"></td>
                                        </tr>
                                        <?php while ($row1 = $result1->fetch_assoc()) : ?>
                                            <tr>

                                                <td><?php echo $row1['hw_out_id']; ?></td>
                                                <td><?php echo $row1['hw_out_name']; ?></td>
                                                <td><?php echo $row1['hw_out_amount']; ?></td>
                                                <td><?php echo $row1['hw_out_emp']; ?></td>
                                                <td><?php echo $row1['hw_out_department']; ?></td>
                                                <td><?php echo $row1['hw_out_rdate']; ?></td>
                                                <td><a href="received-hw-out.php?id=<?php echo $row1['hw_out_id']; ?>"><button class="btn btn-success" style="margin-left: 5px;" type="submit"><i class="fa fa-check" style="font-size: 15px;"></i></button></a></td>

                                            </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © ArtLongDev 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>