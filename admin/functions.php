<?php
function insert_category () {
    // add categories
    global $connection;
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
}

function find_all_categories () {
    // find all categories
    global $connection;
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
}

function delete_category () {
    // delete one category row
    global $connection;
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
}

?>