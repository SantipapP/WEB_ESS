<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');

$id = $_REQUEST['id'];

$sql = "SELECT * FROM tbl_emp WHERE emp_id='$id'";
$result = $connect->query($sql);

$sql1 = "SELECT * FROM tbl_department ORDER BY de_company DESC";
$result1 = $connect->query($sql1);
$sql2 = "SELECT * FROM tbl_department ORDER BY de_company DESC";
$result2 = $connect->query($sql2);
$sql3 = "SELECT * FROM tbl_department ORDER BY de_company DESC";
$result3 = $connect->query($sql3);
//---------------------------------------------------------------------------------------------------------
$sql4 = "SELECT * FROM `tbl_emp` INNER JOIN tbl_department on tbl_emp.emp_department = tbl_department.de_id WHERE emp_id = '$id'";
$result4 = $connect->query($sql4);

while ($row4 = $result4->fetch_assoc()) :
    $de = $row4["de_name"];

endwhile;
$sql5 = "SELECT * FROM `tbl_emp` INNER JOIN tbl_department on tbl_emp.emp_department2 = tbl_department.de_id WHERE emp_id = '$id'";
$result5 = $connect->query($sql5);

while ($row5 = $result5->fetch_assoc()) :
    $de2 = $row5["de_name"];

endwhile;
$sql6 = "SELECT * FROM `tbl_emp` INNER JOIN tbl_department on tbl_emp.emp_department3 = tbl_department.de_id WHERE emp_id = '$id'";
$result6 = $connect->query($sql6);

while ($row6 = $result6->fetch_assoc()) :
    $de3 = $row6["de_name"];

endwhile;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blank Page - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search-search-table.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>

