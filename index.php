<?php
if (isset($_COOKIE['id'])) {
    header('refresh:0; url=login-saved.php');
}
@ini_set('display_errors', '0');
$id = $_COOKIE['id'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script>
    function togglePassword() {
        var pw = document.getElementById("pw");
        (pw.type === "password") ? pw.type = "text": pw.type = "password";
    }
    </script>
</head>

<body class="bg-gradient-primary">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ติดต่อผู้ดูแล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="get">
                        <div class="row">
                            <div class="col">
                                <label for="stime">ระบุชื่อ - นามสกุล</label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="name" id="" class="form-control">
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


    <div class="container" data-aos="zoom-in">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image"
                                    style="background: url(&quot;assets/img/logo/ArtLongDev.png&quot;) center / contain no-repeat;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">ระบบสนับสนุนพนักงาน</h4>
                                    </div>
                                    <form class="user" action="login.php" method="POST">
                                        <div class="mb-3"><input class="form-control form-control-user" type="text"
                                                id="exampleInputEmail-1" aria-describedby="emailHelp"
                                                placeholder="Enter Employee Code..." name="id" value=<?php echo $id ?>>
                                        </div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password"
                                                id="pw" aria-describedby="emailHelp" placeholder="Enter Password"
                                                name="password"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input
                                                        class="form-check-input custom-control-input" type="checkbox"
                                                        id="formCheck-1" name="log" value="savelog"><label
                                                        class="form-check-label custom-control-label"
                                                        for="formCheck-1">Remember Me</label>

                                                </div>
                                                <div class="form-check">
                                                    <div style="margin-top:.5rem"><input type="checkbox"
                                                            class="form-check-input custom-control-input"
                                                            onclick="togglePassword()"> Show Password</div>
                                                </div>
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100"
                                            type="submit">Login</button><br>
                                        <div class="text-center"><button type="button" class="btn btn-primary"
                                                data-toggle="modal" data-target="#exampleModal">
                                                Forgot the password
                                            </button></div>
                                        <hr>
                                    </form>

                                    <div class="text-center">Version 1.7.0</div>
                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>