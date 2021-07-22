<?php 
date_default_timezone_set('Asia/Bangkok');
session_start();
require 'conn.php';
$time = date("g:i a,j F, Y ");
$user_id = (int)$_GET['ID'];
$user_id = isset($_GET['ID']) ? $_GET['ID'] : false;
$user_id = str_replace('/[^0-9]/', '', $user_id);
$sql = "SELECT * FROM `tbl_quan-li-nhan-vien` WHERE `ID` = {$user_id}";
$result = mysqli_query($conn,$sql);
$info= mysqli_fetch_assoc($result);
if (isset($_POST['sub'])) {  
  $manv = $info['manv'];
  $tennv = addslashes($_POST['tennv']);
  $diachi = addslashes($_POST['diachi']);
  $sdt = addslashes($_POST['sdt']);
  $phongban = addslashes($_POST['phongban']);
  $chucvu = addslashes($_POST['chucvu']);
  $luong = addslashes($_POST['luong']);
 
  $update = "UPDATE `tbl_quan-li-nhan-vien` SET `tennv`='$tennv',`diachi`='$diachi',`sdt`='$sdt',`phongban`= '$phongban',`chucvu`= '$chucvu',`luong`= '$luong' WHERE `ID` = {$user_id}";
  $result2 = mysqli_query($conn, $update);
  
  if($_SESSION['us']!=="AdminVip"){
  $add = $_SESSION['us']." đã sửa thông tin nhân viên".$manv;
  $sqlhis = "INSERT INTO `tbl_lichsu`(`lichsu`,`time`) VALUES ('$add','$time')";
  $resulthis = mysqli_query($conn, $sqlhis);
}

  header("Location: index.php");

}

if(isset($_SESSION['us']) && $_SESSION['us']){

}
else{
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/home2.css">
    <link rel="stylesheet" href="./css/auth1.css">
    <title>Sửa thông tin nhân viên</title>
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
                <a href="./logout.php">Đăng Xuất</a>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['us']) && $_SESSION['us']) {?>
        <div class = "name_user">
           <i class = "fas fa-user"></i> <?php echo $_SESSION['us']; ?>
        </div>
    <?php } ?>
    <!-- content -->
    <div class="main_home">
    <div class="container">
        <div class="col-ms-8 col-md-9 col-lg-8 col-xl-7 m-auto bg-light p-5">
        <h2>Sửa thông tin</h2>
        <form method="POST">
 		<div class="form-group">
 			<label for="manv">Mã nhân viên</label>
 			<input type="text" class="form-control" name="manv" value=" <?php echo $info['manv'] ?>" readonly="false" required="true" ></div>
 		<div class="form-group">
 			<label for="tennv">Tên nhân viên</label>
 			<input type="text" class="form-control" name="tennv" value="<?php echo $info['tennv'] ?>" required="true"></div>
 		<div class="form-group">
 			<label for="diachi">Địa chỉ</label>
 			<input type="text" class="form-control" name="diachi" value="<?php echo $info['diachi'] ?>" required="true"></div>
 		<div class="form-group">
 			<label for="sdt">Số điện thoại</label>
 			<input type="text" class="form-control" name="sdt" value="<?php echo $info['sdt'] ?>" required="true"></div>
 		<div class="form-group">
 			<label for="phongban">Phòng ban</label>
 			<select name="phongban" class="form-control select2" required="true">
 	  			<option value="<?php echo $info['phongban'] ?>"><?php echo $info['phongban'] ?></option>
      			<option value="Quản lí nhân sự">Quản lí nhân sự</option>
      			<option value="Kế toán ">Kế toán</option>
      			<option value="Điều hành">Điều hành</option>
    		</select>
    	</div>
      <div class="form-group">
      <label for="chucvu">Chức vụ</label>
      <select name="chucvu" class="form-control select2" required="true">
          <option value="<?php echo $info['chucvu'] ?>"><?php echo $info['chucvu'] ?></option>
            <option value="Trưởng phòng">Trưởng phòng</option>
            <option value="Phó phòng">Phó phòng</option>
            <option value="Nhân viên">Nhân viên</option>
        </select>
      </div>
      <div class="form-group">
      <label for="luong">Lương/tháng</label>
      <input type="text" class="form-control" name="luong" value="<?php echo $info['luong'] ?>" required="true"></div>
    	<div class="form-group">
    		<input class="btn btn-primary btn2" type="submit" name="sub" value="Lưu kết quả chỉnh sửa">
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