<body id="page-top">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ระบุแผนกและตำแหน่ง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit-de-po.php?id=<?php echo $id; ?>" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="stime">แผนก</label>
                            </div>
                            <div class="col">
                                <label for="stime">ตำแหน่ง</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select class="form-select" name="de">
                                    <option value="">เลือกแผนก</option>
                                    <?php while ($row1 = $result1->fetch_assoc()) : ?>
                                    <option value="<?php echo $row1['de_id']; ?>">
                                        <?php echo $row1['de_company']; ?> :
                                        <?php echo $row1['de_name']; ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select" name="po">

                                    <option value="" selected="">เลือกตำแหน่ง</option>
                                    <option value="Technician">Technician</option>
                                    <option value="Officer">Officer</option>
                                    <option value="Engineer">Engineer</option>
                                    <option value="Senior">Senior</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Specialist">Specialist</option>
                                    <option value="Executive">Executive</option>
                                    <option value="Coordinator">Coordinator</option>
                                    <option value="Housekeeper">Housekeeper</option>
                                    <option value="Assistant Manager">Assistant Manager
                                    </option>
                                    <option value="QMR">QMR</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Director">Director</option>
                                    <option value="General Manager">General Manager
                                    </option>
                                    <option value="Business Development Director">
                                        Business Development Director</option>
                                    <option value="Managing Director">Managing Director
                                    </option>

                                </select>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model-->
    <!-- Modal2 -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ระบุแผนกและตำแหน่งที่ 2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit-de-po2.php?id=<?php echo $id; ?>" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="stime">แผนก</label>
                            </div>
                            <div class="col">
                                <label for="stime">ตำแหน่ง</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select class="form-select" name="de">
                                    <option value="">เลือกแผนก</option>
                                    <?php while ($row2 = $result2->fetch_assoc()) : ?>
                                    <option value="<?php echo $row2['de_id']; ?>">
                                        <?php echo $row2['de_company']; ?> :
                                        <?php echo $row2['de_name']; ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select" name="po">

                                    <option value="" selected="">เลือกตำแหน่ง</option>
                                    <option value="Technician">Technician</option>
                                    <option value="Officer">Officer</option>
                                    <option value="Engineer">Engineer</option>
                                    <option value="Senior">Senior</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Specialist">Specialist</option>
                                    <option value="Executive">Executive</option>
                                    <option value="Coordinator">Coordinator</option>
                                    <option value="Housekeeper">Housekeeper</option>
                                    <option value="Assistant Manager">Assistant Manager
                                    </option>
                                    <option value="QMR">QMR</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Director">Director</option>
                                    <option value="General Manager">General Manager
                                    </option>
                                    <option value="Business Development Director">
                                        Business Development Director</option>
                                    <option value="Managing Director">Managing Director
                                    </option>

                                </select>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model2-->
    <!-- Modal3 -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ระบุแผนกและตำแหน่งที่ 3</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit-de-po3.php?id=<?php echo $id; ?>" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="stime">แผนก</label>
                            </div>
                            <div class="col">
                                <label for="stime">ตำแหน่ง</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select class="form-select" name="de">
                                    <option value="">เลือกแผนก</option>
                                    <?php while ($row3 = $result3->fetch_assoc()) : ?>
                                    <option value="<?php echo $row3['de_id']; ?>">
                                        <?php echo $row3['de_company']; ?> :
                                        <?php echo $row3['de_name']; ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select" name="po">

                                    <option value="" selected="">เลือกตำแหน่ง</option>
                                    <option value="Technician">Technician</option>
                                    <option value="Officer">Officer</option>
                                    <option value="Engineer">Engineer</option>
                                    <option value="Senior">Senior</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Specialist">Specialist</option>
                                    <option value="Executive">Executive</option>
                                    <option value="Coordinator">Coordinator</option>
                                    <option value="Housekeeper">Housekeeper</option>
                                    <option value="Assistant Manager">Assistant Manager
                                    </option>
                                    <option value="QMR">QMR</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Director">Director</option>
                                    <option value="General Manager">General Manager
                                    </option>
                                    <option value="Business Development Director">
                                        Business Development Director</option>
                                    <option value="Managing Director">Managing Director
                                    </option>

                                </select>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model3-->
    <div id="wrapper">
        <?php include('nav-menu.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
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
                                        <h6 class="text-primary m-0 fw-bold">ข้อมูลพนักงาน</h6>
                                    </div>
                                    <div class="card-body">
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                        <form>
                                            <div class="row">
                                                <div class="col"><label
                                                        class="col-form-label">รหัสพนักงาน<br><?php echo $row['emp_id']; ?></label>
                                                </div>
                                                <div class="col"><label class="col-form-label">ชื่อ -
                                                        นามสกุล<br><?php echo $row['emp_name']; ?></label>
                                                </div>
                                                <div class="col"><label
                                                        class="col-form-label">บริษัท<br><?php echo $row['emp_company']; ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label">แผนก -
                                                        ตำแหน่ง<br><?php echo $de; ?> -
                                                        <?php echo $row['emp_position']; ?>&nbsp;<button type="button"
                                                            class="btn btn-primary" data-toggle="modal"
                                                            data-target="#exampleModal"> + </button></label>
                                                </div>
                                                <div class="col"><label class="col-form-label">แผนก - ตำแหน่ง
                                                        2<br><?php echo $de2; ?> -
                                                        <?php echo $row['emp_position2']; ?>&nbsp;<button type="button"
                                                            class="btn btn-primary" data-toggle="modal"
                                                            data-target="#exampleModal2"> + </button></label>
                                                </div>
                                                <div class="col"><label class="col-form-label">แผนก - ตำแหน่ง
                                                        3<br><?php echo $de3 ?> -
                                                        <?php echo $row['emp_position3']; ?>&nbsp;<button type="button"
                                                            class="btn btn-primary" data-toggle="modal"
                                                            data-target="#exampleModal3"> + </button></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label">เบอร์โทร<br>-
                                                        <?php echo $row['emp_tel']; ?></label>
                                                </div>
                                                <div class="col"><label class="col-form-label">อีเมล<br>-
                                                        <?php echo $row['emp_email']; ?></label>
                                                </div>
                                                <div class="col"><label
                                                        class="col-form-label">ระดับสิทธิ์<br><?php echo $row['emp_level']; ?></label>
                                                </div>
                                            </div>
                                        </form>
                                        <?php endwhile ?>
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
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>