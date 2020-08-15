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
    $topic_id = $_POST['topic_id'];
    require("../../control/connect_to_mysql.php");
    $sql_query = "SELECT * FROM $tb_members_topic WHERE $col_topic_id ='$topic_id'";
    $result = $connect->query($sql_query);

    $topic_poster_id="";
    $topic_poster = "";
    $topic_title = "";
    $topic_content = "";
    if(mysqli_num_rows ($result)){
        $row = $result->fetch_assoc();
        $topic_poster_id = $row[$col_topic_poster_id];
        $topic_poster = $row[$col_topic_poster];
        $topic_title = $row[$col_topic_title];
        $topic_content = $row[$col_topic_content];
    }
    
?>
<script type="text/javascript">
    function backToMainPage() {
        location.replace('/web_practice1/views/main_page.php');
    }

    function toMsgPage() {
        location.replace('/web_practice1/views/msg_board/post_page.php');
    }

    function toFilePage() {
        location.replace('/web_practice1/views/file_page.php');
    }

    function SubmitReplyForm() {
        document.getElementById("ReplyForm").submit();
    }

    function doTheOperation(op, ID) {
        $("#topic_id").val('<?php echo $topic_id;?>');
        $("#reply_id").val(ID);
        if (op == 0) { //modify the topic
            var target = "title_" + ID;
            $("#scroll_to_element").val(target);
            if (!$("#ReplyForm").is(':visible')) {
                $("#NewReply").html("Cancel Modifying")
                $("#reply_content").val($("#content_" + ID).val());
                $("#ReplyForm").show('slow');
                refreshContentLength();
                $("#ReplyFormOp").val('<?php echo $opertion_modify;?>');
                $(window).scrollTop($("#" + $("#scroll_to_element").val()).offset().top);
            } 
        } else if (op == 1) { //delete the topic
            $("#ReplyFormOp").val('<?php echo $opertion_delete;?>');     
            SubmitReplyForm();
        } else{
            $("#ReplyFormOp").val('<?php echo $opertion_reply;?>'); 
        }    
    }
    
    function refreshContentLength() {
        var cntlength = $("#reply_content").val().length;
            var content = "(" + cntlength + " of 500) character";
            if (cntlength >= 500) {
                $("#contentLength").removeClass("text-secondary");
                $("#contentLength").addClass("text-danger");
            } else {
                $("#contentLength").removeClass("text-danger");
                $("#contentLength").addClass("text-secondary");
            }
            $("#contentLength").html(content);
    }
        
    $(document).ready(function() {
        
        $("#ReplyForm").hide();
        $("#NewReply").click(function() {
            $("#reply_content").val(null);
            if (!$("#ReplyForm").is(':visible')) {
                $("#scroll_to_element").val("");
                $("#topic_id").val('<?php echo $topic_id;?>');
                $("#ReplyFormOp").val('<?php echo $opertion_reply;?>');
                $("#NewReply").html("Cancel Reply")
                $("#ReplyForm").show('slow');
            } else {
                $("#NewReply").html("New Reply")
                $("#ReplyForm").hide('slow');
                $(window).scrollTop($("#" + $("#scroll_to_element").val()).offset().top);
            }
        });
        
        $("#reply_content").keyup(function() {
            refreshContentLength();
        });
    });

</script>

