 <?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<!--//if(isset($_POST['register'])){-->
<?php if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = trim(escape($_POST['username']));
    $email    = trim(escape($_POST['email']));
    $password = trim(escape($_POST['password']));

    $error=[
        'username'=>'',
        'email'=>'',
        'password'=>''
    ];
    //username checks
    if(strlen($username)<4){
        $error['username'] = 'Username needs to be longer';
    }
    if($username == ''){
        $error['username'] = 'Username cannot be empty';
    }
    if(username_exists($username)){
        $error['username'] = 'Username already exists';
    }
    //email checks
    if($email == ''){
        $error['email'] = 'Email cannot be empty';
    }
    if(email_exists($email)){
        $error['email'] = 'Email already exists, <a href="index.php">Please login</a>';
    }
    //password checks
    if($password == ''){
        $error['password'] = 'Password cannot be empty';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
//            login_user($username, $password);
        }
    }
    if(empty($error)){
        register_user($username, $email, $password);
        login_user($username, $password);
    }
}?>
<!--//        $query = "SELECT randSalt FROM users";-->
<!--//        $select_randsalt_query = mysqli_query($connection, $query);-->
<!--//        if(!$select_randsalt_query){-->
<!--//            die("Query Failed". mysqli_error($connection));-->
<!--//        }-->
<!---->
<!--//        $row = mysqli_fetch_array($select_randsalt_query);-->
<!--//        $salt = $row ['randSalt'];-->
<!--//        $password = crypt($password, $salt);-->
<!--    -->
<!--//        $message = "Your Registration has been submitted";-->
<!---->
<!--// else {-->
<!--//    $message = '';-->
<!--//}-->
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
<!--                        <h6 class="text-center">--><?php //echo $message;?><!--</h6>-->
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username"
                            autocomplete="on" value="<?php echo isset($username) ? $username : ''?>" >
                            <p><?php echo isset($error['username']) ? $error['username'] : ''?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"
                            autocomplete="on" value="<?php echo isset($email) ? $email : ''?>">
                            <p><?php echo isset($error['email']) ? $error['email'] : ''?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                             <p><?php echo isset($error['password']) ? $error['password'] : ''?></p>
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
        <hr>
<?php include "includes/footer.php";?>