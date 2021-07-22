<?php
session_start();
if(!($_SESSION['us']) && !$_SESSION['us']){
  header("Location:index.php");
}
else {
	$UserAd = $_SESSION['us'];
}
$thongbao="";
$num=0;
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/home2.css">
    <title>Tìm kiếm</title>
</head>
<body>
    <!-- header  -->
    <div class="header">
        <div class="logo">
            <a href="index.php">Team 3</a>
			<span>Ver 1.3</span>
        </div>
        <div class="menu_pc">
            <div class="items-header">
            <a href="index.php">Trang chủ</a>
            </div>
            <div class="items-header">
                <a href="tracuu.php">Tra cứu</a>
            </div>
			<div class="items-header">
                <a href="team.php">Team 3</a>
            </div>
            <div class="items-header_auth">
            <?php if (isset($_SESSION['us']) && $_SESSION['us']) {?>
                <a href="./logout.php">Đăng xuất</a>
            <?php } else { ?>
                <a href="./login.php">Đăng nhập</a>
            <?php } ?>
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
        <div class="search">
            <form class="m-auto col-sm-9  col-xl-7" action="timkiem.php">
                <input type="text" name="tukhoa" placeholder="Nhập tên nhân viên ...">
                <button>Tìm kiếm</button>
            </form>
        </div>    
	<!-- <div class="container"> -->
	<table class="table table-dark">
	 	<thead>
	 		<tr>
	 			<th scope="col">Mã nhân viên</th>
	 			<th scope="col">Tên nhân viên</th>
	 			<th scope="col">Địa chỉ</th>
	 			<th scope="col">SĐT</th>
	 			<th scope="col">Phòng ban</th>
				<th scope="col">Chức vụ</th>
				<th scope="col">Lương/tháng</th>
	 			<th scope="col"></th>
	 			<th scope="col"></th>
	 		</tr>
	 	</thead>
	 	<tbody>
		 <?php 
		 require('conn.php');
		 if (isset($_GET['tukhoa'])) {
			function convert_vi_to_en($str) {
				$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
				$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
				$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
				$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
				$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
				$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
				$str = preg_replace("/(đ)/", "đ", $str);
				$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
				$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
				$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
				$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
				$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
				$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
				$str = preg_replace("/(Đ)/", "Đ", $str);
				return $str;
			}
			$key = addslashes($_GET['tukhoa']);
			$key = convert_vi_to_en($key);
			if (empty($key)){
				$thongbao = "Vui lòng nhập tên nhân viên!";
				$num =0;
			}else{
				$sql = "SELECT * FROM `tbl_quan-li-nhan-vien` WHERE `tennv` LIKE '%$key%'";
				$result = mysqli_query($conn,$sql);
				$num = mysqli_num_rows($result);
		 		if ( $num>0){	
		 		while ( $row = mysqli_fetch_assoc($result)) {
		 			$thongbao ="";
				?>
				<tr>
		 			<td> <?php echo $row['manv'] ?></td>
		 			<td> <?php echo $row['tennv']; ?></td>
		 			<td> <?php echo $row['diachi']; ?></td>
		 			<td> <?php echo $row['sdt'] ?></td>
		 			<td> <?php echo $row['phongban']; ?></td>
					<td> <?php echo $row['chucvu'] ?></td>
					<td> <?php echo $row['luong']; ?> triệu</td>  
					<td><a class="btn btn-danger" href="?tukhoa=<?=$key?>&ID= <?php echo $row['ID'];?>">Xóa</a></td>
		 			<td> <a class="btn btn-info" href="update.php?ID= <?php echo $row['ID'];?>">Sửa</a></td>
		 		</tr> <?php
		$id = !empty($_GET['ID'])?$_GET['ID']:"";
		if ($id == $row['ID']) {
		  ?>
		<div class="msg-delete">
            <div class="table-msg-delete">
                <h2> Xóa nhân viên này?</h2>
                    <a class="btn btn-msg-delete btn-danger" href="delete.php?tukhoa=<?=$key?>&ID=<?=$id?>">
                        <b>Xóa</b></a>
                    <a class="btn btn-msg-back btn-secondary" href="?tukhoa=<?=$key?>" >
                    <b>Trở về</b></a>
            </div>
        </div>	 
		<?php
		}
		?><?php	}
			}else{
				$num =0;
				$thongbao = "Tên nhân viên không tồn tại!";
			}
		}	
		} 
		?>
	</tbody>
	<div class="mt-2 ml-3">
		<a class="btn btn-primary" href="index.php">Hiển thị tất cả</a>
		<h3 class="text-danger"><?php echo "Số nhân viên tìm thấy: ".$num; ?></h3>
	</div>
 	</table>
	 <?php if($num==0){ ?>
		<div class="text-center">
			<b class="text-danger">Chưa có dữ liệu! Nhập tên nhân viên để hiển thị!</b></div>
		<?php }?>
		<?php if ($thongbao !=='') {?>
		<div id="show-msg" class="msg">   
			<div class="table-msg">
				<h4 ><?php echo $thongbao;?></h4>
				<h1 style="position: relative;">
					<i class="warning-msg fas fa-exclamation-triangle"></i>
				</h1>
			</div>
		</div>
		<script>
			document.getElementById('show-msg').onclick = function () {
				document.getElementById('show-msg').style.display = 'none';
			}
			setTimeout(() =>{
				document.getElementById('show-msg').style.display = 'none';
			}, 2300)
		</script>
	<?php }?>
	<!-- </div> -->
    </div>
    <!-- footer  -->
    <div class="footer">
        <span>Design by Team 3 || © Bản quyền thuộc về Team 3</span>
    </div>
</body>
<script src="https://kit.fontawesome.com/882f0e5447.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>