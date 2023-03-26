<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$sql = "SELECT * FROM tbl_hardware ORDER BY hw_id DESC limit 10";
$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ลงทะเบียนอุปกรณ์</title>
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
                    <h3 class="text-dark mb-1">ลงทะเบียนอุปกรณ์</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary m-0 fw-bold">รายละเอียดอุปกรณ์</h6>
                                </div>
                                <div class="card-body">
                                    <p class="m-0"></p>
                                    <form action="register-hw.php" method="POST">
                                        <div class="row">
                                            <div class="col"><label class="form-label">รายละเอียด</label><input class="form-control" type="text" name="hw_name" placeholder="ใส่รายละเอียดอุปกรณ์"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col" style="margin-bottom: 19px;"><label class="form-label">สำหรับแผนก</label><select class="form-select" name="hw_department">
                                                    <option value="">เลือกแผนก</option>
                                                    <optgroup label="ESPOWER">
                                                        <option value="Management">Management</option>
                                                        <option value="Sales">Sales</option>
                                                        <option value="Marketing">Marketing</option>
                                                        <option value="Accounting">Accounting</option>
                                                        <option value="Finance">Finance</option>
                                                        <option value="Corporate">Corporate</option>
                                                        <option value="HR&amp;Admin">HR&amp;Admin</option>
                                                        <option value="IT&amp;Facilities">IT&amp;Facilities</option>
                                                        <option value="Technical &amp; Services">Technical &amp;
                                                            Services</option>
                                                    </optgroup>
                                                    <optgroup label="ESP">
                                                        <option value="ISO">ISO</option>
                                                        <option value="Control Component(101)">Control Component(101)
                                                        </option>
                                                        <option value="Switchboard(102)">Switchboard(102)</option>
                                                        <option value="Metal Works(103)">Metal Works(103)</option>
                                                        <option value="QA(104)">QA(104)</option>
                                                        <option value="D&amp;D(105)">D&amp;D(105)</option>
                                                        <option value="Procurement">Procurement</option>
                                                        <option value="Stock">Stock</option>
                                                    </optgroup>
                                                </select></div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">บันทึก</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary m-0 fw-bold">รายการอุปกรณ์<strong>ทั้งหมด</strong><br></h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12 search-table-col" style="padding-top: 0px;margin-top: 0px;">
                                        <span class="counter pull-right"></span>
                                        <div class="table-responsive table table-hover table-bordered results">
                                            <table class="table table-hover table-bordered">
                                                <thead class="bill-header cs">
                                                    <tr>
                                                        <th id="trs-hd-1" class="col-lg-1">ID</th>
                                                        <th id="trs-hd-2" class="col-lg-2">รายละเอียด</th>
                                                        <th id="trs-hd-3" class="col-lg-3">อุปกรณ์แผนก</th>
                                                        <th id="trs-hd-4" class="col-lg-2">วันที่ลงทะเบียน</th>
                                                        <th id="trs-hd-5" class="col-lg-2">ผู้ลงทะเบียน</th>
                                                        <th id="trs-hd-6" class="col-lg-2">การจัดการ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="warning no-result">
                                                        <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No Result
                                                            !!!</td>
                                                    </tr>
                                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                                        <tr>
                                                            <td><?php echo $row['hw_id']; ?></td>
                                                            <td><?php echo $row['hw_name']; ?></td>
                                                            <td><?php echo $row['hw_department']; ?></td>
                                                            <td><?php echo $row['hw_regisdate']; ?></td>
                                                            <td><?php echo $row['hw_regisemp']; ?></td>
                                                            <td><button class="btn btn-success" style="margin-left: 5px;" type="submit" "><i class=" fa fa-check" style="font-size: 15px;"></i></button><a href="JavaScript:if(confirm('ยืนยันลบอุปกรณ์นี้หรือไม่')==true){window.location='hw-delete.php?id=<?php echo $row['hw_id']; ?>';}"><button class="btn btn-danger" style="margin-left: 5px;" type="submit" "><i class=" fa fa-trash" style="font-size: 15px;"></i></button></a></td>
                                                        </tr>
                                                    <?php endwhile ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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