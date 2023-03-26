<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];

$sql1 = "SELECT * FROM tbl_device WHERE dev_id = $id";
$result1 = $connect->query($sql1);
while ($row1 = $result1->fetch_assoc()) :
    $status = $row1["dev_status"];
endwhile;
if ($status == 'Active') {
    header('refresh:0; url=list-device.php');
    echo "<script>alert('กรุณาเลือกเครื่องที่ยังว่างอยู่เพื่อส่งมอบ');</script>";
} else {
    $sql = "SELECT * FROM(tbl_device LEFT JOIN tbl_emp ON tbl_emp.emp_id = tbl_device.dev_user )LEFT JOIN tbl_department ON tbl_department.de_id = tbl_device.dev_department WHERE dev_id = $id ";
    $result = $connect->query($sql);
}
$sql2 = "SELECT * FROM tbl_emp LEFT JOIN tbl_department ON tbl_emp.emp_department = tbl_department.de_id WHERE tbl_department.de_id !='000' ORDER BY tbl_department.de_id DESC";
$result2 = $connect->query($sql2);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blank Page - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search-search-table.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search.css">

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-select/dist/css/bootstrap-select.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="bootstrap-select/dist/js/bootstrap-select.js"></script>-->

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('nav-menu.php') ?>
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

                <section class="mt-4">

                    <div class="container-fluid">
                        <a href="javascript:window.history.back(-1);"><button class="btn btn-primary">
                                ย้อนกลับ</button></a>

                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary m-0 fw-bold">รายละเอียดอุปกรณ์</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php while ($row = $result->fetch_assoc()) :
                                            ?>
                                                <form action="send-device.php?id=<?php echo $row['dev_id'];
                                                                                    ?>" method="post">

                                                    <div class="row">
                                                        <div class="col"><b><label class="col-form-label">สถานะอุปกรณ์
                                                                    :</b>&nbsp;<?php echo $row['dev_status'];
                                                                                ?></label></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <center><img src="fileupload\device\<?php echo $row['dev_pic']; ?>" alt="" width="300" height="300"></center>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col"><b><label class="col-form-label">บริษัท</label></b>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col"><label class="col-form-label"><?php echo $row['dev_company']; ?></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col"><b><label class="col-form-label">รหัสทรัพย์สิน</label></b>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col"><label class="col-form-label"><?php echo $row['dev_assetcode']; ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row">
                                                        <div class="col"><b><label class="col-form-label">ประเภท</label></b>
                                                        </div>

                                                        <div class="col"><b><label class="col-form-label">แบรนด์</label></b>
                                                        </div>

                                                        <div class="col"><b><label class="col-form-label">รุ่น</label></b>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col"><label class="col-form-label"><?php echo $row['dev_type']; ?></label>
                                                        </div>
                                                        <div class="col"><label class="col-form-label"><?php echo $row['dev_brand']; ?></label>
                                                        </div>
                                                        <div class="col"><label class="col-form-label"><?php echo $row['dev_model']; ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col"><b><label class="col-form-label">Serial Number
                                                                    /
                                                                    Service
                                                                    Tag</label></b></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col"><label class="col-form-label"><?php echo $row['dev_sn']; ?></label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col"><b><label class="col-form-label">ชื่อผู้ใช้</label></b>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <select id="select-testing" class="form-control" data-live-search="true" title="Please select" name="emp">

                                                                <option value="">เลือกผู้ใช้งาน</option>
                                                                <?php while ($row2 = $result2->fetch_assoc()) : ?>
                                                                    <option value="<?php echo $row2['emp_id']; ?>">
                                                                        <?php echo $row2['emp_id']; ?> |
                                                                        <?php echo $row2['de_name']; ?> |
                                                                        <?php echo $row2['emp_name']; ?>
                                                                    </option>
                                                                <?php endwhile
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <button type="submit" class="btn btn-primary">ส่งมอบ</button>
                                                        </div>
                                                    </div>
                                                <?php endwhile
                                                ?>
                                                </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © ArtLongDev 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="assets/js/DataTable---Fully-BSS-Editable.js"></script>
    <script src="assets/js/Dynamically-Add-Remove-Table-Row.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>