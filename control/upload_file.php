<?php
    include ('../model/import_file.php');

    function returnFileSize($number) {
        if ($number < 1024) {
            return $number.'bytes';
        } else if ($number >= 1024 && $number < 1048576) {
            return (round($number / 1024).'KB');
        } else if ($number >= 1048576) {
            return (round($number / 1048576).'MB');
        }
     }
     function uploadFileToServer(){
        include ('../model/import_file.php');
         //check "files" folder exists
         if (!file_exists($upload_file_folder_path)) {
            mkdir( $upload_file_folder_path );
        }
         
         if ($_FILES["selectedFile"]["error"] > 0){
            switch($_FILES["selectedFile"]["error"]) {
            case UPLOAD_ERR_INI_SIZE:
                echo "Exceeds max size in php.ini";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "Exceeds max size in html form";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "No /tmp dir to write to";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Error writing to disk";
                break;
            default:
                // No error was faced! Phew!
            break;
            }
             return 0;//failed
        }else{
//            echo "檔案名稱: " . $_FILES["selectedFile"]["name"]."<br/>";
//            echo "檔案類型: " . $_FILES["selectedFile"]["type"]."<br/>";
//            echo "檔案大小: " . ($_FILES["selectedFile"]["size"] / 1024)." Kb<br />";
//            echo "暫存名稱: " . $_FILES["selectedFile"]["tmp_name"];
            $filepath = $upload_file_folder_path.$_SESSION[$tb_account]."_".$_FILES["selectedFile"]["name"];
             if(file_exists($filepath)){
                 return 1;
             }else{
                if(move_uploaded_file($_FILES["selectedFile"]["tmp_name"],$filepath)){
                return 2;
                }
                return 0;
            }
        }
    }
    $isupload = uploadFileToServer();
    if($isupload == 2){
        require("connect_to_mysql.php");
        
        $file_id = uniqid();
        $file_name = $_FILES["selectedFile"]["name"];
        $file_size = returnFileSize($_FILES["selectedFile"]["size"]);
        $account = $_SESSION[$tb_account];
        
        $sql_insert="INSERT INTO members_files 
                ($tb_file_id, $tb_file_name, $tb_file_size, $tb_upload_time, $tb_owner)
                VALUES ('$file_id', '$file_name', '$file_size',NOW(), '$account')";
        if ($connect->query($sql_insert) === TRUE) {
                $msg = $file_upload_successed_msg;
            } else {             
                $msg = $file_upload_failed_msg;
            }
        $connect -> close();
    }
    switch($isupload){
        case 0:
            $msg = $file_upload_failed_msg;
            break;
        case 1:
            $msg = $file_upload_exisits_msg;
            break;
        case 2:
            $msg = $file_upload_successed_msg;
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