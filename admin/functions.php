<?php 

    function confirm_query($result)
    {
        global $connection;
        if(!$result)
        {
            die("Query Failed " . mysqli_error($connection));
        }
    }
    function insert_categories()
    {
        global $connection;
        if(isset($_POST['submit']))
        {
            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || empty($cat_title))
                echo "<p style='color:red'>Category Name can't be empty!</p>";
            else {
                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUE('{$cat_title}') ";

                $create_category_query = mysqli_query($connection, $query);
                
                if(!$create_category_query)
                {
                    die('Query Failed '.mysqli_error($connection));
                }
            }
        }
    }

    function delete_query()
    {
        global $connection;
        if(isset($_GET['delete']))
        {
            $delete_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id} ";
            $delete_query = mysqli_query($connection, $query);
            header("Location: categories.php");
        }
    }
?>