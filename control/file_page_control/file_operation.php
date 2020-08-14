<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include("../../model/config.php");
    function renameTheFile($file_id,$new_file_name,$file_path){//$operation == 0
        include("../../model/import_file.php");
        if(file_exists($file_path)) {
            $new_file_path = $upload_file_folder_path.$_SESSION[$col_account]."_".$new_file_name;
            if(rename($file_path,$new_file_path)){
                require("../connect_to_mysql.php");
                $sql_update = "UPDATE $tb_members_files
                        SET $col_file_name='$new_file_name'
                        WHERE $col_file_id='$file_id' ";
                echo $sql_update."<br>";
                if ($connect->query($sql_update) === TRUE) {
                     $connect -> close();
                    return $file_rename_successed_msg;
                }else{
                    $connect -> close();   
                }
            }
            return $file_rename_failed_msg;  
        }else{
            return $file_missing_msg;
        }
    }

    function deleteTheFile($file_id,$file_path){//$operation == 1
        include("../../model/import_file.php");
        if(file_exists($file_path)) {
            if(unlink($file_path)){
                require("../connect_to_mysql.php");
                $sql_delete = "DELETE FROM $tb_members_files WHERE $col_file_id = '$file_id'";
                if ($connect->query($sql_delete) === TRUE) {
                     $connect -> close();
                    return $file_delete_successed_msg;
                }else{
                    $connect -> close();   
                }
            }
            return $file_delete_failed_msg;  
        }
    }

    function downloadTheFile($file_name,$file_path){//$operation == 2
        include("../../model/config.php");
        if (file_exists($file_path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
         }else{
             return $file_missing_msg;
         }
    }

    $msg='';
    if(isset($_POST['msg'])){
        $msg = $_POST['msg'];
        if($msg!=''){
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $msg='';
        }
    }
    
    $account = $_SESSION[$col_account];
    $file_id = $_POST['file_id'];
    $file_name = $_POST['file_name'];
    $new_file_name = $_POST['new_file_name'];
    $operation = $_POST['file_operation'];
 
    $file_path = $upload_file_folder_path.$account."_".$file_name;

	
    
    switch($operation){
        case $opertion_modify:
            $msg = renameTheFile($file_id,$new_file_name,$file_path);
            break;
        case $opertion_delete:
            $msg = deleteTheFile($file_id,$file_path);
            break;
        case $opertion_download:
            $msg = downloadTheFile($file_name,$file_path,$account);
            break;
            
    }
?>

<form id="values" name="values" action="/web_practice1/views/file_page.php" method="post">
    <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
</form>


<?php
echo '<script type="text/javascript">',
     'document.getElementById("values").submit();',
     '</script>';
?>
