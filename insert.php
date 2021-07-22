<?php 
date_default_timezone_set('Asia/Bangkok');
session_start();
require 'conn.php';
$modelis = isset($_GET['model']);
$time = date("g:i a,j F, Y ");
$sql2="SELECT * FROM `tbl_quan-li-nhan-vien` WHERE `ID`=(SELECT max(ID) FROM `tbl_quan-li-nhan-vien`)";
$result = mysqli_query($conn, $sql2);
$info= mysqli_fetch_assoc($result);
if (isset($_POST['sub'])) {
	$manv = $info['manv']+1;
	$tennv = addslashes($_POST['tennv']);
	$diachi = addslashes($_POST['diachi']);
	$sdt = addslashes($_POST['sdt']);
	$phongban = addslashes($_POST['phongban']);
    $chucvu = addslashes($_POST['chucvu']);
    $luong = addslashes($_POST['luong']);
        if ($chucvu == "Nhân viên") {
            $luong = "10";
        }
        elseif($chucvu == "Trưởng phòng") {
            $luong = "25";
        }
        else{
            $luong = "15";
        }

  $sql = "INSERT INTO `tbl_quan-li-nhan-vien`(`manv`, `tennv`, `diachi`, `sdt`, `phongban`,`chucvu`,`luong`) 
  VALUES ('$manv','$tennv','$diachi','$sdt','$phongban','$chucvu','$luong')";
    if (!mysqli_query($conn, $sql)) {
        die("Lỗi : ".mysqli_error($conn));
    }
    if($_SESSION['us']!=="AdminVip"){
        $add = $_SESSION['us']." đã thêm nhân viên ".$manv;
        $sqlhis = "INSERT INTO `tbl_lichsu`(`lichsu`,`time`) VALUES ('$add','$time')";
        $resulthis = mysqli_query($conn, $sqlhis);
    }
    if (!$modelis) {
        header("Location: index.php"); 
    }
    else {
        header("Location: insert.php?model=true"); 
    }
}

if(isset($_SESSION['us']) && $_SESSION['us']){
}
else{
  header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/auth1.css">
    <link rel="stylesheet" href="./css/home2.css">
    <title>Thêm nhân viên</title>
</head>
<body>
    <!-- header  -->
    <div class="header">
        <div class="logo">
            <a href="./index.php">Team 3</a>
            <span>Ver 1.3</span>
        </div>
        <div class="menu_pc">
            <div class="items-header">
            <a href="./index.php">Trang chủ</a>
            </div>
            <div class="items-header">
                <a href="tracuu.php">Tra cứu</a>
            </div>
            <div class="items-header_auth">
                <a href="./logout.php">Đăng xuất</a>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['us']) && $_SESSION['us']) {?>
        <div class = "name_user">
           <i class = "fas fa-user"></i> <?php echo $_SESSION['us']; ?>
        </div>
    <?php } ?>
        <div class="check_model">
            <a class="<?php if(!$modelis) {?>check_model_is<?php } else {?>active_model<?php } ?> " href="<?php if(!$modelis) {?>?model=true <?php } else {?>?<?php } ?>">
              <b class="mr-5 <?php if(!$modelis) {?>text-secondary<?php } else {?>text-danger<?php } ?> ">Không quay về trang chủ</b> <span></span>
            </a>
        </div>
    <!-- content -->
    <div class="main_home">
    <div class="container">
        <div class="col-ms-8 col-md-9 col-lg-8 col-xl-7 m-auto bg-light p-5">
        <h2>Thêm nhân viên</h2>
        <form method="POST">
            <div class="form-group">
                <label for="manv">Mã nhân viên</label>
                <input type="text" class="form-control"  required="true" readonly="false" value=" <?php echo ($info['manv']+1);?>"></div>       
            <div class="form-group">
                <label for="tennv">Tên nhân viên</label>
                <input type="text" class="form-control" name="tennv" required="true"></div>
            <div class="form-group">
                <label for="diachi">Địa chỉ</label>
                <input type="text" class="form-control" name="diachi" required="true"></div>
            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" class="form-control" name="sdt" required="true"></div>
            <div class="form-group">
                <label for="phongban">Phòng ban</label>
                <select name="phongban" class="form-control select2" required="true">
                    <option value=""></option>
                    <option value="Quản lí nhân sự">Quản lí nhân sự</option>
                    <option value="Kế toán">Kế toán</option>
                    <option value="Sáng tạo">Sáng tạo</option>
                </select>
            </div>
            <div class="form-group">
            <label for="chucvu">Chức vụ</label>
            <select name="chucvu" class="form-control select2" required="true">
                <option value=""></option>
                    <option value="Trưởng phòng">Trưởng phòng</option>
                    <option value="Phó phòng">Phó phòng</option>
                    <option value="Nhân viên">Nhân viên</option>
                </select>
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn2" type="submit" name="sub" value="Thêm Nhân Viên">
            </div>
        </form>
        </div>
    </div>
    </div>
    <!-- footer  -->
    <div class="footer">
        <span>Design by Team 3 || © Bản quyền thuộc về Team 3</span>
    </div>
</body>
<script src="./js/passShow.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>