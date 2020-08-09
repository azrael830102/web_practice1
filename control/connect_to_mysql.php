<?php
$host = 'localhost';
//改成你登入phpmyadmin帳號
$user = 'root';
//改成你登入phpmyadmin密碼
$passwd = '';
//資料庫名稱
$database = 'summerpractice';
$connect = mysqli_connect($host, $user, $passwd);
mysqli_select_db ($connect,$database);
 
if ($connect->connect_error) {
    die("連線失敗: " . $connect->connect_error);
}
?>
