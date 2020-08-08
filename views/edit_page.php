<?php include '../model/import_file.php';?>

<script type="text/javascript">
    function backToMainPage() {
        document.getElementById("values").action='/web_practice1/views/main_page.php';
        document.getElementById("values").submit();
    }
    function SaveTheRecord() {
        document.getElementById("values").action='/web_practice1/control/edit_page_php.php';
        document.getElementById("values").submit();
    }
</script>
<!------ Include the above in your HEAD tag ---------->
<?php
        $account = "";
        $name = "";
        $gender = 0;
        $color = "";
        
        $sessionisset = isset($_SESSION[$tb_username]) && isset($_SESSION[$tb_account]) && 
                        isset($_SESSION[$tb_password]) && isset($_SESSION[$tb_gender]) && 
                        isset($_SESSION[$tb_color]);
    if(!$sessionisset){
        header("Location:/web_practice1/views/login.php");
        exit();
    }
   if(isset($_POST['username'])){
        $msg = $_POST['msg'];
        $name = $_POST['username'];
        $account = $_POST['account'];
        $gender = $_POST['gender'];
        $color = $_POST['color'];
        if($msg!=''){
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $msg='';
        }
     }else{
        $name = $_SESSION[$tb_username];
        $account = $_SESSION[$tb_account];
        $gender = $_SESSION[$tb_gender];
        $color = $_SESSION[$tb_color];
    }
?>

<body>
    <div>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <table class="table" style="border-top-style: hidden">
                            <tbody>
                                <tr>
                                    <td colspan="2" width="95%" align="center">
                                        <h3 class="text-center text-info"><?php echo $name;?>'s profile</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">
                                        <button class="btn btn-info btn-md" onclick="backToMainPage();">Member List</button>
                                    </td>
                                     <td align="right">
                                        <button class="btn btn-info btn-md" onclick="logout();">Logout</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <form id= "values" action="" method="post" class="form" role="form">
                            <div class="form-group">
                                <label for="email" class="text-info">E-mail(Account):</label><br>
                                <input class="form-control" name="account" placeholder="E-mail" type="email" value="<?php echo $account;?>" readonly />
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input class="form-control" name="username" placeholder="Username" type="text" value="<?php echo $name;?>" required />
                            </div>
                            <div class="form-group">
                                <label for="newpassword" class="text-info">New Password:</label><br>
                                <input class="form-control" name="newpassword" placeholder="New Password" type="password"/>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input class="form-control" name="password" placeholder="Fill in if resetting password" type="password"/>
                            </div>
                            <div class="form-group">
                                <label for="repassword" class="text-info">Confirm password:</label><br>
                                <input class="form-control" name="repassword" placeholder="Fill in if resetting password" type="password"/>
                            </div>
                            <table class="table" style="border-top-style: hidden">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block ">
                                                <label for="d_gender" class="text-info">Gender:</label><br>
                                                <div name="d_gender">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="gender" id="gender0" value="0" <?php if (isset($gender) && $gender==0) echo "checked";?> />
                                                        Male
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="gender" id="gender1" value="1" <?php if (isset($gender) && $gender==1) echo "checked";?> />
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-inline-block">
                                                <label for="color" class="text-info">Favorite Color:</label><br>
                                                <input class="form-control" id="colorpicker" name="color" type="color" value="<?php echo $color;?>" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <table class="table" style="border-top-style: hidden">
                                    <tbody>
                                        <tr>
                                            <td align="right">
                                               <button class="btn btn-info btn-md" onclick="SaveTheRecord();">Save</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                             <input type="text" name="msg" value="<?php echo $msg;?>" hidden />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
