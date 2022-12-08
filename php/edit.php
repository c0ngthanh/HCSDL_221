<?php
    require_once 'connection.php';
    $ID=$_GET['ID'];
    $edit = "SELECT a.ID,a.thoigian,a.IDKHOAHOC,c.IDKHUYENMAI ,a.GIATIEN,a.TRANGTHAI,a.IDHOCVIEN,b.TEN from hoadon a,hocvien b,khuyenmai_hoadon c where a.IDHOCVIEN = b.ID and c.IDHOADON=a.ID and a.ID='$ID' order by IDHOCVIEN";
    $result = mysqli_query($conn, $edit);
    $row= mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <h1 class="title">Chỉnh sửa thông tin hóa đơn ID = <?php echo $ID?></h1>
    <form action="update.php" method="post">
        <input type="hidden" name="sid" value="<?php echo $ID?>" id="">
      <div class="form-group">
        <label for="thoigian">Ngày tạo hóa đơn</label>
        <input  class="form-control" id="thoigian" name="thoigian" value ="<?php echo $row['thoigian']?>">
      </div>
      <div class="form-group">
        <label for="voucher">Mã khuyến mãi</label>
        <input class="form-control" id="voucher" name="voucher" value ="<?php echo $row['IDKHUYENMAI']?>">
      </div>
      <div class="form-group">
        <label for="state">Trạng thái</label>
        <input class="form-control" id="state" name="state" value ="<?php echo $row['TRANGTHAI']?>">
      </div>
      <button onclick="return confirm('Bạn muốn lưu thay đổi?')" type="submit" class="btn btn-primary">Submit</button>
      <a href="index.php" class="btn ">cancel</a>
    </form>
</div>
</body>