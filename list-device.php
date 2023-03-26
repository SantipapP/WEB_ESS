<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

if ($_GET['type'] != '') {
    $sql = "SELECT * FROM tbl_device WHERE dev_type Like '%" . $_GET["type"] . "%'";
    $result = $connect->query($sql);
} elseif ($_GET['company'] != '') {
    $sql = "SELECT * FROM tbl_device WHERE dev_company Like '%" . $_GET["company"] . "%'";
    $result = $connect->query($sql);
} else {
    $sql = "SELECT * FROM tbl_device";
    $result = $connect->query($sql);
}



$sql1 = "SELECT COUNT(*) as amount FROM tbl_device";
$result1 = $connect->query($sql1);
while ($row1 = $result1->fetch_assoc()) :
    $alldevice = $row1["amount"];
endwhile;

$sql1 = "SELECT COUNT(*) as amount FROM tbl_device WHERE dev_status='Active'";
$result1 = $connect->query($sql1);
while ($row1 = $result1->fetch_assoc()) :
    $activedevice = $row1["amount"];
endwhile;

$sql1 = "SELECT COUNT(*) as amount FROM tbl_device WHERE dev_status='Inactive'";
$result1 = $connect->query($sql1);
while ($row1 = $result1->fetch_assoc()) :
    $inactivedevice = $row1["amount"];
endwhile;

$sql1 = "SELECT COUNT(*) as amount FROM tbl_device WHERE dev_status='Cancel'";
$result1 = $connect->query($sql1);
while ($row1 = $result1->fetch_assoc()) :
    $canceldevice = $row1["amount"];
endwhile;

$sql2 = "SELECT * FROM tbl_device WHERE dev_status='Inactive' ORDER BY dev_type ";
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>

