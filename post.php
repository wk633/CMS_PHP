    <?php
    include "includes/db.php";
    ?>
    <?php 
    include "includes/header.php"; 
    ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
            <?php
            if(isset($_GET['post_id'])) {
                $post_id = $_GET['post_id'];
                $query = "SELECT * FROM posts where post_id=$post_id";
                
                $select_posts = mysqli_query($connection, $query);
                if (!$select_posts) {
                    die("QUERY FAILED " . mysqli_error($connection));
                }
                $row = mysqli_fetch_assoc($select_posts);
//                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                    
            }    
            ?>
               
               
                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title;?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author;?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="./images/<?php echo $post_image;?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"></p>
                <p><?php echo $post_content;?></p>
                

                <hr>

                <!-- Blog Comments -->
                
                
                <?php
                if (isset($_POST['create_comment'])) {
                    print_r($_POST);
                }
                ?>
                
                
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                       
                        <div class="form-group">
                           <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" name="comment_author">
                        </div>
                        
                        <div class="form-group">
                           <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" name="comment_email">
                        </div>
                        
                        
                        <div class="form-group">
                           <label for="content">Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

               <?php include "includes/sidebar.php"; ?>

            </div>
            
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

   <?php 
    include "includes/footer.php"; 
    ?>