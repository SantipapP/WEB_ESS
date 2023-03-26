<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$sql = "SELECT * FROM tbl_request_to_work";
$result = $connect->query($sql);

$sql1 = "SELECT * FROM tbl_external_company";
$result1 = $connect->query($sql1);

$sql2 = "SELECT * FROM tbl_location";
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
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มใบแจ้งขออนุญาติปฏิบัติงาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add-request-to-work.php" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="id">เลขที่เอกสาร</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="id" id="id" class="form-control" required>
                            </div>
                            <div class="col"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label for="company">ส่วนงานบริษัท</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="company" id="company" class="form-control" required>
                                    <option value="">เลือกบริษัท</option>
                                    <option value="บริษัท อีเอสพาวเวอร์ คอร์ปอเรชั่น จำกัด">บริษัท อีเอสพาวเวอร์
                                        คอร์ปอเรชั่น จำกัด</option>
                                    <option value="บริษัท อีเอสพี เทคโนโลยี่ จำกัด">บริษัท อีเอสพี เทคโนโลยี่ จำกัด
                                    </option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label for="informent">ผู้ติดต่อ</label>
                            </div>
                            <div class="col">
                                <label for="extcompany">ชื่อบริษัท</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="informent" id="informent" class="form-control" required>
                            </div>
                            <div class="col">
                                <select name="extcompany" id="extcompany" class="form-control" required>
                                    <option value="">เลือกบริษัท</option>
                                    <?php while ($row1 = $result1->fetch_assoc()) : ?>
                                        <option value="<?php echo $row1['ec_name']; ?>"><?php echo $row1['ec_name']; ?>
                                        </option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="job">รายละเอียดงาน</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="job" id="job" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="location">สถานที่ปฏิบัติงาน</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="location" id="location" class="form-control" required>
                                    <option value="">เลือกสถานที่</option>
                                    <?php while ($row2 = $result2->fetch_assoc()) : ?>
                                        <option value="<?php echo $row2['lo_name']; ?>"><?php echo $row2['lo_name']; ?>
                                        </option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="sdate">เข้าวันที่</label>
                            </div>
                            <div class="col">
                                <label for="edate">ถึงวันที่</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="date" name="sdate" id="sdate" class="form-control" required>
                            </div>
                            <div class="col">
                                <input type="date" name="edate" id="edate" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="amount">จำนวนผู้ปฏิบัติงาน</label>
                            </div>
                            <div class="col">
                                <label for="male">ชาย</label>
                            </div>
                            <div class="col">
                                <label for="female">หญิง</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="number" name="amount" id="amount" class="form-control" required>
                            </div>
                            <div class="col">
                                <input type="number" name="male" id="male" class="form-control" required>
                            </div>
                            <div class="col">
                                <input type="number" name="female" id="female" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="tool">เครื่องมือที่นำเข้ามาปฏิบัติงาน</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="tool" id="tool" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="car">ข้อมูลรถ</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="cartype" id="cartype" class="form-control" required>
                                    <option value="">เลือกประเภทรถ</option>
                                    <option value="รถเก๋ง">รถเก๋ง</option>
                                    <option value="รถกระบะ">รถกระบะ</option>
                                    <option value="รถตุ้">รถตู้</option>
                                    <option value="รถ SUV">รถ SUV</option>
                                    <option value="รถตู้เล็ก">รถตู้เล็ก</option>
                                    <option value="รถจักรยานยนต์">รถจักรยานยนต์</option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="carbrand" id="carbrand" class="form-control" required>
                                    <option value="">เลือกยี่ห้อรถ</option>
                                    <option value="Isuzu">Isuzu</option>
                                    <option value="Ford">Ford</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Nissan">Nissan</option>
                                    <option value="Mazda">Mazda</option>
                                    <option value="Honda">Honda</option>
                                    <option value="Mitsubishi">Mitsubishi</option>
                                    <option value="Chevrolet">Chevrolet</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" name="carid" id="carid" class="form-control" placeholder="ทะเบียนรถ" required>
                            </div>
                            <div class="col">
                                <input type="text" name="carcolor" id="carcolor" class="form-control" placeholder="สีรถ" required>
                            </div>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save request</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Model-->

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
                <section class="mt-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary m-0 fw-bold">รายการใบแจ้งขออนุญาติเข้าปฏิบัติงาน</h6>
                                    </div>
                                    <div class="card-body" style="padding-top: 0px;">
                                        <section class="mt-4">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card shadow">
                                                            <div class="card-header py-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
                                                                    เพิ่มใบแจ้งขอเข้าปฏิบัติงาน
                                                                </button>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive table mb-0 pt-3 pe-2">
                                                                    <table class="table table-striped table-sm my-0 mydatatable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>เลขที่เอกสาร</th>
                                                                                <th>วันที่</th>
                                                                                <th>บริษัท</th>
                                                                                <th>สถานที่ปฏิบัติงาน</th>
                                                                                <th>ชื่อผู้ขอ</th>
                                                                                <th>สถานะใบแจ้ง</th>
                                                                                <th>การกระทำ</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                                                <tr>
                                                                                    <td><?php echo $row['rtw_id']; ?></td>
                                                                                    <td><?php echo $row['rtw_date']; ?></td>
                                                                                    <td><?php echo $row['rtw_extcompany']; ?>
                                                                                    </td>
                                                                                    <td><?php echo $row['rtw_location']; ?>
                                                                                    </td>
                                                                                    <td><?php echo $row['rtw_informent']; ?>
                                                                                    </td>
                                                                                    <td><?php echo $row['rtw_status']; ?>
                                                                                    </td>
                                                                                    <td><a href="des-request-to-work.php?id=<?php echo $row['rtw_id']; ?>" class="btn btn-success btn-circle ms-1" role="button" title="ดูรายละเอียด"><i class="fab fa-firstdraft text-white"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endwhile; ?>
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