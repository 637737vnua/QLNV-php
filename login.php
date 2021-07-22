<?php 
require 'connect.php';
$sql = " SELECT * FROM `tbl_admin`";
$thongbao ="";
$result = mysqli_query($conn, $sql);
if (session_id() === '') session_start();
if (isset($_POST['sub'])) {
    $User = addslashes($_POST['User']);
    $Pass = addslashes($_POST['Pass']);	
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
                if ($row['User']==$User && $row['Pass']==$Pass) {
                    $_SESSION['us'] = $_POST['User'];
                    header("Location: index.php");
                    return;
                }

                else{
                    $thongbao = "Sai thông tin đăng nhập";
                }
            }
    }
    if ($User===""||$Pass==="") {
        header("Location: login.php");
    }
}
if(isset($_SESSION['us']) && $_SESSION['us']){
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
    <title>Login</title>
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
            <div class="items-header">
                <a href="team.php">Team 3</a>
            </div>
            <div class="items-header_auth">
                <a href="./login.php">Đăng nhập</a>
            </div>
        </div>
    </div>
    <!-- content -->
    <div class="home_background">
        <?php
            if ($thongbao !=="") {
        ?>  
        <div class="error_table-login">
                <div class="error_login col-sm-7 col-md-5 col-lg-4 col-xl-3">
                   <i class="fas fa-exclamation-circle"></i> 
                   <?php echo $thongbao;?>
                </div>
        </div>
        <script>
            document.querySelector('.error_table-login').onclick = function () {
				document.querySelector('.error_table-login').style.display = "none";
            }
            setTimeout(function(){ 
				document.querySelector('.error_table-login').style.display = "none";
			}, 3000);
        </script>
        <?php     
            }
        ?>
        <div class="table_login col-sm-9 col-md-6 col-lg-5 col-xl-4">
            <form id="form-login" method="POST">
                <div class="text-login">Đăng nhập hệ thống</div>
                <div class="form_group">
                    <label for=""><i class="fas fa-user"></i> Tài khoản </label>
                    <input id="username" name="User" class="form_controller" type="text">
                    <span class="msg_error"></span>
                </div>
                <div class="form_group">
                    <label for=""><i class="fas fa-key"></i> Mật khẩu</label>
                    <div class="password_login">
                       <input id="passlogin" name="Pass" class="form_controller" type="password">
                       <span class="eye-pass">
                           <i class="fas fa-eye" style="display: none;"></i>
                           <i class="fas fa-eye-slash"></i>
                        </span> 
                    </div>
                    <span class="msg_error"></span>
                </div>
                <div class="form_group text-center">
                    <input type="submit" name="sub" class="btn btn-primary mt-2" value="Đăng nhập">
                </div>
            </form>
        </div>
    </div>
    <script src="./js/validator.js"></script>
    <script>
        Validator({
        form: '#form-login',
        message: '.msg_error',
        formGroup: '.form_group',
        rules: [
            Validator.isRequired('#username', 'Vui lòng nhập tên đăng nhập'),
            Validator.isRequired('#passlogin', 'Vui lòng nhập mật khẩu'),
        ],
    })
    </script>
    <!-- footer  -->
    <div class="footer">
        <span>Design by Team 3 || © Bản quyền thuộc về Team 3</span>
    </div>
</body>
<script src="./js/passShow.js"></script>
<script src="https://kit.fontawesome.com/882f0e5447.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>