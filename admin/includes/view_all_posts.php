<?php include "delete_modal.php" ?>
<?php
if(isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options){
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= '{$postValueId}' ";
                $update_to_publish_status = mysqli_query($connection, $query);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= '{$postValueId}' ";
                $update_to_draft_status = mysqli_query($connection, $query);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id= '{$postValueId}' ";
                $update_to_delete_status = mysqli_query($connection, $query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id= '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_post_query)){
                    $post_title       = escape($row['post_title']);
                    $post_category_id = escape($row['post_category_id']);
                    $post_date        = escape($row['post_date']);
                    $post_author      = escape($row['post_author']);
                    $post_status      = escape($row['post_status']);
                    $post_image       = escape($row['post_image']);
                    $post_tags        = escape($row['post_tags']);
                    $post_content     = escape($row['post_content']);
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
                $copy_query = mysqli_query($connection, $query);
                if(!$copy_query){
                    die("Query failed111" . mysqli_error($connection));
                }
                break;
        }
    }
}
?>
<form action="" method="POST">
 <table class="table table-bordered table-hover">
     <div id="bulkOptionContainer" class="col-xs-3">
         <select class="form-control" name="bulk_options" id="">
             <option value="">Select Options</option>
             <option value="published">Publish</option>
             <option value="draft">Draft</option>
             <option value="delete">Delete</option>
             <option value="clone">Clone</option>
         </select>
     </div>

     <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>

     <thead>
    <tr>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>Id</th>
        <th>Users</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Views</th>
    </tr>
    </thead>
    <tbody >
    <?php

//    $query = "SELECT * FROM posts ORDER BY post_id ASC";
    // QUERY WITH JOINING TWO TABLES
    $query = "SELECT posts.post_id, posts.post_author, posts.post_user,posts.post_title,posts.post_category_id,posts.post_status,posts.post_image,";
    $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
    $query .= " FROM posts ";
    $query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id ASC";

    $select_posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id            = escape($row['post_id']);
        $post_author        = escape($row['post_author']);
        $post_user          = escape($row['post_user']);
        $post_title         = escape($row['post_title']);
        $post_category_id   = escape($row['post_category_id']);
        $post_status        = escape($row['post_status']);
        $post_image         = escape($row['post_image']);
        $post_tags          = escape($row['post_tags']);
        $post_comment_count = escape($row['post_comment_count']);
        $post_date          = escape($row['post_date']);
        $post_views_count   = escape($row['post_views_count']);
        $category_title     = escape($row['cat_title']);
        $category_id        = escape($row['cat_id']);
        echo "<tr>";
        echo "<td>
            <input class='checkBoxes' type=\"checkbox\" name='checkBoxArray[]' id=\"selectAllBoxes\" value='{$post_id}'>
              </td>";
        echo "<td>{$post_id}</td>";

        if(!empty($post_author)){
            echo "<td>{$post_author}</td>";
        } elseif (!empty($post_user)){
            echo "<td>{$post_user}</td>";
        }

        echo "<td>{$post_title}</td>";

//        $query2 = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
//        $select_categories_id = mysqli_query($connection,$query2);

//        while($row = mysqli_fetch_assoc($select_categories_id)) {
//            $cat_id = $row['cat_id'];
//            $cat_title = $row['cat_title'];
            echo "<td>$category_title</td>";
//        }

        echo "<td>{$post_status}</td>";
        echo "<td><img width='200' class='img-responsive' src='../images/{$post_image}' alt='image'></td>";
        echo "<td>{$post_tags}</td>";

        $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
        $send_comment_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($send_comment_query);
        $comment_id = $row['comment_id'];

        $count_comments = mysqli_num_rows($send_comment_query);

        echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
//        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \"  href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "<td>{$post_views_count}</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</form>
<?php
if(isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}
?>
<script>
    $(document).ready(function () {
        $(".delete_link").on("click", function(){
            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete="+ id +" ";

            $(".modal_delete_link").attr('href', delete_url);
            $("#myModal").modal('show');
        })
    })
</script>