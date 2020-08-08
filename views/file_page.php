<?php include '../model/import_file.php';?>

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

    function checkFileLimit(number) {
        //      limit = 10MB
        var limit = limitInMB * 1024 * 1024;
        if (number < limit) {
            return true;
        }
        return false;
    }

    function returnFileSize(number) {
        if (number < 1024) {
            return number + 'bytes';
        } else if (number >= 1024 && number < 1048576) {
            return (number / 1024).toFixed(1) + 'KB';
        } else if (number >= 1048576) {
            return (number / 1048576).toFixed(1) + 'MB';
        }
    }

    function uploadFile() {
        var selectrdFile = document.getElementById("selectedFile").files[0];
        if (checkFileLimit(selectrdFile.size)) {
            // in limit
            document.getElementById("file_form").submit();
        } else {
            // out limit
            alert("File's size limit is " + limitInMB + "MB");
        }
    }

    function doTheOperation(op, fileID, fileName) {
        $("#file_id").val(fileID);
        $("#file_name").val(fileName);
        $("#file_operation").val(op);
        if (op == 0) { //rename the file
            var dotIndex = fileName.indexOf('.');
            var name = fileName.substring(0,dotIndex);
            var fileExt = fileName.substring(dotIndex,fileName.length);
            var newFileName = prompt("Please enter new file name:", name);
            if (newFileName != null && newFileName != '') {
                $("#new_file_name").val(newFileName+fileExt);
                document.getElementById("values").submit();
            }
        } else {
            document.getElementById("values").submit();
        }
    }
    $(document).ready(function() {
        $("#selectedFile").change(function() {
            var selectrdFile = document.getElementById("selectedFile").files[0];
            $("#fileSizeDisplay").text(selectrdFile.name + " (" + returnFileSize(selectrdFile.size) + " / " + limitInMB + "MB)");
        });
    });

</script>

<body>
    <div class="container">
        <table class="table" style="border-top-style: hidden">
            <tbody>
                <tr>
                    <td width="95%">
                        <h3 class="text-center text-info">Hi, <?php echo $name;?></h3>
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
                    <td align="left">
                        <button class="btn btn-info btn-md" onclick="backToMainPage();">Member List</button>
                    </td>
                    <td align="left">
                        <form class="d-inline-block" id="file_form" action="/web_practice1/control/upload_file.php" method="post" enctype="multipart/form-data">
                            <label for="selectedFile" class="btn btn-info btn-md">Select file</label>
                            <input type="file" id="selectedFile" name="selectedFile" hidden />
                        </form>
                        <div class="d-inline-block">
                            <p id="fileSizeDisplay" class="text-center text-info">No selected file.</p>
                        </div>
                    </td>
                    <td width="10%" align="right">
                        <button class="btn btn-info btn-md" onclick="uploadFile();">Upload</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <table id="recordTb" class="table">
            <thead>
                <td width="10%" align="center">
                    <h6 class="text-center text-muted">No.</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">File Name</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">File Size</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">Upload timestamp</h6>
                </td>
                <td colspan="3" align="center">
                    <h6 class="text-center text-muted"> Operation</h6>
                </td>
            </thead>
            <tbody>
                <?php
                    require("../control/connect_to_mysql.php");
                    $sql_query="SELECT * FROM members_files where $tb_owner='$account'";
                    $result = $connect->query($sql_query);
                    if(mysqli_num_rows ($result)){  
                        $cnt=1;
                        while ($row = $result->fetch_assoc()) {
                            $file_id_and_name = '"'.$row[$tb_file_id].'","'.$row[$tb_file_name].'"';
                            echo "<tr>";
                            echo "<td align='center'>#".$cnt."</td>";
                            echo "<td align='center'>".$row[$tb_file_name]."</td>";
                            echo "<td align='center'>".$row[$tb_file_size]."</td>";
                            $timestamp = new DateTime($row[$tb_upload_time]);
                            echo "<td align='center'>".$timestamp->format('Y/m/d H:i:s')."</td>";
                            echo "<td align='center'>
                                    <button class='btn btn-info btn-md' onclick='doTheOperation(0,$file_id_and_name);'>Rename
                                    </button>
                                  </td>";
                            echo "<td align='center'>
                                    <button class='btn btn-info btn-md' onclick='doTheOperation(1,$file_id_and_name);'>Delete
                                    </button>
                                  </td>";
                            echo "<td align='center'>
                                    <button class='btn btn-info btn-md' onclick='doTheOperation(2,$file_id_and_name);'>Download
                                    </button>
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

        <form id="values" name="values" action="/web_practice1/control/file_operation.php" method="post">
            <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
            <input type="text" id="file_id" name="file_id" value="" hidden />
            <input type="text" id="file_name" name="file_name" value="" hidden />
            <input type="text" id="new_file_name" name="new_file_name" value="" hidden />
            <input type="text" id="file_operation" name="file_operation" value="" hidden />
        </form>
    </div>
</body>
