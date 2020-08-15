<?php
    require ("../../model/import_file.php");
    $msg = '';
    function creat_new_topic(){
        require ("../../model/import_file.php");
        require("../connect_to_mysql.php");
        $result_msg = "";
        
        $id = uniqid();
        $poster_id = $_SESSION[$col_account];
        $poster = $_SESSION[$col_username];
        $title = $_POST['topic_title'];
        $content = $_POST['topic_content'];
        $timestamp = date("Y-m-d H:i:s");
        $sql_insert="INSERT INTO $tb_members_topic 
                ($col_topic_id, $col_topic_poster_id, $col_topic_poster, $col_topic_title,
                $col_topic_content,$col_last_reply_id,$col_topic_update_time,$col_topic_create_time)
                VALUES ('$id', '$poster_id', '$poster','$title' , '$content', '', '$timestamp', '$timestamp')";
//        echo $sql_insert."<br>";
        if ($connect->query($sql_insert) === TRUE) {
            $result_msg = $topic_create_successed_msg;
        } else {
            $result_msg = $topic_create_failed_msg;
        }
//        echo $msg."<br>";
        $connect -> close();
        return $result_msg;
	}

    function action_to_topic($action){
        require ("../../model/import_file.php");
        require("../connect_to_mysql.php");
        $timestamp = date("Y-m-d H:i:s");
        $result_msg = "";
        $topic_id = $_POST['topic_id'];
        switch($action){
            case $opertion_modify:
                $title = $_POST['topic_title'];
                $content = $_POST['topic_content'];
                $sql_update = "UPDATE $tb_members_topic
                                SET $col_topic_title = '$title',
                                    $col_topic_content = '$content',
                                    $col_topic_update_time = '$timestamp'
                                WHERE $col_topic_id='$topic_id'";
//                echo $sql_update;
                 if ($connect->query($sql_update) === TRUE) {
                    $result_msg = $topic_update_successed_msg;
                } else {
                    $result_msg = $topic_update_failed_msg;
                }
                break;
            case $opertion_delete:
                $sql_delete = "DELETE FROM $tb_members_topic WHERE $col_topic_id='$topic_id'";
                if ($connect->query($sql_delete) === TRUE) {
                    $sql_query = "SELECT * FROM $tb_members_topic_reply WHERE $col_pertain_topic_id ='$topic_id'";
                    $result = $connect->query($sql_query);
                    if(mysqli_num_rows ($result)){
                        $sql_delete = "DELETE FROM $tb_members_topic_reply WHERE $col_pertain_topic_id ='$topic_id'";
                        if ($connect->query($sql_delete) === TRUE) {
                            $result_msg = $topic_delete_successed_msg;
                        }else {
                            $result_msg = $topic_delete_failed_msg;
                        }
                    }else{
                        $result_msg = $topic_delete_successed_msg;
                    }
                } else {
                    $result_msg = $topic_delete_failed_msg;
                }
                break;
        }
        $connect -> close();
        return $result_msg;
	}

    $operation = $_POST['operation'];

    switch($operation){
        case $opertion_create:
            $msg = creat_new_topic();
            break;
        case $opertion_modify:
        case $opertion_delete:
            $msg = action_to_topic($operation);
            break;
        default:
            $msg = "Known action".$operation;
    }

?>



<form id="values" name="values" action="/web_practice1/views/msg_board/post_page.php" method="post">
    <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
</form>

<?php
echo '<script type="text/javascript">',
     'document.getElementById("values").submit();',
     '</script>';
?>
