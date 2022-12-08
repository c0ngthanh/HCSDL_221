<?php
$thoigian=$_POST['thoigian'];
$voucher=$_POST['voucher'];
$state=$_POST['state'];
$sid=$_POST['sid'];
require_once 'connection.php';
$update_sql1= "UPDATE hoadon set thoigian='$thoigian', TRANGTHAI='$state' where hoadon.ID = '$sid'";
$update_sql2= "UPDATE khuyenmai_hoadon set IDKHUYENMAI='$voucher' where IDHOADON='$sid'";
echo $update_sql1;
echo $update_sql2;
mysqli_query($conn, $update_sql1);
mysqli_query($conn, $update_sql2);
header("Location: index.php?sort=IDHOCVIEN&search=");
?>
