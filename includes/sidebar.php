<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form method="post" action="search.php">
    <div class="input-group">
        <input name = 'search' type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>


<?php
$query = "SELECT * FROM categories LIMIT 3;";
$select_categories_sidebar = mysqli_query($connection, $query);
?>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
               <?php
                while ($row = mysqli_fetch_assoc($select_categories_sidebar)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                }
                ?>
            </ul>
        </div>
        
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php" ?>