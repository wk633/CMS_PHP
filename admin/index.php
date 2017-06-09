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
                        if (isset($_POST['submit'])) {
                            $cat_title = $_POST['cat_title'];
                            if ($cat_title == "" || empty($cat_title)) {
                                echo "This field should not be empty";
                            }else {
                                $query = "INSERT INTO categories(cat_title) VALUES ('{$cat_title}')";
                                
                                $create_category_category = mysqli_query($connection, $query);
                                
                                if (!$create_category_category) {
                                    die("Query failed " . mysqli_error($connection));
                                }
                            }
                        }
                        ?>
                       
                       
                        <form method="post" action="">
                            <div class="form-group">
                               <label for="">Add categories</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit">
                            </div>
                        </form>
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
                                $query1 = "SELECT * FROM categories";
                                $select_all_categories = mysqli_query($connection, $query1);
                                while ($row = mysqli_fetch_assoc($select_all_categories)) {
                                    $id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<tr><th>{$id}</th><th>{$cat_title}</th></tr>";
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
