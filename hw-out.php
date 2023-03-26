<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$sql = "SELECT * FROM tbl_hardware ORDER BY hw_id DESC";
$result = $connect->query($sql);

$sql2 = "SELECT am_hardware,SUM(am_in),SUM(am_out),SUM(am_in-am_out) FROM `tbl_amount` GROUP BY am_hardware";
$result2 = $connect->query($sql2);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>เบิกอุปกรณ์</title>
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
                    <h3 class="text-dark mb-1">รายละเอียดการเบิกอุปกรณ์</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="add-hw-out.php" method="POST">
                                        <div class="row">
                                            <div class="col" style="margin-bottom: 12px;"><label class="form-label">อุปกรณ์</label><select class="form-select" name="hw_name">
                                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                                        <option value="<?php echo $row['hw_name']; ?>">
                                                            <?php echo $row['hw_name']; ?></option>
                                                    <?php endwhile ?>
                                                </select></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><label class="form-label">จำนวน</label><input class="form-control" type="number" name="hw_amount"></div>
                                            <div class="col"><label class="form-label">วันที่ต้องการ</label><input class="form-control" type="date" name="hw_rdate"></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">บันทึก</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 search-table-col" style="margin-left: 60px;margin-right: -423px;padding-right: 494px;padding-top: 0px;margin-top: 22px;">
                <span class="counter pull-right"></span>
                <div class="table-responsive table table-hover table-bordered results">
                    <table class="table table-hover table-bordered">
                        <thead class="bill-header cs">

                            <tr>
                                <th id="trs-hd-2" class="col-lg-1">อุปกรณ์</th>
                                <th id="trs-hd-3" class="col-lg-1">จำนวนคงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row2 = $result2->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $row2['am_hardware']; ?></td>
                                    <td style="margin-right: 1px;"><?php echo $row2['SUM(am_in-am_out)']; ?></td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
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