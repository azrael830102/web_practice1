<?php  require ("../model/required_import.php");?>

<script type="text/javascript">
    function hasaccfnc() {
        location.replace("/web_practice1/views/login.php");
    }

</script>
<!------ Include the above in your HEAD tag ---------->
<?php
    session_start();
        $account = "";
        $username = "";
        $gender = 0;
        $color = "";
    if(isset($_POST['account'])){
        $account = $_POST['account'];
        $username = $_POST['username'];
        $gender = $_POST['gender'];
        $color = $_POST['color'];
        $msg = $_POST['msg'];
        if($msg!=''){
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $msg='';
        }
    }
    
?>

<body>
    <div>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form action="/web_practice1/control/sign_up_php.php" method="post" class="form" role="form">
                            <h3 class="text-center text-info">Sign Up</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">E-mail(Account):</label><br>
                                <input class="form-control" name="account" placeholder="E-mail" type="email" value="<?php echo $account;?>" required />
                            </div>
                            <div class="form-group">
                                <label for="name" class="text-info">Username:</label><br>
                                <input class="form-control" name="name" placeholder="Username" type="text" value="<?php echo $username;?>" required />
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input class="form-control" name="password" placeholder="Password" type="password" required />
                            </div>
                            <div class="form-group">
                                <label for="repassword" class="text-info">Confirm password:</label><br>
                                <input class="form-control" name="repassword" placeholder="Confirm Password" type="password" required />
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
                                            <td>
                                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Sign Up">
                                            </td>
                                            <td>
                                                <button name="return" class="btn btn-info btn-md" onclick="hasaccfnc();">
                                                    Has Account
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
