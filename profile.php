<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');
//include('check-login.php');  



$id = $_REQUEST["id"];
$sql = "SELECT * FROM tbl_emp WHERE emp_id='$id'";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ข้อมูลบัญชี</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Modal เปลี่ยนรหัสผ่าน -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนรหัสผ่าน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit-password.php" method="POST">
                        <div class="row">
                            <div class="col"><label class="form-label">รหัสผ่านเก่า</label><input class="form-control" type="password" name="Opassword"></div>
                        </div>
                        <div class="row">
                            <div class="col"><label class="form-label">รหัสผ่านใหม่</label><input class="form-control" type="password" name="Npassword"></div>
                        </div>
                        <div class="row">
                            <div class="col"><label class="form-label">ยืนยันรหัสผ่านใหม่</label><input class="form-control" type="password" name="Cpassword"></div>
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
    <!--Model เปลี่ยนรหัสผ่าน-->
    <!-- Modal เปลี่ยนอีเมล -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนอีเมล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit-emp-email.php" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="email">ระบุอีเมลใหม่</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="email" name="email" id="email" class="form-control" required>
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
    <!--Model เปลี่ยนอีเมล-->
    <!-- Modal เปลี่ยนชื่อ -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนชื่อ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit-emp-name.php" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="fname">ชื่อ</label>
                            </div>
                            <div class="col">
                                <label for="lname">นามสกุล</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="fname" id="fname" class="form-control" required>
                            </div>
                            <div class="col">
                                <input type="text" name="lname" id="lname" class="form-control" required>
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
    <!--Model เปลี่ยนชื่อ-->
    <!-- Modal เปลี่ยนเบอร์โทร -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนชื่อ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit-emp-tel.php" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="tel">เบอร์โทร</label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="tel" name="tel" id="tel" class="form-control" required>
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
    <!--Model เปลี่ยนเบอร์โทร-->

    <div id="wrapper">
        <?php include('nav-menu.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <!--<div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>-->
                        </form>
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
                    <h3 class="text-dark mb-4">โปรไฟล์</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">รายละเอียด</p>


                                        </div>
                                        <div class="card-body">
                                            <!--<form action="frm-edit-password.php" method="POST">-->
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>รหัสพนักงาน</strong></label><br><label class="form-label" for="username"><strong><?php echo $_SESSION['id']; ?></strong></label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Email Address</strong></label><label class="form-label" for="email"><strong><?php echo $_SESSION['emp_email']; ?></strong></label><br>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">เปลี่ยนอีเมล</button>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="password"><strong>Password</strong></label><br>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">เปลี่ยนรหัสผ่าน</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>ชื่อ</strong></label><br><label class="form-label" for="first_name"><strong><?php echo $_SESSION['emp_name']; ?></strong></label><br>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">เปลี่ยนชื่อ</button>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>เบอร์โทร</strong></label><br><label class="form-label" for="last_name"><strong><?php echo $_SESSION['emp_tel']; ?></strong></label><br>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">เปลี่ยนเบอร์โทร</button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>แผนก</strong></label><br><label class="form-label" for="first_name"><strong><?php echo $_SESSION['emp_department']; ?></strong></label><br><label class="form-label" for="first_name"><strong><?php echo $_SESSION['emp_department2']; ?></strong></label><br><label class="form-label" for="first_name"><strong><?php echo $_SESSION['emp_department3']; ?></strong></label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>ตำแหน่ง</strong></label><br><label class="form-label" for="first_name"><strong><?php echo $_SESSION['emp_position']; ?></strong></label><br><label class="form-label" for="first_name"><strong><?php echo $_SESSION['emp_position2']; ?></strong></label><br><label class="form-label" for="first_name"><strong><?php echo $_SESSION['emp_position3']; ?></strong></label>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endwhile ?>
                                            <!--<div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">บันทึก</button></div>-->
                                            <!--</form>-->
                                        </div>
                                    </div>
                                    <div class="card shadow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5"></div>
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
    <script src="assets/js/theme.js"></script>
</body>

</html>