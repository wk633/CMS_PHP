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
                        <small><?php echo $_SESSION['username'];?></small>
                    </h1>
                    
                    <div class="col-xs-6">
                       
                       <?php
                        insert_category()
                        ?>
                       
                       
                        <form method="post" action="">
                            <div class="form-group">
                               <label for="">Add categories</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit"  value="Add Category">
                            </div>
                        </form>
                        
                        
                       
                        
                        <?php
                        if (isset($_GET['edit'])) {
                            include "includes/update_categories.php";
                        }
                        ?>
                        
                        
                        
                        
                    </div> <!-- add categories form -->
                    
                    
                    <div class="col-xs-6">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               <?php
                                find_all_categories();
                                ?>
                                
                                <?php
                                delete_category();
                                ?>
                            </tbody>
                        </table>
                    </div> <!-- categories table -->
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php"; ?>
