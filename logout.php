<?php
session_start();

if(isset($_SESSION['us'])){
    unset($_SESSION['us']);
    header("Location: index.php");
}else{
header("Location: index.php");
}
?>