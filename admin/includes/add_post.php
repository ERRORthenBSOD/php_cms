

<?php
if(isset($_POST['create_post'])){
   $post_title = escape($_POST['title']);
   $post_user = escape($_POST['post_user']);
   $post_category_id = escape($_POST['post_category_id']);
   $post_status = escape($_POST['post_status']);

   $post_image = $_FILES['image']['name'];
   $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_content = escape(mysqli_real_escape_string($connection, $post_content));
    $post_date = escape(date('d-m-y'));


    move_uploaded_file($post_image_temp, "../images/$post_image");
    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query);

    $the_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Created <a href='../post.php?p_id={$the_post_id}'> View Post</a> or <a href='posts.php'>Edit More Posts</a> </p> ";

}


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category">Choose category</label>
        <select name="post_category_id">
            <?php
            $query = "SELECT * FROM categories";
            $selectCategories = mysqli_query($connection, $query);

            confirmQuery($selectCategories);

            while($row = mysqli_fetch_assoc($selectCategories)){
                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];

                echo "<option value='{$catId}'>{$catTitle}</option>"; // --> Added {$catId} inside value attribute
            }
            ?>
        </select>
    </div>

<!--    <div class="form-group">-->
<!--        <label for="author">Post Author</label>-->
<!--        <input type="text" class="form-control" name="author">-->
<!--    </div>-->

    <div class="form-group">
        <label for="users">Choose user</label>
        <select name="post_user">
            <?php
            $query = "SELECT * FROM users";
            $selectUsers = mysqli_query($connection, $query);

            confirmQuery($selectUsers);

            while($row = mysqli_fetch_assoc($selectUsers)){
                $user_id = $row['user_id'];
                $username = $row['username'];

                echo "<option value='{$username}'>{$username}</option>"; // --> Added {$catId} inside value attribute
            }
            ?>
        </select>
    </div>




    <div class="form-group">
    <label for="post_status">Status</label>

    <select name="post_status" id="">
        <option value='draft'>Post Status</option>
        <option value='draft'>Draft</option>
        <option value='published'>Published</option>
    </select>
    </div>


    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div id="" class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control " name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <script>
        $('#summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 100
        });
    </script>


    <div class="form-group">
        <input class="btn btn-secondary" type="submit" name="create_post" value="Publish Post">
    </div>


</form>