<body>
    <input type="text" id="scroll_to_element" name="scroll_to_element" value="" hidden />
    <div class="container">
        <table class="table" style="border-top-style: hidden">
            <tbody>
                <tr>
                    <td width="45%">
                        <h3 class="text-center text-info">Hi, <?php echo $name;?></h3>
                    </td>
                    <td width="45%" align="left">
                        <h4 class="text-left text-info">Reply To <?php echo $topic_title;?></h4>
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
                        <button class="btn btn-info btn-md" onclick="toMsgPage();">Message Board</button>
                    </td>
                    <td align="center">
                        <button class="btn btn-info btn-md" id="NewReply">New Reply</button>
                    </td>
                </tr>
            </tbody>
        </table>



        <div class="form-group">
            <td align="left">
                <label for="topic_content" class="text-info">Content:</label>
                <textarea class="form-control" id="" name="" style="resize : none;" readonly><?php echo $topic_content;?></textarea>
            </td>
        </div>


        <form action="/web_practice1/control/msg_board_control/c_reply_page.php" method="post" class="form" role="form" id="ReplyForm">
            <table class="table" style="border-top-style: hidden">
                <tbody>
                    <tr>
                        <div class="form-group">
                            <td align="left">
                                <label for="reply_content" id="contentLength" class="text-secondary">(0 of 500) character</label>
                                <input type="text" class="form-control" id="reply_content" name="reply_content" maxlength="500"/>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <td align="right">
                            <button class="btn btn-info btn-md" onclick="SubmitReplyForm();">Send</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="text" id="ReplyFormOp" name="operation" value="" hidden />
            <input type="text" id="topic_id" name="topic_id" value="" hidden />
            <input type="text" id="reply_id" name="reply_id" value="" hidden />
        </form>

        <table id="recordTb" class="table">
            <thead>
                 <td width="5%" align="center">
                    <h6 class="text-center text-muted">No.</h6>
                </td>
                <td width="10%" align="center">
                    <h6 class="text-center text-muted">Replier</h6>
                </td>
                <td width="50%" align="center">
                    <h6 class="text-center text-muted">Content</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">Update Time</h6>
                </td>
                <td colspan="2" align="center">
                    <h6 class="text-center text-muted"> Operation</h6>
                </td>
            </thead>
            <tbody>
                <?php
                    require("../../control/connect_to_mysql.php");
                    $sql_query="SELECT * FROM $tb_members_topic_reply 
                                WHERE $col_pertain_topic_id = '$topic_id'
                                order by $col_reply_update_time desc";
                
                    $result = $connect->query($sql_query);
                    if(mysqli_num_rows ($result)){
                        $cnt=1;
                        while ($row = $result->fetch_assoc()) {
                            $timestamp = new DateTime($row[$col_reply_update_time]);
                            $is_topic_owner = ($account == $row[$col_replier_id]);
                            $reply_id = '"'.$row[$col_topic_reply_id].'"';
                            $edit_permission = "";
                            $delete_permission = "";
                            if($is_topic_owner){
                                $edit_permission = "onclick='doTheOperation(0,$reply_id);'";
                                $delete_permission = "onclick='doTheOperation(1,$reply_id);'";
                            }else{
                                $edit_permission = "style='cursor: not-allowed;'";
                                $delete_permission = "style='cursor: not-allowed;'";
                            }
                            
                            echo "<tr>";
                                echo "<td align='center'>#".$cnt."</td>";
                                echo "<td align='center'>".$row[$col_replier]."</td>";
                                echo "<td align='center'>".$row[$col_reply_content]."</td>";
                                echo "<td align='center'>".$timestamp->format('Y/m/d H:i:s')."</td>";                 echo "<td align='center'>
                                    <a href='javascript: void(0)' $edit_permission>
                                        <img title='Edit this topic' src='/web_practice1/element/edit.png' width='20' height='20' />
                                    </a>
                                    </td>";
                                echo "<td align='center'>
                                        <a href='javascript: void(0)' $delete_permission>
                                            <img title='Delete this topic' src='/web_practice1/element/delete.png' width='20' height='20' />
                                        </a>
                                    </td>";
                            echo "</tr>";
                            echo "<input type='text' id='content_$row[$col_topic_reply_id]' value='$row[$col_reply_content]' hidden /> ";
                            $cnt = $cnt+1;
                        }
                    }else{
                         echo "<tr><td colspan='7' align='center'>No record...</td></tr>";
                    }
                    $connect -> close();
                ?>
            </tbody>
        </table>
    </div>
</body>
