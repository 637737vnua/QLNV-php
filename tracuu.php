
<?php 
if (session_id() === '') session_start();
$info['manv']="";
$info['tennv']="";
$info['phongban']="";
$info['chucvu']="";
$info['luong']="";
$thongbao = "";
if (isset($_GET['sub'])) {
require('conn.php');
    $manv = addslashes($_GET['manv']);
    if (empty($manv)){	
        $thongbao="Vui lòng nhập mã nhân viên! ";
    }
    else{	
        $sql = "SELECT * FROM `tbl_quan-li-nhan-vien` WHERE `manv` like '%$manv%'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if (strlen($manv) < 5 || $num<=0) {
            $thongbao="Mã nhân viên không chính xác!";
        }
        else if ( $num>0 && $manv!=""){						
            $info= mysqli_fetch_assoc($result);
            $thongbao="";				
        }
    }	
	
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
    <title>Tra cứu</title>
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
            <?php if (isset($_SESSION['us']) && $_SESSION['us']) {?>
            <div class="items-header">
                <a href="insert.php">Thêm nhân viên</a>
            </div>
            <?php if($_SESSION['us']==="AdminVip"){ ?>
            <div class="items-header">
                    <a href="history.php">Lịch sử</a>
            </div><?php }} ?>
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
            <form class="m-auto col-sm-9 col-xl-7" >
                <input type="text" name="manv" placeholder="Nhập mã nhân viên ...">
                <button name="sub">Tìm kiếm</button>
            </form>
        </div>
        <?php if (isset($_GET['manv']) && $_GET['manv'] && $num > 0 && strlen($manv) >=5) {
		    ?>
            <div class="show-info col-sm-8 col-md-5 col-xl-5 p-5 m-auto bg-light">
                <div class="text-center mb-4 text-info"><h2><b>Thông tin</b></h2></div>
                <h3><b>Mã nhân viên: </b><?php echo $info['manv']; ?></h3>
                <h3><b>Họ và tên: </b><?php echo $info['tennv']; ?></h3>
                <h3><b>Phòng ban: </b><?php echo $info['phongban']; ?></h3>
                <h3><b>Chức vụ: </b><?php echo $info['chucvu']; ?></h3>
                <h3><b>Lương/tháng: </b><?php echo $info['luong']; ?> triệu</h3>
            </div>
            <?php }
            else { ?>
            <div class="text-center">
                <b>Nhập mã nhân viên để hiển thị</b>
            </div>
            <?php } ?>
    </div>
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