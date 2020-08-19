<?php
    require ("../model/required_import.php");
    require ("../model/config.php");
    $msg = '';
    $redirectUrl = '/web_practice1/views/main_page.php';
    $account = $_POST['account'];
	 require("connect_to_mysql.php");

        $sql_update="UPDATE $tb_members
                     SET $col_is_subscribe= 1
                     WHERE $col_account='$account'";
        $result = $connect->query($sql_update);
         if($result === TRUE){
             $msg = 'Thank you boss!';
         }else{
             $msg = 'Subscribe failed';
         }
    $connect -> close();
?>

<form id="values" name="values" action="/web_practice1/views/subscribe_page.php" method="post">
    <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
</form>

<?php

echo '<script type="text/javascript">',
     'document.getElementById("values").submit();',
     '</script>';
?>