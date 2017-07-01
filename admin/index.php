<?php include "includes/header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin page 
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                
                                <?php
                                $query = "select count(*) as posts_num from posts;";
                                $select_post_count = mysqli_query($connection, $query);
                                $post_counts = (int) mysqli_fetch_assoc($select_post_count)['posts_num'];
                                    
                                ?>
                                
                                
                              <div class='huge'><?php echo $post_counts;?></div>
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
                                
                                <?php
                                $query = "select count(*) as comments_num from comments;";
                                $select_comment_count = mysqli_query($connection, $query);
                                $comment_counts = (int) mysqli_fetch_assoc($select_comment_count)['comments_num'];
                                    
                                ?>
                                
                                
                                 <div class='huge'><?php echo $comment_counts;?></div>
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
                                
                                <?php
                                $query = "select count(*) as users_num from users;";
                                $select_users_count = mysqli_query($connection, $query);
                                $users_count = (int) mysqli_fetch_assoc($select_users_count)['users_num'];
                                    
                                ?>
                                
                                
                                <div class='huge'><?php echo $users_count;?></div>
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
                                   
                                   <?php
                                    $query = "select count(*) as categories_num from categories;";
                                    $select_categories_count = mysqli_query($connection, $query);
                                    $categories_count = (int) mysqli_fetch_assoc($select_categories_count)['categories_num'];

                                    ?>
                                   
                                    <div class='huge'><?php echo $categories_count;?></div>
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
            
            <div class="row">
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
            
            <?php
            $query = "select count(*) as draft_num from posts where post_status = 'draft';";
            $select_categories_count = mysqli_query($connection, $query);
            $draft_counts = (int) mysqli_fetch_assoc($select_categories_count)['draft_num']; 
            
            $query = "select count(*) as comment_num from comments where comment_status = 'unapproved';";
            $select_comment_unapproved_count = mysqli_query($connection, $query);
            $comment_unapproved_counts =(int) mysqli_fetch_assoc($select_comment_unapproved_count)['comment_num']; 
            
            $query = "select count(*) as admin_num from users where user_role = 'admin';";
            $select_admin_count = mysqli_query($connection, $query);
            $admin_count = (int) mysqli_fetch_assoc($select_admin_count)['admin_num'];
            
            ?>
            
            <?php
             $element_text = ['Active Posts', 'Draft', 'Categories', 'Users', 'Admin', 'Comments', 'Comments_unapproved'];
             $element_count = [$post_counts, $draft_counts, $categories_count, $users_count, $admin_count, $comment_counts, $comment_unapproved_counts];
            print_r($element_count);
            


                              

            ?>
            <script type="text/javascript">
              google.charts.load('current', {'packages':['bar']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                   ['Date', 'Count'],
                   <?php
                    for ($i = 0; $i < 7; $i++) {
                        echo "['{$element_text[$i]}'" . ", $element_count[$i] ], ";
                    } 
                    ?>
                ]);

                var options = {
                  chart: {
                    title: '',
                    subtitle: '',
                  }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
              }
            </script>
            
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php"; ?>
