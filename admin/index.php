<?php include "includes/admin_header.php" ?>
    <div id="wrapper">
        <div id="page-wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><b><?php echo $_SESSION['username'] ?></b> ,now you are: <?php echo $_SESSION['user_role'] ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $post_count = recordCount('posts'); ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $comments_count = recordCount('comments'); ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $users_count = recordCount('users'); ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $cats_count = recordCount('categories'); ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php
//REFACTORING WITH FUNCTIONS
                $post_published_count = checkStatus('posts', 'post_status', 'published');
//                $query = "SELECT * FROM posts WHERE post_status = 'published'";
//                $select_all_published_post = mysqli_query($connection, $query);
//                $post_published_count = mysqli_num_rows($select_all_published_post);

                $post_draft_count = checkStatus('posts', 'post_status', 'draft');
//                $query = "SELECT * FROM posts WHERE post_status = 'draft'";
//                $select_all_draft_post = mysqli_query($connection, $query);
//                $post_draft_count = mysqli_num_rows($select_all_draft_post);

                $post_pending_comments_count = checkStatus('comments', 'comment_status', 'unapproved');
//                $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
//                $select_all_pending_comments = mysqli_query($connection, $query);
//                $post_pending_comments_count = mysqli_num_rows($select_all_pending_comments);

                $post_subs_count = checkUserRole('users', 'user_role', 'subscriber');
//                $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
//                $select_all_subs_users = mysqli_query($connection, $query);
//                $post_subs_count = mysqli_num_rows($select_all_subs_users);
                ?>
                <div class="row"></div>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            $elements_text = ['All Posts', 'Published Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $elements_count = [ $post_count, $post_published_count, $post_draft_count, $post_pending_comments_count, $comments_count, $users_count, $post_subs_count, $cats_count];
                            for($i = 0; $i < 8; $i++){
                                echo "['{$elements_text[$i]}'". " ," . "{$elements_count[$i]}],";
                            }
                            ?>
                        ]);
                        var options = {
                            chart: {
                                title: '',
                                subtitle: ''
                            }
                        };
                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>

