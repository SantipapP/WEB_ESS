<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body>

</body>
<li class="nav-item dropdown no-arrow">
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false"
            data-bs-toggle="dropdown" href="#"><span
                class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['emp_name']; ?></span><img
                class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item"
                href="profile.php?id=<?php echo $_SESSION["id"]; ?>"><i
                    class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;ข้อมูลผู้ใช้</a>
            <a class="dropdown-item" href="list-myhardware.php"><i
                    class="fas fa-shopping-cart fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;รายการเบิกของ</a>
            <a class="dropdown-item" href="my-ot.php"><i
                    class="fas fa-clock fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;ประวัติล่วงเวลา</a>
            <a class="dropdown-item" href="my-leave.php"><i
                    class="fas fa-plane fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;ประวัติยื่นขอลา</a>
            <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i
                    class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;ออกจากระบบ</a>

        </div>
    </div>
</li>

</html>