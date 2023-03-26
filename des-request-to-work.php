<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
$id = $_REQUEST['id'];
$_SESSION['docrtw'] = $id;
$sql = "SELECT * FROM tbl_request_to_work WHERE rtw_id='$id'";
$result = $connect->query($sql);


$sql1 = "SELECT * FROM tbl_visitor WHERE vi_doc='$id'";
$result1 = $connect->query($sql1);

$sql2 = "SELECT * FROM tbl_request_to_work WHERE rtw_id='$id'";
$result2 = $connect->query($sql2);
while ($testcompany = $result2->fetch_assoc()) :
    $extcompany = $testcompany['rtw_extcompany'];
    $deslocation = $testcompany['rtw_location'];
    $dessdate = $testcompany['rtw_sdate'];
    $desedate = $testcompany['rtw_edate'];
endwhile;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>รายละเอียดการขอเข้าทำงานในพื้นที่</title>
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
                    <h5 class="modal-title" id="exampleModalLabel">ลงทะเบียนผู้เข้าปฏิบัติงาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add-visitor.php" method="post" enctype="multipart/form-data">
                        <div class=" row">
                            <div class="col">
                                <label for="docrec">อ้างอิงใบแจ้งเลขที่</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="doc" id="doc" class="form-control" value=<?php echo $id  ?> readonly>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="extcompany">บริษัทที่จะเข้ามา</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <textarea name="ext" id="ext" cols="30" rows="2" class="form-control" readonly><?php echo $extcompany ?></textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="deslocation">สถานที่ปฏิบัติงาน</label>
                                </div>
                                <div class="col">
                                    <label for="dessdate">วันที่เข้า</label>
                                </div>
                                <div class="col">
                                    <label for="dessdate">วันสิ้นสุด</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <textarea name="deslocation" id="deslocation" cols="30" rows="2" class="form-control" readonly><?php echo $deslocation ?></textarea>
                                </div>
                                <div class="col">
                                    <input type="text" name="dessdate" id="dessdate" class="form-control" value=<?php echo $dessdate; ?> readonly>
                                </div>
                                <div class="col">
                                    <input type="text" name="desedate" id="desedate" class="form-control" value=<?php echo $desedate; ?> readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label for="stime">คำนำหน้า</label>
                            </div>
                            <div class="col">
                                <label for="stime">ชื่อ</label>
                            </div>
                            <div class="col">
                                <label for="stime">นามสกุล</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="tname" id="tname" class="form-control" required>
                                    <option value="">เลือกคำนำหน้า</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" name="fname" id="tname" class="form-control" required>
                            </div>
                            <div class="col">
                                <input type="text" name="lname" id="lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="pic">แนบรูปภาพ</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="file" name="pic" id="pic" accept=".jpg, .jpeg" class="form-control" required>
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
    <!--Model-->
    <!-- Modal Car -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ลงทะเบียนยานพาหนะ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add-visitor.php" method="post" enctype="multipart/form-data">
                        <div class=" row">
                            <div class="col">
                                <label for="docrec">อ้างอิงใบแจ้งเลขที่</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="doc" id="doc" class="form-control" value=<?php echo $id  ?> readonly>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="extcompany">บริษัทที่จะเข้ามา</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <textarea name="ext" id="ext" cols="30" rows="2" class="form-control" readonly><?php echo $extcompany ?></textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="deslocation">สถานที่ปฏิบัติงาน</label>
                                </div>
                                <div class="col">
                                    <label for="dessdate">วันที่เข้า</label>
                                </div>
                                <div class="col">
                                    <label for="dessdate">วันสิ้นสุด</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <textarea name="deslocation" id="deslocation" cols="30" rows="2" class="form-control" readonly><?php echo $deslocation ?></textarea>
                                </div>
                                <div class="col">
                                    <input type="text" name="dessdate" id="dessdate" class="form-control" value=<?php echo $dessdate; ?> readonly>
                                </div>
                                <div class="col">
                                    <input type="text" name="desedate" id="desedate" class="form-control" value=<?php echo $desedate; ?> readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label for="stime">คำนำหน้า</label>
                            </div>
                            <div class="col">
                                <label for="stime">ชื่อ</label>
                            </div>
                            <div class="col">
                                <label for="stime">นามสกุล</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select name="tname" id="tname" class="form-control" required>
                                    <option value="">เลือกคำนำหน้า</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" name="fname" id="tname" class="form-control" required>
                            </div>
                            <div class="col">
                                <input type="text" name="lname" id="lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="pic">แนบรูปภาพ</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="file" name="pic" id="pic" accept=".jpg, .jpeg" class="form-control" required>
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
                                        <h6 class="text-primary m-0 fw-bold">รายละเอียดใบแจ้ง</h6>
                                    </div>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col"><label class="col-form-label"><b>สถานะใบแจ้ง</b>
                                                                :&nbsp;<?php echo $row['rtw_status']; ?></label></div>
                                                        <div class="col"><label class="col-form-label"><b>วันที่</b> :
                                                                <?php echo $row['rtw_date']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"><b>ส่วนงานบริษัท</b>&nbsp;
                                                        :&nbsp;<?php echo $row['rtw_company']; ?> </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"><b>ผู้ติดต่อ</b>
                                                        :&nbsp;<?php echo $row['rtw_informent']; ?></label>
                                                </div>
                                                <div class="col"><label class="col-form-label"><b>บริษัทที่จะเข้ามา</b>
                                                        :
                                                        <?php echo $row['rtw_extcompany']; ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"><b>รายละเอียดงาน</b> :
                                                        <?php echo $row['rtw_job']; ?></label></div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"><b>สถานที่ปฏิบัติงาน</b>
                                                        :
                                                        <?php echo $row['rtw_location']; ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"><b>เข้าวันที่</b> :
                                                        <?php echo $row['rtw_sdate']; ?></label></div>
                                                <div class="col"><label class="col-form-label"><b>ถึงวันที่</b> :
                                                        <?php echo $row['rtw_edate']; ?></label></div>
                                                <div class="col"><label class="col-form-label"><b>เวลา</b> :
                                                        <?php echo $row['rtw_time']; ?></label></div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"><b>จำนวนเข้าปฏิบัติงาน</b> :
                                                        <?php echo $row['rtw_amount']; ?></label>
                                                </div>
                                                <div class="col"><label class="col-form-label"><b>ชาย</b> :
                                                        <?php echo $row['rtw_male']; ?></label></div>
                                                <div class="col"><label class="col-form-label"><b>หญิง</b> :
                                                        <?php echo $row['rtw_female']; ?></label></div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"><b>เครื่องมือที่นำเข้ามา</b>
                                                        : <?php echo $row['rtw_tool']; ?></label></div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"><b>รายละเอียดรถที่เข้าพื้นที่</b>
                                                        : <?php echo $row['rtw_car']; ?></label></div>
                                            </div>
                                        </div>
                                    <?php endwhile ?>

                                </div>
                                <!--<a href="finish-request-to-work.php?id=<?php //echo $id; 
                                                                            ?>"><button type="button"
                                        class="btn btn-success">เสร็จสิ้น</button></a>-->
                            </div>
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary m-0 fw-bold">รายชื่อผู้เข้าปฏิบัติงาน</h6>
                                    </div>
                                    <div class="card-body" style="padding-top: 19px;padding-bottom: 35px;margin-top: -107px;">
                                        <div class="col-md-12 search-table-col">
                                            <div class="table-responsive table table-hover table-bordered results" style="padding-top: 0px;margin-top: 0px;">
                                                <table class="table table-hover table-bordered">
                                                    <thead class="bill-header cs">
                                                        <tr>
                                                            <th id="trs-hd-3" class="col-lg-3">ชื่อ - นามสกุล</th>
                                                            <th id="trs-hd-4" class="col-lg-2">รูปถ่าย</th>
                                                            <th id="trs-hd-6" class="col-lg-2">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="warning no-result">
                                                            <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No
                                                                Result !!!</td>
                                                        </tr>
                                                        <?php while ($row1 = $result1->fetch_assoc()) : ?>
                                                            <tr>

                                                                <td><?php echo $row1['vi_name']; ?></td>
                                                                <td><img src='fileupload/visitor/<?php echo $row1['vi_pic']; ?>' width='100'></td>
                                                                <td><a href="JavaScript:if(confirm('ยกเลิกการเข้าปฏิบัติงาน <?php echo $row1['vi_name']; ?>')==true){window.location='delete-visitor.php?id=<?php echo $row1['id']; ?>';}"><button class="btn btn-danger" style="margin-left: 5px;" type="button"><i class="fa fa-trash" style="font-size: 15px;"></i></button></a>
                                                                    <a href="visitor-card.php?id=<?php echo $row1['id']; ?>" target="_blank"><button class="btn btn-primary" style="margin-left: 5px;" type="button"><i class="far fa-id-card" style="font-size: 15px;"></i></button></a>
                                                                </td>

                                                            </tr>
                                                        <?php endwhile ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
                                            เพิ่มผู้เข้าปฏิบัติงาน
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary m-0 fw-bold">รายการยานพาหนะที่นำเข้ามาในพื้นที่</h6>
                                    </div>
                                    <div class="card-body" style="padding-top: 19px;padding-bottom: 35px;margin-top: -107px;">
                                        <div class="col-md-12 search-table-col">
                                            <div class="table-responsive table table-hover table-bordered results" style="padding-top: 0px;margin-top: 0px;">
                                                <table class="table table-hover table-bordered">
                                                    <thead class="bill-header cs">
                                                        <tr>
                                                            <th id="trs-hd-3" class="col-lg-3">ประเภท</th>
                                                            <th id="trs-hd-4" class="col-lg-2">ยี่ห้อ</th>
                                                            <th id="trs-hd-6" class="col-lg-2">ทะเบียน</th>
                                                            <th id="trs-hd-6" class="col-lg-2">สีรถ</th>

                                                            <th id="trs-hd-6" class="col-lg-2">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="warning no-result">
                                                            <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No
                                                                Result !!!</td>
                                                        </tr>
                                                        <?php while ($row1 = $result1->fetch_assoc()) : ?>
                                                            <tr>

                                                                <td><?php echo $row1['vi_name']; ?></td>
                                                                <td><img src='fileupload/visitor/<?php echo $row1['vi_pic']; ?>' width='100'></td>
                                                                <td><a href="JavaScript:if(confirm('ยกเลิกการเข้าปฏิบัติงาน <?php echo $row1['vi_name']; ?>')==true){window.location='delete-visitor.php?id=<?php echo $row1['id']; ?>';}"><button class="btn btn-danger" style="margin-left: 5px;" type="button"><i class="fa fa-trash" style="font-size: 15px;"></i></button></a>
                                                                    <a href="visitor-card.php?id=<?php echo $row1['id']; ?>" target="_blank"><button class="btn btn-primary" style="margin-left: 5px;" type="button"><i class="far fa-id-card" style="font-size: 15px;"></i></button></a>
                                                                </td>

                                                            </tr>
                                                        <?php endwhile ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"><i class="fas fa-plus"></i>
                                            เพิ่มยานพาหนะ
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="col">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js">
    </script>
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