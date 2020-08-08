<?php include '../model/import_file.php';?>

<!------ Include the above in your HEAD tag ---------->
<?php
    unset($_SESSION);
    unset($_COOKIE);
    session_destroy();
    if(isset($_SESSION[$tb_username])){
          echo "<script type='text/javascript'>alert(123);</script>";
    }
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Location:/web_practice1/views/login.php");
    exit();
?>
