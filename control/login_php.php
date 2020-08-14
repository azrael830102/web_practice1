<?php
    require ("../model/required_import.php");
    require ("../model/config.php");
    $msg = '';
    $redirectUrl = '/web_practice1/views/main_page.php';
	$account=$_POST['email'];
	$password=$_POST['password'];
	
	require("connect_to_mysql.php");

	$sql_query="SELECT * FROM $tb_members where $col_account = '$account' and $col_password = '$password'";
    $result = $connect->query($sql_query);

	if(mysqli_num_rows ($result)){  
        session_start();
        $row = mysqli_fetch_array($result);
        $_SESSION[$col_username] = $row[$col_username]; 
        $_SESSION[$col_account] = $row[$col_account];
        $_SESSION[$col_password] = $row[$col_password];
        $_SESSION[$col_gender] = $row[$col_gender];
        $_SESSION[$col_color] =$row[$col_color];
	}else{
        $msg = $loginfailed_msg;
        $redirectUrl = '/web_practice1/views/login.php'; 
        echo "========|".mysqli_error($connect)."|=======";
	}
//    echo $sql_query."<br>";
//    print_r($result); 
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