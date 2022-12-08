<?php
    require_once 'connection.php';
    $xoa = $_GET['ID'];
    // echo $xoa;
    $delete_sql1 = "DELETE from khuyenmai_hoadon where IDHOADON='$xoa'";
    $delete_sql2 = "DELETE from hoadon where hoadon.id='$xoa'";
    mysqli_query($conn, $delete_sql1);
    mysqli_query($conn, $delete_sql2);
    header("Location: index.php?sort=IDHOCVIEN&search=");
?>
