<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query = "SELECT * FROM categories WHERE cat_id = {$id}";

    $edit_query = mysqli_query($connection, $query);
    if (!$edit_query) {
        die("Query failed: " . mysqli_error($connection)); 
    }else {
        $row = mysqli_fetch_assoc($edit_query);
        $cat_title_edit = $row["cat_title"];
?>

       <!-- edit category --> 
        <form method="post" action="">
            <div class="form-group">
               <label for="">Edit categories</label>
                <input value = "<?php if (isset($cat_title_edit)) {echo $cat_title_edit;} ?>" class="form-control" type="text" name="cat_title">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit" value="Edit Category">
            </div>
        </form>
<?

    }

}

?>

 <?php
if (isset($_POST['edit'])) {
    $new_cat_title = $_POST['cat_title'];
    $query = "UPDATE categories SET cat_title = '{$new_cat_title}' WHERE cat_id = {$id}";

    $edit_result = mysqli_query($connection, $query);

    if (!$edit_result) {
        die("Query failed: " . mysqli_error($connection));
    }
    header("Location: categories.php");
}

?>