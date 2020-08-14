<?php
    require ("../model/required_import.php");
  require ("../model/config.php");
    $msg = '';
    $redirectUrl = '/web_practice1/views/login.php';
	$account = $_POST['account'];
    $username = $_POST['name'];
	$password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $gender = $_POST['gender'];
    $color = $_POST['color'];

	if($password!=$repassword){
        $redirectUrl = '/web_practice1/views/sign_up.php';
        $msg = $password_inconsistent_msg;
    }else{
        require("connect_to_mysql.php");
        $sql_query="SELECT * FROM $tb_members where $col_account = '$account'";
        $result = $connect->query($sql_query);
        if(mysqli_num_rows ($result)){  
            $redirectUrl = '/web_practice1/views/sign_up.php';
            $msg = $account_is_exist_msg;
        }else{
            $sql_insert="INSERT INTO $tb_members 
                    ($col_account, $col_username, $col_password, $col_gender, $col_color)
                    VALUES ('$account', '$username', '$password',$gender , '$color')";
            if ($connect->query($sql_insert) === TRUE) {
                $redirectUrl = '/web_practice1/views/login.php';
                $msg = $account_create_successed_msg;
            } else {
                $redirectUrl = '/web_practice1/views/sign_up.php';
                $msg = $account_create_failed_msg;
            }

        }
        $connect -> close();
	}
?>



<form id="values" name="values" action="<?php echo $redirectUrl;?>" method="post">
    <input type="text" name="account" value="<?php echo $account;?>" hidden />
    <input type="text" name="username" value="<?php echo $username;?>" hidden />
    <input type="text" name="gender" value="<?php echo $gender;?>" hidden />
    <input type="text" name="color" value="<?php echo $color;?>" hidden />
    <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
</form>

<?php
echo '<script type="text/javascript">',
     'document.getElementById("values").submit();',
     '</script>';
?>
