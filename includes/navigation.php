<?php
session_start();
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<!--        <div class="container">-->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <?php
            if (isset($_SESSION['username'])){
            ?>
            
            <ul class="nav navbar-nav navbar-right" style="padding: 0 15px;">
                <li class="dropdown-toggle">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="./includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
              </ul>
            
            <?php
            }
            ?>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
                   <?php
                    
                    $query = "SELECT * FROM categories";
                    $select_all_categories = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_all_categories)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                    
                    ?>
                    <li><a href='admin'>Admin</a></li>
                    
                    <?php
                    if(isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 'admin'){
                            if(isset($_GET['post_id'])) {
                                $edit_id = $_GET['post_id'];
                                echo "<li><a href='admin/posts.php?source=edit_post&edit_id={$edit_id}'>Edit</a></li>";
                            }
                        }
                    }
                    
                    ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            
            
        
<!--
        </div>
         /.container 
-->
    </nav>