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
        $title = $_POST['new_topic_title'];
        $content = $_POST['new_topic_content'];
        $replier = $_SESSION[$col_username];
        
        $sql_insert="INSERT INTO $tb_members_topic 
                ($col_topic_id, $col_topic_poster_id, $col_topic_poster, $col_topic_title,
                $col_last_reply,$col_replier,$col_update_time,$col_create_time)
                VALUES ('$id', '$poster_id', '$poster','$title' , '$content', '$replier', NOW(), NOW())";
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

    $operation = $_POST['operation'];
    switch($operation){
        case $opertion_create:
            $msg = creat_new_topic();
            break;
        case $opertion_modify:
            break;
        case $opertion_delete:
            break;
        case $opertion_reply:
            break;
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
