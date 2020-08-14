<?php 

include ((dirname(dirname(__DIR__))).'/model/import_file.php');
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
    var limitInMB = 5;

    function backToMainPage() {
        location.replace('/web_practice1/views/main_page.php');
    }

    function toFilePage() {
        location.replace('/web_practice1/views/file_page.php');
    }

    function SubmitNewPost() {
        $("#operation").val('<?php echo $opertion_create;?>');
        document.getElementById("NewPostForm").submit();
    }

    function doTheOperation(op, ID) {
        $("#topic_id").val(fileID);
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
        
        <form action="" method="post" class="form" role="form" id="NewPostForm">
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
                                <label for="new_topic_title" class="text-info">New Topic Content:</label>
                                <textarea class="form-control" id="new_topic_content" name="new_topic_content"></textarea>
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
        </form>
        
        <table id="recordTb" class="table">
            <thead>
                <td width="10%" align="center">
                    <h6 class="text-center text-muted">Poster</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">Title</h6>
                </td>
                <td width="50%" align="center">
                    <h6 class="text-center text-muted">Latest Reply</h6>
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
//                    require("../control/connect_to_mysql.php");
//                    $sql_query="SELECT * FROM $tb_members_files where $col_owner='$account'";
//                    $result = $connect->query($sql_query);
//                    if(mysqli_num_rows ($result)){  
//                        $cnt=1;
//                        while ($row = $result->fetch_assoc()) {
//                            $file_id_and_name = '"'.$row[$col_file_id].'","'.$row[$col_file_name].'"';
//                            echo "<tr>";
//                            echo "<td align='center'>#".$cnt."</td>";
//                            echo "<td align='center'>".$row[$col_file_name]."</td>";
//                            echo "<td align='center'>".$row[$col_file_size]."</td>";
//                            $timestamp = new DateTime($row[$col_upload_time]);
//                            echo "<td align='center'>".$timestamp->format('Y/m/d H:i:s')."</td>";
//                            echo "<td align='center'>
//                                    <button class='btn btn-info btn-md' onclick='doTheOperation(0,$file_id_and_name);'>Rename
//                                    </button>
//                                  </td>";
//                            echo "<td align='center'>
//                                    <button class='btn btn-info btn-md' onclick='doTheOperation(1,$file_id_and_name);'>Delete
//                                    </button>
//                                  </td>";
//                            echo "<td align='center'>
//                                    <button class='btn btn-info btn-md' onclick='doTheOperation(2,$file_id_and_name);'>Download
//                                    </button>
//                                  </td>";
//                           
//                            $cnt = $cnt+1;
//                        }
//                    }else{
//                         echo "<tr><td colspan='7' align='center'>No record...</td></tr>";
//                    }
//                    $connect -> close();
                ?>
                <tr>
                    <td width="10%" align="center">
                        test
                    </td>
                    <td align="center">
                        test topic
                    </td>
                    <td align="center">
                        test reply
                    </td>
                    <td align="center">
                        2020/08/13 15:03:22
                    </td>
                    
                    <td align='center'>
                        <a href="javascript: void(0)" onclick='doTheOperation(0,"5f34e5ba1cb9a");'>
                            <img title="Reply this topic" src="/web_practice1/element/reply.png" width="20" height="18" />
                        </a>
                    </td>
                    <td align='center'>
                        <a href="javascript: void(0)" style="cursor: not-allowed;">
                            <img title="Edit this topic" src="/web_practice1/element/edit.png" width="20" height="20" />
                        </a>
                    </td>
                    <td align='center'>
                        <a href="javascript: void(0)" style="cursor: not-allowed;">
                            <img title="Delete this topic" src="/web_practice1/element/delete.png" width="20" height="20" />
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <form id="values" name="values" action="/web_practice1/control/msg_board_control/c_post_page.php" method="post">
            <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
            <input type="text" id="topic_id" name="file_id" value="" hidden />
            <input type="text" id="operation" name="file_operation" value="" hidden />
        </form>
    </div>
</body>
