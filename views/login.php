<!------ Include the above in your HEAD tag ---------->
<?php
include("../model/init_table/initDB.php");

require ("../model/required_import.php");
 require ("../model/config.php");
    if(isset($_POST['msg'])){
         $message = $_POST['msg'];
        if($message!=''){
            echo "<script type='text/javascript'>alert('$message');</script>";
            $msg='';
        }
    }
?>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login_page" class="form" action="/web_practice1/control/login_php.php" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">E-mail:</label><br>
                                <input type="text" name="email" placeholder="E-mail" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" placeholder="Password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <table class="table" style="border-top-style: hidden">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                                            </td>
                                            <td>
                                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Sign Up" formaction="sign_up.php">
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
