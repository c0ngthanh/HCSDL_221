<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinh viên - hóa đơn</title>
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
        <h1 class="title">Hóa đơn của sinh viên</h1>
        <form class="form-inline" action="" method="GET">
        <select type="email" class="form-control mb-2 mr-sm-2" placeholder="Enter email" id="sort" name="sort">
                <option value="IDHOCVIEN" <?php if(isset($_GET['sort']) && $_GET['sort'] == "IDSINHVIEN"){echo "selected";}?> >IDHOCVIEN</option>
                <option value="IDKHOAHOC" <?php if(isset($_GET['sort']) && $_GET['sort'] == "IDKHOAHOC"){echo "selected";}?> >IDKHOAHOC</option>
                <option value="ID" <?php if(isset($_GET['sort']) && $_GET['sort'] == "ID"){echo "selected";}?> >ID</option>
                <option value="thoigian" <?php if(isset($_GET['sort']) && $_GET['sort'] == "THOIGIAN"){echo "selected";}?> >THOIGIAN</option>
                <option value="GIATIEN" <?php if(isset($_GET['sort']) && $_GET['sort'] == "GIATIEN"){echo "selected";}?> >GIATIEN</option>
            </select>
            <input type="text" class="form-control mb-2 mr-sm-2" name=search>
            <button type="submit" class="btn btn-primary mb-2">Confirm</button>
        </form>
    <table class="table table-hover">
    <thead>
      <tr>
        <th>ID Hóa Đơn</th>
        <th>Thời gian hóa đơn</th>
        <th>ID Khóa học</th>
        <th>ID khuyến mãi</th>
        <th>Thành tiền</th>
        <th>Trạng thái</th>
        <th>ID học viên</th>
        <th>Tên</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
    <?php
    require_once 'connection.php';
    $sort_option = $_GET['sort'];
    $display = "SELECT a.ID,a.thoigian,a.IDKHOAHOC,c.IDKHUYENMAI ,a.GIATIEN,a.TRANGTHAI,a.IDHOCVIEN,b.TEN from hoadon a,hocvien b,khuyenmai_hoadon c where a.IDHOCVIEN = b.ID and c.IDHOADON=a.ID order by $sort_option";
    if(isset($_GET["search"]) && !empty($_GET["search"])){
        $sort_option = $_GET['sort'];
        $str=$_GET['search'];
        $display = "SELECT a.ID,a.thoigian,a.IDKHOAHOC,c.IDKHUYENMAI ,a.GIATIEN,a.TRANGTHAI,a.IDHOCVIEN,b.TEN from hoadon a,hocvien b,khuyenmai_hoadon c where a.IDHOCVIEN = b.ID and c.IDHOADON=a.ID and a.IDKHOAHOC='$str' order by $sort_option";
    }
    $result = mysqli_query($conn,$display);
    while($r=mysqli_fetch_assoc($result)){
        ?>
        <tr>
        <td><?php echo $r['ID']; ?></td>
        <td><?php echo $r['thoigian']; ?></td>
        <td><?php echo $r['IDKHOAHOC']; ?></td>
        <td><?php echo $r['IDKHUYENMAI']; ?></td>
        <td><?php echo $r['GIATIEN']; ?></td>
        <td><?php echo $r['TRANGTHAI']; ?></td>
        <td><?php echo $r['IDHOCVIEN']; ?></td>
        <td><?php echo $r['TEN']; ?></td>
        <td>
            <a href="edit.php?ID=<?php echo $r['ID']; ?>"  class="btn btn-primary">Sửa</a>
            <a onclick="return confirm('Bạn có muốn xóa hóa đơn này')" href="delete.php?ID=<?php echo $r['ID']; ?>" class="btn btn-danger">Xóa</a>
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
