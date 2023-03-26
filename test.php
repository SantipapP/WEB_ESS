<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js">
    </script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>

    <title>Basic PHP PDO DataTables by devbanban.com 2021</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>Basic PHP PDO Using DataTables</h3>
                <table id="example" class="display table table-striped  table-hover table-responsive table-bordered ">
                    <thead>
                        <tr>
                            <th width="5%">ลำดับ</th>
                            <th width="50%">ชื่อ</th>
                            <th width="45%">นามสกุล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //คิวรี่ข้อมูลมาแสดงในตาราง
                        require_once 'connect-pdo.php';
                        $stmt = $conn->prepare("SELECT* FROM tbl_device");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $k) {
                        ?>
                        <tr>
                            <td><?= $k['dev_assetcode']; ?></td>
                            <td><?= $k['dev_brand']; ?></td>
                            <td><?= $k['dev_model']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <center>Basic PHP PDO DataTables by devbanban.com 2021</center>
</body>

</html>