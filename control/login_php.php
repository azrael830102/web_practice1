<?php
    require ("../model/required_import.php");
    require ("../model/config.php");
    $msg = '';
    $redirectUrl = '/web_practice1/views/main_page.php';
	$account=$_POST['email'];
	$password=$_POST['password'];
	
	require("connect_to_mysql.php");

	$sql_query="SELECT * FROM members where $tb_account = '$account' and $tb_password = '$password'";
    $result = $connect->query($sql_query);

	if(mysqli_num_rows ($result)){  
        session_start();
        $row = mysqli_fetch_array($result);
        $_SESSION[$tb_username] = $row[$tb_username]; 
        $_SESSION[$tb_account] = $row[$tb_account];
        $_SESSION[$tb_password] = $row[$tb_password];
        $_SESSION[$tb_gender] = $row[$tb_gender];
        $_SESSION[$tb_color] =$row[$tb_color];
	}else{
        $msg = $loginfailed_msg;
        $redirectUrl = '/web_practice1/views/login.php'; 
	}
    $connect -> close();
?>

<form id="values" name="values" action="<?php echo $redirectUrl;?>" method="post">
    <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
</form>

<?php

echo '<script type="text/javascript">',
     'document.getElementById("values").submit();',
     '</script>';
?>