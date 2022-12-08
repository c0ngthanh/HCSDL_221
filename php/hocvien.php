
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách học viên</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:rgba(0, 0, 0, 0.1)">
    <?php 
    require_once 'connection.php';
    $max = "SELECT ID from hocvien order by ID desc limit 1"; 
    $test = mysqli_query($conn,$max); 
    $a=mysqli_fetch_assoc($test);
    $a=substr($a['ID'],7);
    $a=$a+1;
    ?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="hocvien.php">Danh sách học viên</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?sort=IDHOCVIEN&search=">Hóa đơn - học viên</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="khoahoc.php">Khóa học - lớp học</a>
        </li>    
        </ul>
    </div>  
    </nav>
    <div class="container" style="background-color:#FFF">
        <h1 class="title">Danh sách sinh viên</h1>
        <form action="addHocvien.php"method="POST">
            <a href="addHocvien.php?IDHOCVIEN=<?php echo "HOCVIEN$a"?>" type="button" class="btn btn-success">Thêm học viên</a>
        </form>
    <table class="table table-hover">
    <thead>
      <tr>
        <th>ID Học viên</th>
        <th>Tên</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Mail</th>
        <th>Ngày sinh</th>
        <th>Trình độ đầu vào</th>
        <th>Tên đăng nhập</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $display = "SELECT * from hocvien order by ID";
    $result = mysqli_query($conn,$display);
    while($r=mysqli_fetch_assoc($result)){
        ?>
        <tr>
        <td><?php echo $r['ID']; ?></td>
        <td><?php echo $r['TEN']; ?></td>
        <td><?php echo $r['SDT']; ?></td>
        <td><?php echo $r['DIACHI']; ?></td>
        <td><?php echo $r['MAIL']; ?></td>
        <td><?php echo $r['NAMSINH']; ?></td>
        <td><?php echo $r['TRINHDODAUVAO']; ?></td>
        <td><?php echo $r['TENDANGNHAP']; ?></td>
        <td>
            <a href="edithocvien.php?ID=<?php echo $r['ID']; ?>"  class="btn btn-primary">Sửa</a>
            <a onclick="return confirm('Bạn có muốn xóa học viên này')" href="deletehocvien.php?ID=<?php echo $r['ID'] ?>" class="btn btn-danger">Xóa</a>
        </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    </table>
    </div>
</body>
</html>
