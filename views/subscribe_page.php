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
        $name = $_SESSION[$col_username];
        $account = $_SESSION[$col_account];
        $gender = $_SESSION[$col_gender];
        $color = $_SESSION[$col_color];
    }
    if(isset($_POST['msg'])){
        $msg = $_POST['msg'];
        if($msg!=''){
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $msg='';
        }
    }
    $title = "Please Subscribe us!";
    $is_sub = false;

    require("../control/connect_to_mysql.php");
    $sql_query="SELECT * FROM $tb_members where $col_account='$account'";
    $result = $connect->query($sql_query);
    if(mysqli_num_rows ($result)){  
        $row = $result->fetch_assoc();
        if($row[$col_is_subscribe]){
            $is_sub = true;
            $title = "Thanks for Subscription!";
        }else{
            $is_sub = false;
        }
    }
    $show_video = '';
    $show_button = '';
    if($is_sub == true){
        $show_video='';
        $show_button='style="display: none;"';
    }else{
        $show_video='style="display: none;"';
        $show_button='';
    }


?>
<script type="text/javascript">
    function toEditPage() {
        document.getElementById("values").action = '/web_practice1/views/edit_page.php';
        document.getElementById("values").submit();
    }

    function toFilePage() {
        document.getElementById("values").action = '/web_practice1/views/file_page.php';
        document.getElementById("values").submit();
    }

    function backToMainPage() {
        location.replace('/web_practice1/views/main_page.php');
    }

    function toMsgPage() {
        document.getElementById("values").action = '/web_practice1/views/msg_board/post_page.php';
        document.getElementById("values").submit();
    }

    function doSub() {
        document.getElementById("values").action = '/web_practice1/control/subscribe_page_php.php';
        document.getElementById("values").submit();

    }

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
                        <h4 class="text-left text-info"><?php echo $title;?></h4>
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
                        <button class="btn btn-info btn-md" onclick="toEditPage();">Edit Information</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table">

            <tr <?php echo $show_button;?>>
                <td align="center">
                    <button class="btn btn-info btn-md" onclick="doSub();">Subscribe</button>
                </td>
            </tr>

            <tr <?php echo $show_video;?>>
                <td align="center">
                    <label for="video">Thank you boss </label>
                </td>
            </tr>
            <tr <?php echo $show_video;?>>
                <td align="center">
                    <iframe id="video" width="900" height="506" src="https://www.youtube.com/embed/8tuzFSXeKI0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </td>
            </tr>

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
