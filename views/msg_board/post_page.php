<?php 

include ('../../model/import_file.php');
?>


<!------ Include the above in your HEAD tag ---------->
<?php

    $msg='';
    if(isset($_POST['username'])){
        $name = $_POST['username'];
        $account = $_POST['account'];
     }else{
        $name = $_SESSION[$col_username];
        $account = $_SESSION[$col_account];
    }
    if(isset($_POST['msg'])){
        $msg = $_POST['msg'];
        if($msg!=''){
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $msg='';
        }
    }
?>
<script type="text/javascript">
    function backToMainPage() {
        location.replace('/web_practice1/views/main_page.php');
    }

    function toFilePage() {
        location.replace('/web_practice1/views/file_page.php');
    }

    function SubmitNewPost() {
        document.getElementById("NewPostForm").submit();
    }

    function doTheOperation(op, ID) {
        $("#topic_id").val(ID);
        $("#operation").val(op);
        if (op == 0) {      //reply the topic
            $("#operation").val('<?php echo $opertion_reply;?>');
            document.getElementById("values").submit();
        } else if(op == 1){ //modify the topic
            $("#operation").val('<?php echo $opertion_modify;?>');
            document.getElementById("values").submit();
        }else{// op == 2    //delete the topic
            $("#operation").val('<?php echo $opertion_delete;?>');
            document.getElementById("values").submit();
        }
    }

    $(document).ready(function() {
        $("#NewPostForm").hide();
        $("#NewPost").click(function() {
            if (!$("#NewPostForm").is(':visible')) {
                $("#NewPost").html("Cancel Posting")
                $("#NewPostForm").show('slow');
            } else {
                $("#NewPost").html("New Post")
                $("#NewPostForm").hide('slow');
            }
        });
        
        $("#new_topic_content").keyup(function(){
            var cntlength = $("#new_topic_content").val().length;
            var content = "("+cntlength+" of 500) character";
            if(cntlength >= 500){
                $("#contentLength").removeClass("text-secondary");
                $("#contentLength").addClass("text-danger");
            }else{
                $("#contentLength").removeClass("text-danger");
                $("#contentLength").addClass("text-secondary");
            }    
            $("#contentLength").html(content);
        });
    });

</script>

<body>
    <div class="container">
        <table class="table" style="border-top-style: hidden">
            <tbody>
                <tr>
                    <td width="45%">
                        <h3 class="text-center text-info">Hi, <?php echo $name;?></h3>
                    </td>
                    <td width="45%" align="left">
                        <h4 class="text-left text-info">Welcome To Message Board</h4>
                    </td>
                    <td>
                        <button class="btn btn-info btn-md" onclick="logout();">Logout</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table" style="border-top-style: hidden">
            <tbody>
                <tr>
                    <td align="center">
                        <button class="btn btn-info btn-md" onclick="backToMainPage();">Member List</button>
                    </td>
                    <td align="center">
                        <button class="btn btn-info btn-md" onclick="toFilePage();">File Page</button>
                    </td>
                    <td align="center">
                        <button class="btn btn-info btn-md" id="NewPost">New Post</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <form action="/web_practice1/control/msg_board_control/c_post_page.php" method="post" class="form" role="form" id="NewPostForm">
            <table class="table" style="border-top-style: hidden">
                <tbody>
                    <tr>
                        <td align="left">
                            <label for="new_topic_title" class="text-info">New Topic Title:</label>
                            <input type="text" id="new_topic_title" name="new_topic_title" />
                        </td>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td align="left">
                                <label for="new_topic_content" class="text-info">New Topic Content:</label>
                                <label for="new_topic_content" id="contentLength" class="text-secondary">(0 of 500) character</label>
                                <textarea class="form-control" id="new_topic_content" name="new_topic_content"
                                maxlength="500"
                                ></textarea>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <td align="right">
                            <button class="btn btn-info btn-md" onclick="SubmitNewPost();">Submit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="text" id="NewPostFormOp" name="operation" value="<?php echo $opertion_create;?>" hidden />
        </form>
        
        <table id="recordTb" class="table">
            <thead>
               <td width="5%" align="center">
                    <h6 class="text-center text-muted">No.</h6>
                </td>
                <td width="10%" align="center">
                    <h6 class="text-center text-muted">Poster</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">Title</h6>
                </td>
                <td width="30%" align="center">
                    <h6 class="text-center text-muted">Latest Reply</h6>
                </td>
                <td width="10%" align="center">
                    <h6 class="text-center text-muted">Latest Replier</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">Update Time</h6>
                </td>
                <td colspan="3" align="center">
                    <h6 class="text-center text-muted"> Operation</h6>
                </td>
            </thead>
            
            <tbody>
                <?php
                    require("../../control/connect_to_mysql.php");
                    $sql_query="SELECT * FROM $tb_members_topic order by $col_update_time desc";
                    $result = $connect->query($sql_query);
                    if(mysqli_num_rows ($result)){  
                        $cnt=1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td align='center'>#".$cnt."</td>";
                            echo "<td align='center'>".$row[$col_topic_poster]."</td>";
                            echo "<td align='center'>".$row[$col_topic_title]."</td>";
                            echo "<td align='center'>".$row[$col_last_reply]."</td>";
                            echo "<td align='center'>".$row[$col_replier]."</td>";
                            $timestamp = new DateTime($row[$col_update_time]);
                            echo "<td align='center'>".$timestamp->format('Y/m/d H:i:s')."</td>";
                            
                            $is_topic_owner = ($account == $row[$col_topic_poster_id]);
                            $topic_id = '"'.$row[$col_topic_id].'"';
                            echo "<td align='center'>
                                    <a href='javascript: void(0)' onclick='doTheOperation(0,$topic_id);'>
                                        <img title='Reply this topic' src='/web_practice1/element/reply.png' width='20' height='18' />
                                    </a>
                                </td>";
                            
                            $edit_permission = "";
                            $delete_permission = "";
                            
                            if($is_topic_owner){
                                $edit_permission = "onclick='doTheOperation(1,$topic_id);'";
                                $delete_permission = "onclick='doTheOperation(2,$topic_id);'";
                            }else{
                                $edit_permission = "style='cursor: not-allowed;'";
                                $delete_permission = "style='cursor: not-allowed;'";
                            }
                            echo "<td align='center'>
                                <a href='javascript: void(0)' $edit_permission>
                                    <img hint='Edit this topic' src='/web_practice1/element/edit.png' width='20' height='20' />
                                </a>
                                </td>";
                            echo "<td align='center'>
                                    <a href='javascript: void(0)' $delete_permission>
                                        <img title='Delete this topic' src='/web_practice1/element/delete.png' width='20' height='20' />
                                    </a>
                                </td>";
                            $cnt = $cnt+1;
                        }
                    }else{
                         echo "<tr><td colspan='7' align='center'>No record...</td></tr>";
                    }
                    $connect -> close();
                ?>
            </tbody>
        </table>

        <form id="values" name="values" action="/web_practice1/control/msg_board_control/c_post_page.php" method="post">
            <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
            <input type="text" id="topic_id" name="topic_id" value="" hidden />
            <input type="text" id="operation" name="operation" value="" hidden />
        </form>
    </div>
</body>
