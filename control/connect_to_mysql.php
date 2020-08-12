<?php
$host = 'localhost:3308';
//改成你登入phpmyadmin帳號
$user = 'root';
//改成你登入phpmyadmin密碼
$passwd = '';
//資料庫名稱
$database = 'summerpractice';
$connect = mysqli_connect($host, $user, $passwd);
//echo $host." connect successed<br>";
 if(mysqli_select_db ($connect,$database)){
// echo $database." connect successed<br>";
 }

if ($connect->connect_error) {
    die("連線失敗: " . $connect->connect_error);
}
?>
