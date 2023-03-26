<?php

$ck_expire_day = 10;
$ck_expire = time() + ($ck_expire_day * 60 * 60 * 24);
ob_start();
setcookie("emp_name", $_SESSION["emp_name"], $ck_expire);
setcookie("emp_password", $_SESSION["emp_password"], $ck_expire);
setcookie("id", $_SESSION["id"], $ck_expire);
setcookie("emp_email", $_SESSION["emp_email"], $ck_expire);
setcookie("emp_departmentid", $_SESSION["emp_departmentid"], $ck_expire);
setcookie("emp_departmentid2", $_SESSION["emp_departmentid2"], $ck_expire);
setcookie("emp_departmentid3", $_SESSION["emp_departmentid3"], $ck_expire);
setcookie("emp_department", $_SESSION["emp_department"], $ck_expire);
setcookie("emp_department2", $_SESSION["emp_department2"], $ck_expire);
setcookie("emp_department3", $_SESSION["emp_department3"], $ck_expire);
setcookie("emp_position", $_SESSION["emp_position"], $ck_expire);
setcookie("emp_position2", $_SESSION["emp_position2"], $ck_expire);
setcookie("emp_position3", $_SESSION["emp_position3"], $ck_expire);
setcookie("emp_company", $_SESSION["emp_company"], $ck_expire);
setcookie("emp_level", $_SESSION["emp_level"], $ck_expire);
setcookie("emp_tel", $_SESSION["emp_tel"], $ck_expire);
setcookie("emp_annaul", $_SESSION["emp_annaul"], $ck_expire);
setcookie("emp_leave", $_SESSION["emp_leave"], $ck_expire);
setcookie("emp_sick", $_SESSION["emp_sick"], $ck_expire);
ob_end_flush();
