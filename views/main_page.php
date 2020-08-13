<?php include '../model/import_file.php';?>

<!------ Include the above in your HEAD tag ---------->
<?php
    $msg='';
    if(isset($_POST['username'])){
        $name = $_POST['username'];
        $account = $_POST['account'];
        $gender = $_POST['gender'];
        $color = $_POST['color'];
     }else{
        $name = $_SESSION[$tb_username];
        $account = $_SESSION[$tb_account];
        $gender = $_SESSION[$tb_gender];
        $color = $_SESSION[$tb_color];
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
    function toEditPage() {
        document.getElementById("values").action='/web_practice1/views/edit_page.php';
        document.getElementById("values").submit();
    }
    function toFilePage() {
        document.getElementById("values").action='/web_practice1/views/file_page.php';
        document.getElementById("values").submit();
    }
    function toMsgPage() {
        document.getElementById("values").action='/web_practice1/views/msg_board/post_page.php';
        document.getElementById("values").submit();
    }
    
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
                    <td align="center">
                        <button class="btn btn-info btn-md" onclick="toFilePage();">File Page</button>
                    </td>
                    <td align="center">
                        <button class="btn btn-info btn-md"  onclick="toMsgPage();">Message Board</button>
                    </td>
                     <td align="center">
                        <button class="btn btn-info btn-md"  onclick="toEditPage();">Edit Information</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <table id="recordTb" class="table">
            <thead>
                <td width="10pt" align="center">
                    <h6 class="text-center text-muted">No.</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">Name</h6>
                </td>
                <td width="10%" align="center">
                    <h6 class="text-center text-muted">Gender</h6>
                </td>
                <td width="30%" align="center">
                    <h6 class="text-center text-muted">Favorite color</h6>
                </td>
                <td align="center">
                    <h6 class="text-center text-muted">E-Mail</h6>
                </td>
            </thead>
            <tbody>
               <?php
                    require("../control/connect_to_mysql.php");
                    $sql_query="SELECT * FROM members";
                    $result = $connect->query($sql_query);
                    if(mysqli_num_rows ($result)){  
                        $cnt=1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td align='center'>#".$cnt."</td>";
                            echo "<td align='center'>".$row[$tb_username]."</td>";
                            echo "<td align='center'>";
                            switch($row[$tb_gender]){
                                case 0:
                                    echo "♂ Male";
                                    break;
                                case 1:
                                    echo "♀ Female";
                                    break;
                                default:
                                    echo "Unknown";
                            }
                            echo "</td>";
                            echo "<td align='center'>
                                    <span style='display:inline-block'>"
                                        .$row[$tb_color].
                                    "</span>
                                    <span style='display:inline-block; width:50%;'>
                                        <input class='form-control' name='color' type='color' value=".$row[$tb_color]." disabled />
                                    </span>
                                </td>";
                            echo "<td align='center'>".$row[$tb_account]."</td>";
                            echo "</tr>";
                            $cnt = $cnt+1;
                        }
                    }else{
                         echo "<tr><td colspan='5' align='center'>No record...</td></tr>";
                    }
                    $connect -> close();
                ?>
            </tbody>
        </table>
        
        <form id="values" name="values" action="" method="post">
            <input type="text" name="account" value="<?php echo $account;?>" hidden />
            <input type="text" name="username" value="<?php echo $name;?>" hidden />
            <input type="text" name="gender" value="<?php echo $gender;?>" hidden />
            <input type="text" name="color" value="<?php echo $color;?>" hidden />
            <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
        </form>
    </div>
</body>
