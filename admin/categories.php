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
                        <small>Subheading</small>
                    </h1>
                    
                    <div class="col-xs-6">
                       
                       <?php
                        insertCategory()
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
                            include "update_categories.php";
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
                                // find all categories
                                $query1 = "SELECT * FROM categories";
                                $select_all_categories = mysqli_query($connection, $query1);
                                while ($row = mysqli_fetch_assoc($select_all_categories)) {
                                    $id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<tr>".
                                             "<th>{$id}</th>".
                                             "<th>{$cat_title}</th>".
                                             "<th><a href='categories.php?delete={$id}'>Delete</a></th>".
                                             "<th><a href='categories.php?edit={$id}'>Edit</a></th>".
                                         "</tr>";
                                }
                                ?>
                                
                                <?php
                                // delete one category row
                                if (isset($_GET['delete'])) {
                                    $delete_id = $_GET['delete'];
                                    $delete_query = "DELETE FROM categories WHERE cat_id = {$delete_id}";
                                    
                                    $delete_rst = mysqli_query($connection, $delete_query);
                                    if (!$delete_rst) {
                                        die("Query failed: " . mysqli_error($connection));
                                    }else {
                                        header("Location: categories.php");
                                    }
                                }
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
