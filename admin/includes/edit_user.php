<?php
if(isset($_GET['edit_user'])) {
    $the_user_id = escape($_GET['edit_user']);
    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }

    if(isset($_POST['edit_user'])){
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_role = escape($_POST['user_role']);
        $username = escape($_POST['username']);
        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['user_password']);
        $user_password = mysqli_real_escape_string($connection, $user_password);
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, ["cost" => 12]);

        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE user_id = {$the_user_id}";

        $edit_user= mysqli_query($connection, $query);
        confirmQuery($edit_user);
        echo "User Edited";
    }
} else {
    header("Location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value = "<?php echo $user_firstname;?>" >
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value = "<?php echo $user_lastname;?>">
    </div>

    <div class="form-group">
        <select name="user_role">
            <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
            <?php
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";
            } else {
               echo "<option value='admin'>admin</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value = "<?php echo $username;?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="user_email" value = "<?php echo $user_email;?>">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password" value = "<?php echo $user_password;?>">
    </div>

    <div class="form-group">
        <input class="btn btn-secondary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>