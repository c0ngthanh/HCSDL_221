<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học - Lớp học</title>
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
        <h1 class="title">Số lớp học trong một khóa</h1>
        <form class="form-inline" action="" method="post">
            <input type="" value="IDKHOAHOC" class="form-control mb-2 mr-sm-2" name=search>
            <input type="text" class="form-control mb-2 mr-sm-2" id="sort" name='sort' placeholder ='Enter ID'>
            <input type="submit" name='submit' class="btn btn-primary mb-2" value='submit'>
        </form>
        <table class="table table-hover">
    <thead>
      <tr>
        <th>Tên khóa học</th>
        <th>Số lớp</th>
      </tr>
    </thead>
    <tbody>
    <?php
    require_once 'connection.php';
    if (isset($_POST['submit']) && !empty($_POST['sort'])){
    $sort=$_POST['sort'];
    $display = "select s.tenkhoa, count(p.IDKHOAHOC) 
    from khoahoc s, lophoc p
    where s.ID= p.IDKHOAHOC and s.ID = '$sort'
    group by   s.tenkhoa
    having count(p.IDKHOAHOC)>=0
    order by  count(p.IDKHOAHOC);
  ";
    $result = mysqli_query($conn,$display);
    while($r=mysqli_fetch_assoc($result)){
       ?> 
    <tr>
        <td><?php  echo $r['tenkhoa']; ?></td> 
        <td><?php echo $r['count(p.IDKHOAHOC)']; ?></td>
    </tr>
    <?php
      
    }
}
    ?>
    </tbody>
    </table>
    <a style="text-align:center" type="submit" name='submit' href="khoahoc.php" class="btn btn-primary mb-2" value='submit'>Quay lại</a>
    </div>
</body>
</html>
