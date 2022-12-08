<?php
    require_once 'connection.php';
    $IDHOCVIEN=$_GET['IDHOCVIEN'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm học viên</title>
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
    <h1 class="title">Thêm thông tin học viên ID = <?php echo $IDHOCVIEN;?></h1>
    <form action="themhocvien.php" method="post">
        <input type="hidden" name="ID" value="<?php echo $IDHOCVIEN;?>" id="ID">
      <div class="form-group">
        <label for="thoigian">Tên</label>
        <input  class="form-control" id="ten" name="ten" >
      </div>
      <div class="form-group">
        <label for="voucher">Số điện thoại</label>
        <input class="form-control" id="sdt" name="sdt" >
      </div>
      <div class="form-group">
        <label for="state">Địa chỉ</label>
        <input class="form-control" id="address" name="address" >
      </div>
      <div class="form-group">
        <label for="state">Mail</label>
        <input class="form-control" id="mail" name="mail" >
      </div>
      <div class="form-group">
        <label for="state">Năm sinh</label>
        <input class="form-control" id="dayBorn" name="dayBorn" >
      </div>
      <div class="form-group">
        <label for="state">Trình độ đầu vào</label>
        <input class="form-control" id="level" name="level" >
      </div>
      <div class="form-group">
        <label for="state">Tên đăng nhập</label>
        <input class="form-control" id="tendangnhap" name="tendangnhap" >
      </div>
      <button onclick="return confirm('Bạn muốn thêm học viên mới ?')" type="submit" class="btn btn-primary">Submit</button>
      <a href="hocvien.php" class="btn ">cancel</a>
    </form>
</div>
</body>