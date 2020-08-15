<?php
    require ("../../model/import_file.php");
    $msg = '';

    function creat_new_reply(){
        require ("../../model/import_file.php");
        require("../connect_to_mysql.php");
        $result_msg = "";
        $timestamp = date("Y-m-d H:i:s");
        $id = uniqid();
        $topic_id = $_POST['topic_id']; 
        $replier_id = $_SESSION[$col_account];
        $replier = $_SESSION[$col_username];
        $content = $_POST['reply_content'];
        
        $sql_insert="INSERT INTO $tb_members_topic_reply 
                ($col_topic_reply_id, $col_pertain_topic_id, $col_replier_id, $col_replier,
                $col_reply_content,$col_reply_update_time,$col_reply_create_time)
                VALUES ('$id', '$topic_id', '$replier_id','$replier' , '$content', '$timestamp', '$timestamp')";
        if ($connect->query($sql_insert) === TRUE) {
             $sql_update = "UPDATE $tb_members_topic
                                SET $col_last_reply_id = '$id',
                                    $col_topic_update_time = '$timestamp'
                                WHERE $col_topic_id='$topic_id'";
//                echo $sql_update;
                 if ($connect->query($sql_update) === TRUE) {
//                    $result_msg = $topic_update_successed_msg;
                } else {
                    $result_msg = $topic_update_failed_msg;
                }
        } else {
            $result_msg = $topic_reply_create_failed_msg;
        }
        $connect -> close();
        return $result_msg;
	}

    function deleteTheReply(){
        require ("../../model/import_file.php");
        require("../connect_to_mysql.php");
        $result_msg = "";
        $timestamp = date("Y-m-d H:i:s");
        $content = $_POST['reply_content'];
        $reply_id = $_POST['reply_id'];
        $topic_id = $_POST['topic_id'];
        $latest_reply_id = '';
        
        $sql_query="SELECT * FROM $tb_members_topic_reply 
                    WHERE $col_pertain_topic_id = '$topic_id'
                    order by $col_reply_update_time desc";
        $result = $connect->query($sql_query);
       
        if(mysqli_num_rows ($result)){
            $row = $result->fetch_assoc();
            $latest_reply_id = $row[$col_topic_reply_id];
        }
        
        $sql_delete = "DELETE FROM $tb_members_topic_reply WHERE $col_topic_reply_id='$reply_id'";
        if ($connect->query($sql_delete) === TRUE) {
            if($reply_id == $latest_reply_id){
                $second_latest_reply_id = "";
                $result = $connect->query($sql_query);
                if(mysqli_num_rows ($result)){
                    $row = $result->fetch_assoc();
                    $second_latest_reply_id = $row[$col_topic_reply_id];
                }
                $sql_update = "UPDATE $tb_members_topic
                             SET $col_last_reply_id = '$second_latest_reply_id'
                             WHERE $col_topic_id='$topic_id'";
                if ($connect->query($sql_update) === TRUE) {
                          //
                }else {
                    $result_msg = $topic_update_failed_msg;
                } 
            }
        }else{
            $result_msg = $topic_reply_delete_failed_msg;
        }
        $connect -> close();
        return $result_msg;
    }

    function action_to_reply($action){
        require ("../../model/import_file.php");
        require("../connect_to_mysql.php");
        $result_msg = "";
        
        switch($action){
            case $opertion_modify:
                $timestamp = date("Y-m-d H:i:s");
                $content = $_POST['reply_content'];
                $reply_id = $_POST['reply_id'];
                $topic_id = $_POST['topic_id'];
                $sql_update = "UPDATE $tb_members_topic_reply
                               SET $col_reply_content = '$content',
                                   $col_reply_update_time = '$timestamp'
                               WHERE $col_topic_reply_id='$reply_id'";
//                echo $sql_update."<br>";
                 if ($connect->query($sql_update) === TRUE) {
                     $sql_update = "UPDATE $tb_members_topic
                                   SET $col_last_reply_id = '$reply_id'
                                   WHERE $col_topic_id='$topic_id'";
//                      echo $sql_update."<br>";
                      if ($connect->query($sql_update) === TRUE) {
                          //
                      }else {
                        $result_msg = $topic_reply_update_failed_msg;
                    } 
                } else {
                    $result_msg = $topic_reply_update_failed_msg;
                }
                break;
            case $opertion_delete:
                $result_msg = deleteTheReply();
                break;
        }
        $connect -> close();
        return $result_msg;
	}

    $topic_id = $_POST['topic_id']; 
    $operation = $_POST['operation'];
    
    switch($operation){
        case $opertion_reply:
            $msg = creat_new_reply();
            break;
        case $opertion_modify:
        case $opertion_delete:
            $msg = action_to_reply($operation);
            break;
        default:
            $msg = "Known action";
    }

?>



<form id="values" name="values" action="/web_practice1/views/msg_board/reply_page.php" method="post">
    <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
    <input type="text" name="topic_id" value="<?php echo $topic_id;?>" hidden />
</form>

<?php
echo '<script type="text/javascript">',
     'document.getElementById("values").submit();',
     '</script>';
?>
