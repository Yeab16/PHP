<?php


function usersOnline()
{
    // if (isset($_GET['onlineusers'])) {



        global $connection;
        // if (!$connection) {
        //     session_start();
        //     include "../includes/db.php";



            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session='$session'";

            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);
            if ($count == NULL) {

                mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time')");
            } else {

                mysqli_query($connection, "UPDATE users_online SET time='$time' WHERE session ='$session'");
            }

            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
         return $count_user = mysqli_num_rows($users_online_query);




        



    
}



function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED." . mysqli_error($connection));
    }
}

function insert_categories()
{

    global $connection;
    if (isset($_POST['submit'])) {


        $category = $_POST['cat_title1'];

        if ($category == "" || empty($category)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO  categories(cat_title) values ('$category')";


            if (!$category) {
                die('QUEERY FAILED' . mysqli_error($connection));
            }
            mysqli_query($connection, $query);
        }
    }
}

function findAllcategories()
{

    global $connection;


    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr><th>{$cat_id}</th> <th>{$cat_title}</th> <td><a href='categories.php?delete={$cat_id}'>Delete</a></td> <td><a href='categories.php?edit={$cat_id}'>Edit</a></td></tr>  ";

    }
}

function deleteCategories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query_d = "DELETE FROM categories WHERE cat_id={$the_cat_id}";
        mysqli_query($connection, $query_d);
        header("Location:categories.php");

    }
}





?>