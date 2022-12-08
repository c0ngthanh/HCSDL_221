<?php
    require_once 'connection.php';
    $ID=$_GET['ID'];
    $edit = "SELECT * from hocvien where ID='$ID' order by ID";
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
    <h1 class="title">Chỉnh sửa thông tin học viên ID = <?php echo $ID?></h1>
    <form action="updatehocvien.php" method="post">
        <input type="hidden" name="sid" value="<?php echo $ID?>" id="">
      <div class="form-group">
        <label for="thoigian">Tên</label>
        <input  class="form-control" id="ten" name="ten" value ="<?php echo $row['TEN']?>">
      </div>
      <div class="form-group">
        <label for="voucher">Số điện thoại</label>
        <input class="form-control" id="sdt" name="sdt" value ="<?php echo $row['SDT']?>">
      </div>
      <div class="form-group">
        <label for="state">Địa chỉ</label>
        <input class="form-control" id="address" name="address" value ="<?php echo $row['DIACHI']?>">
      </div>
      <div class="form-group">
        <label for="state">Mail</label>
        <input class="form-control" id="mail" name="mail" value ="<?php echo $row['MAIL']?>">
      </div>
      <div class="form-group">
        <label for="state">Năm sinh</label>
        <input class="form-control" id="dayBorn" name="dayBorn" value ="<?php echo $row['NAMSINH']?>">
      </div>
      <div class="form-group">
        <label for="state">Trình độ đầu vào</label>
        <input class="form-control" id="level" name="level" value ="<?php echo $row['TRINHDODAUVAO']?>">
      </div>
      <div class="form-group">
        <label for="state">Tên đăng nhập</label>
        <input class="form-control" id="tendangnhap" name="tendangnhap" value ="<?php echo $row['TENDANGNHAP']?>">
      </div>
      <button onclick="return confirm('Bạn muốn lưu thay đổi?')" type="submit" class="btn btn-primary">Submit</button>
      <a href="hocvien.php" class="btn ">cancel</a>
    </form>
</div>
</body>