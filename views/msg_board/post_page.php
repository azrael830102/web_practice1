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
        $name = $_SESSION[$tb_username];
        $account = $_SESSION[$tb_account];
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
        document.getElementById("NewPostForm").submit();
    }

    function doTheOperation(op, ID, Name) {
        $("#topic_id").val(fileID);
        $("#topic_title").val(fileName);
        $("#operation").val(op);
        if (op == 0) { //rename the file
            var newName = prompt("Please enter new file name:", Name);
            if (newName != null && newName != '') {
                $("#new_file_name").val(newName);
                document.getElementById("values").submit();
            }
        } else {
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
                    <h6 class="text-center text-muted">Publisher</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">Title</h6>
                </td>
                <td align="center">
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
//                    $sql_query="SELECT * FROM members_files where $tb_owner='$account'";
//                    $result = $connect->query($sql_query);
//                    if(mysqli_num_rows ($result)){  
//                        $cnt=1;
//                        while ($row = $result->fetch_assoc()) {
//                            $file_id_and_name = '"'.$row[$tb_file_id].'","'.$row[$tb_file_name].'"';
//                            echo "<tr>";
//                            echo "<td align='center'>#".$cnt."</td>";
//                            echo "<td align='center'>".$row[$tb_file_name]."</td>";
//                            echo "<td align='center'>".$row[$tb_file_size]."</td>";
//                            $timestamp = new DateTime($row[$tb_upload_time]);
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
                        <div class="d-inline-block ">
                            <a href="javascript: void(0)"onclick='doTheOperation(2,"5f34e5ba1cb9a","test.jpg");'> 
                                <img title="Edit this topic" src="/web_practice1/element/edit.png" width="20" height="20" />
                            </a>
                        </div>
                        <div class="d-inline-block ">
                            <button class='btn btn-info btn-md' onclick='doTheOperation(0,"5f34e5ba1cb9a","test.jpg");'>Edit
                            </button>
                        </div>
                    </td>
                    <td align='center'>
                        <div class="d-inline-block ">
                            <a href="javascript: void(0)" onclick='doTheOperation(2,"5f34e5ba1cb9a","test.jpg");'>
                                <img title="Delete this topic" src="/web_practice1/element/delete.png" width="20" height="20" />
                            </a>
                        </div>
                        <div class="d-inline-block ">
                            <button class='btn btn-info btn-md' onclick='doTheOperation(1,"5f34e5ba1cb9a","test.jpg");'>Delete
                            </button>
                        </div>
                    </td>
                    <td align='center'>
                        <div class="d-inline-block ">
                            <a href="javascript: void(0)" onclick='doTheOperation(2,"5f34e5ba1cb9a","test.jpg");'>
                                <img title="Reply this topic" src="/web_practice1/element/reply.png" width="20" height="18" />
                            </a>
                        </div>
                        <div class="d-inline-block ">
                            <button class='btn btn-info btn-md' onclick=''>Reply
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <form id="values" name="values" action="/web_practice1/control/file_operation.php" method="post">
            <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
            <input type="text" id="file_id" name="file_id" value="" hidden />
            <input type="text" id="file_name" name="file_name" value="" hidden />
            <input type="text" id="new_file_name" name="new_file_name" value="" hidden />
            <input type="text" id="file_operation" name="file_operation" value="" hidden />
        </form>
    </div>
</body>
