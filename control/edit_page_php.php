<?php
    include ('../model/import_file.php');
    
	$GLOBALS['account'] = $_POST['account'];
    $GLOBALS['username'] = $_POST['username'];
	$GLOBALS['newpassword'] = $_POST['newpassword'];
    $GLOBALS['gender'] = $_POST['gender'];
    $GLOBALS['color'] = $_POST['color'];
    
    $oripass = $_SESSION[$col_password];
    $msg = '';
    $redirectUrl = '/web_practice1/views/edit_page.php';

    $account = $GLOBALS['account'];
    $username = $GLOBALS['username'];
    $newpassword = $GLOBALS['newpassword'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $gender = $GLOBALS['gender'];
    $color = $GLOBALS['color'];


    function update_profile($change_password){
        include ('../model/import_file.php');
        $account = $GLOBALS['account'];
        $username = $GLOBALS['username'];
        $newpassword = $GLOBALS['newpassword'];
        $gender = $GLOBALS['gender'];
        $color = $GLOBALS['color'];   
        require("connect_to_mysql.php");

        $sql_update="UPDATE $tb_members
                     SET $col_username='$username', $col_password='$newpassword', 
                     $col_gender=$gender , $col_color='$color' 
                     WHERE $col_account='$account'";
         if(!$change_password){
              $sql_update="UPDATE $tb_members
                        SET $col_username='$username', $col_gender=$gender , $col_color='$color' 
                        WHERE $col_account='$account'";
            }
         $result = $connect->query($sql_update);
         if($result === TRUE){  
             $GLOBALS['msg'] = $account_update_successed_msg;
             $_SESSION[$col_username] = $username;
             $_SESSION[$col_account] = $account;
             $_SESSION[$col_password] = $newpassword;
             $_SESSION[$col_gender] = $gender;
             $_SESSION[$col_color] = $color;
             $connect -> close();
             return '/web_practice1/views/main_page.php';
         } else {
             $GLOBALS['msg'] = $account_update_failed_msg;
             $connect -> close();
             return '/web_practice1/views/edit_page.php';
         }
    }

    if($newpassword!=''){
        if($password!=$repassword){
            $msg = $password_inconsistent_msg;
        }else if($password!=$oripass){
            $msg = $password_incorrect;
        }else{
           $redirectUrl = update_profile(TRUE);
        }
    }else{
       $redirectUrl = update_profile(FALSE);
    }
    $msg = $GLOBALS['msg'];
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
