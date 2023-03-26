<?php
session_start();
include('connect.php');
include('check-login.php');
include('check-emp-status.php');


if (!isset($_SESSION['emp_name'])) {
    header('location: index.php');
}
$sql = "SELECT * FROM tbl_department ORDER BY de_company DESC";
$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ลงทะเบียนพนักงาน</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top" class="sidebar-toggled">
    <div id="wrapper">
        <?php include('nav-menu.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                    placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i
                                        class="fas fa-search"></i></button></div>
                        </form>
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
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['emp_name']; ?></span><img
                                            class="border rounded-circle img-profile"
                                            src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item"
                                            href="profile.php?id=<?php echo $_SESSION["id"]; ?>"><i
                                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;ข้อมูลผู้ใช้</a>
                                        <a class="dropdown-item" href="list-myhardware.php"><i
                                                class="fas fa-shopping-cart fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;รายการเบิกของ</a>
                                        <a class="dropdown-item" href="my-ot.php"><i
                                                class="fas fa-clock fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;ประวัติล่วงเวลา</a>
                                        <a class="dropdown-item" href="my-leave.php"><i
                                                class="fas fa-plane fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;ประวัติยื่นขอลา</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item"
                                            href="logout.php"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;ออกจากระบบ</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">ลงทะเบียนพนักงาน</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card textwhite bg-primary text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card textwhite bg-success text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">รายละเอียดพนักงาน</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="add-emp.php" method="POST">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="username"><strong>รหัสพนักงาน</strong></label><input
                                                                class="form-control" type="number" id="username"
                                                                placeholder="รหัสพนักงาน" name="id"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="email"><strong>Email Address</strong></label><input
                                                                class="form-control" type="email" id="email"
                                                                placeholder="user@example.com" name="email"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="password"><strong>Password</strong></label><input
                                                                class="form-control" type="password" id="email"
                                                                placeholder="รหัสผ่าน" name="password"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="first_name"><strong>ชื่อ</strong></label><input
                                                                class="form-control" type="text" id="first_name"
                                                                placeholder="ชื่อ" name="fname"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="last_name"><strong>นามสกุล</strong></label><input
                                                                class="form-control" type="text" id="last_name"
                                                                placeholder="นามสกุล" name="lname"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="first_name"><strong>บริษัท</strong></label><select
                                                                class="form-select" name="company">
                                                                <option value="">เลือกบริษัท</option>

                                                                <option value="ArtLongDev">ArtLongDev</option>
                                                                <option value="Other">Other</option>


                                                            </select></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="first_name"><strong>แผนก</strong></label><select
                                                                class="form-select" name="department">
                                                                <option value="">เลือกแผนก</option>

                                                                <?php while ($row = $result->fetch_assoc()) : ?>
                                                                <option value="<?php echo $row['de_id']; ?>">
                                                                    <?php echo $row['de_company']; ?> :
                                                                    <?php echo $row['de_name']; ?></option>
                                                                <?php endwhile ?>

                                                            </select></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="first_name"><strong>ตำแหน่ง</strong></label><select
                                                                class="form-select" name="position">
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
                                                            </select></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label"
                                                                for="last_name"><strong>เบอร์โทร</strong></label><input
                                                                class="form-control" type="number" name="tel"
                                                                placeholder="-" pattern="[0-9]-" inputmode="numeric">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><button class="btn btn-primary btn-sm"
                                                        type="submit">บันทึก</button></div>
                                            </form>
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