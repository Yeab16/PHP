<?php include "includes/header.php" ?>

<div id="wrapper">


    <?php include "navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>

                    <?php



                    if (isset($_GET['src'])) {
                        $source = $_GET['src'];
                    } else {
                        $source = '';

                    }

                    switch ($source) {

                        case 'add_post':
                            include "includes/add_post.php";
                            break;
                        case 'edit_post':
                            include "includes/edit_post.php";
                            break;
                        default:
                            include "includes/view_all_post.php";
                            break;

                    }


                    ?>


                    <?php

                    if (isset($_GET['delete'])) {
                        $the_post_id = $_GET['delete'];
                        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
                        $delete_query = mysqli_query($connection, $query);
                       
                        header("Location:post.php");
                    }

                    ?>






                </div>





            </div>
        </div>


    </div>


</div>


<?php include "includes/footer.php" ?>