<body id="page-top">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ลงทะเบียนอุปกรณ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add-device.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <label for="assetcode">รหัสทรัพย์สิน</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="assetcode" id="assetcode" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="company">บริษัท</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="company" id="company" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="type">ประเภท</label>
                            </div>
                            <div class="col">
                                <label for="brand">แบรนด์</label>
                            </div>
                            <div class="col">
                                <label for="model">รุ่น</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="type" id="type" class="form-control">
                                    <option value="">เลือกประเภท</option>
                                    <option value="คอมพิวเตอร์">
                                        คอมพิวเตอร์</option>
                                    <option value="จอคอมพิวเตอร์">
                                        จอคอมพิวเตอร์</option>
                                    <option value="ทั่วไป">ทั่วไป
                                    </option>
                                    <option value="ปริ้นเตอร์">
                                        ปริ้นเตอร์</option>
                                    <option value="อุปกรณ์เน็ตเวิร์ค">
                                        อุปกรณ์เน็ตเวิร์ค</option>
                                    <option value="โทรศัพท์">โทรศัพท์
                                    </option>
                                    <option value="โน๊ตบุ๊ค">โน๊ตบุ๊ค
                                    </option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" name="brand" id="brand" class="form-control">
                            </div>
                            <div class="col">
                                <input type="text" name="model" id="model" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="sn">Serial Number or Service Tag</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="sn" id="sn" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="pic">รูปภาพ</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="file" name="pic" id="pic" accept=".jpg, .jpeg .png" class="form-control">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Model-->
    <!-- Modal ส่งมอบเครื่อง -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ส่งมอบเครื่อง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add-device.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <label for="device">เลือกเครื่อง</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="device" id="device" class="form-control">
                                    <option value=""></option>
                                    <?php while ($row2 = $result2->fetch_assoc()) : ?>
                                        <option value="">
                                            <?php echo $row2['dev_type']; ?>|<?php echo $row2['dev_assetcode']; ?>|<?php echo $row2['dev_brand']; ?>
                                        </option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Model-->

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
                        <div class="row">
                            <div class="col">
                                <div class="card mb-4" data-aos="fade-up">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card shadow border-start-primary py-2">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                    <span>อุปกรณ์ทั้งหมด</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $alldevice ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card shadow border-start-success py-2">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                                    <span>ใช้งานอยู่</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $activedevice ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card shadow border-start-warning py-2">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div class="text-uppercase text-warning fw-bold text-xs mb-1">
                                                                    <span>เครื่องที่ยังว่างอยู่</span>
                                                                </div>
                                                                <div class="text-dark fw-bold h5 mb-0">
                                                                    <span><?php echo $inactivedevice ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card shadow border-start-info py-2">
                                                    <div class="card-body">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                                <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                                                    <span style="color: rgb(204,63,54);">เครื่องเสีย</span>
                                                                </div>
                                                                <div class="row g-0 align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="text-dark fw-bold h5 mb-0 me-3">
                                                                            <span><?php echo $canceldevice ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container">
                    <div class="row">
                        <div class="col" data-aos="fade-up" data-aos-delay="100" style="padding-top: 0px;padding-left: 0px;padding-right: 0px;margin-top: -49px;">
                            <section class="mt-4">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col" style="padding-left: 0px;padding-right: 0px;">
                                            <section class="mt-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card shadow">
                                                                <div class="card-header py-2">
                                                                    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="get">
                                                                        <div class="row">
                                                                            <div class="col"><select class="form-select" name="company">
                                                                                    <option value="">
                                                                                        เลือกบริษัท</option>
                                                                                    <option value="อีเอสพาวเวอร์คอร์ปอเรชั่นจำกัด">
                                                                                        ESPOWER
                                                                                    </option>
                                                                                    <option value="อีเอสพีเทคโนโลยี่จำกัด">
                                                                                        ESP</option>
                                                                                </select></div>
                                                                            <div class="col"><select class="form-select" name="type">
                                                                                    <option value="" selected="">
                                                                                        ค้นหาประเภท</option>
                                                                                    <option value="คอมพิวเตอร์">
                                                                                        คอมพิวเตอร์</option>
                                                                                    <option value="จอคอมพิวเตอร์">
                                                                                        จอคอมพิวเตอร์</option>
                                                                                    <option value="ทั่วไป">ทั่วไป
                                                                                    </option>
                                                                                    <option value="ปริ้นเตอร์">
                                                                                        ปริ้นเตอร์</option>
                                                                                    <option value="อุปกรณ์เน็ตเวิร์ค">
                                                                                        อุปกรณ์เน็ตเวิร์ค</option>
                                                                                    <option value="โทรศัพท์">โทรศัพท์
                                                                                    </option>
                                                                                    <option value="โน๊ตบุ๊ค">โน๊ตบุ๊ค
                                                                                    </option>
                                                                                </select></div>
                                                                            <div class="col"><button class="btn btn-primary" type="submit">ค้นหา</button></div>
                                                                            <div class="col"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
                                                                                    เพิ่มอุปกรณ์
                                                                                </button></div>
                                                                            <div class="col"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"><i class="fas fa-plus"></i>
                                                                                    ส่งมอบอุปกรณ์
                                                                                </button></div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive table mb-0 pt-3 pe-2">
                                                                        <table class="table table-striped table-sm my-0 mydatatable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>รหัสทรัพสิน</th>
                                                                                    <th>ประเภท</th>
                                                                                    <th>แบรนด์</th>
                                                                                    <th>รุ่น</th>
                                                                                    <th>สถานะ</th>
                                                                                    <th>การกระทำ</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php while ($row = $result->fetch_assoc()) : ?>
                                                                                    <tr>
                                                                                        <td><?php echo $row['dev_assetcode']; ?>
                                                                                        </td>
                                                                                        <td><?php echo $row['dev_type']; ?>
                                                                                        </td>
                                                                                        <td><?php echo $row['dev_brand']; ?>
                                                                                        </td>
                                                                                        <td><?php echo $row['dev_model']; ?>
                                                                                        </td>
                                                                                        <td><?php echo $row['dev_status']; ?>
                                                                                        </td>
                                                                                        <td><a href="device-details.php?id=<?php echo $row['dev_id']; ?>" class="btn btn-success btn-circle ms-1" role="button"><i class="far fa-list-alt text-white"></i></a><a href="frm-send-device.php?id=<?php echo $row['dev_id']; ?>" class="btn btn-warning btn-circle ms-1" role="button"><i class="fas fa-upload text-white"></i></a><a class="btn btn-danger btn-circle ms-1" role="button"><i class="fas fa-trash text-white"></i></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php endwhile ?>
                                                                                <tr></tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </section>
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