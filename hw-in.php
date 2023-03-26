<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$sql = "SELECT * FROM tbl_hardware ORDER BY hw_id DESC";
$result = $connect->query($sql);

$sql1 = "SELECT * FROM tbl_hw_in ORDER BY hw_in_id DESC";
$result1 = $connect->query($sql1);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>รับเข้าอุปกรณ์</title>
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
                    <h3 class="text-dark mb-1">นำเข้าอุปกรณ์</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary m-0 fw-bold">รายละเอียด</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <form action="add-hw-in.php" method="POST">
                                                <div class="row">

                                                    <div class="col"><label class="form-label">อุปกรณ์</label><select class="form-select" name="hw_name">
                                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                                <option value="<?php echo $row['hw_name']; ?>">
                                                                    <?php echo $row['hw_name']; ?></option>
                                                            <?php endwhile ?>

                                                        </select></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col"><label class="form-label">จำนวน</label><input class="form-control" type="number" name="hw_amount"></div>
                                                    <div class="col"><label class="form-label">อ้างอิง PR</label><input class="form-control" type="text" name="hw_pr"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col"><label class="form-label">ซับพลายเออร์</label><input class="form-control" type="text" name="hw_supplier"></div>
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
                </div>
                <div class="container-fluid">
                    <h3 class="text-dark mb-0">ประวัตินำเข้าอุปกรณ์</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                </div>
                <div class="container">
                    <div class="col-md-12 search-table-col" style="padding-top: 0px;margin-top: 0px;"><span class="counter pull-right"></span>
                        <div class="table-responsive table table-hover table-bordered results">
                            <table class="table table-hover table-bordered">
                                <thead class="bill-header cs">
                                    <tr>
                                        <th id="trs-hd-1" class="col-lg-1">ลำดับ</th>
                                        <th id="trs-hd-2" class="col-lg-2">รายการ</th>
                                        <th id="trs-hd-3" class="col-lg-3">จำนวน</th>
                                        <th id="trs-hd-4" class="col-lg-2">อ้างอิง PR</th>
                                        <th id="trs-hd-5" class="col-lg-2">ซับพลายเออร์</th>
                                        <th id="trs-hd-6" class="col-lg-2">ผู้บันทึก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="warning no-result">
                                        <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No Result !!!</td>
                                    </tr>
                                    <tr>
                                        <?php while ($row1 = $result1->fetch_assoc()) : ?>
                                            <td><?php echo $row1['hw_in_id']; ?></td>
                                            <td><?php echo $row1['hw_in_name']; ?></td>
                                            <td><?php echo $row1['hw_in_amount']; ?></td>
                                            <td><?php echo $row1['hw_in_pr']; ?></td>
                                            <td><?php echo $row1['hw_in_supplier']; ?></td>
                                            <td><?php echo $row1['hw_in_emp']; ?></td>

                                    </tr>
                                <?php endwhile ?>
                                </tbody>
                            </table>
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