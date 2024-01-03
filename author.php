<?php
include "includes/header.php";
include "includes/navigation.php";

?>

<?php

if (isset($_GET['author'])) {

    $the_author = $_GET['author'];
}



?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php

            $query = "SELECT * FROM posts WHERE post_status = 'Published' && post_author='$the_author'";
            $select_all_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author_id = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);


                $query_user = "SELECT * FROM users WHERE user_id=$post_author_id";
                $select_user = mysqli_query($connection, $query_user);
                while ($row = mysqli_fetch_assoc($select_user)) {

                    $post_author = $row['username'];
                }

                ?>



                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author.php?author=<?php echo $post_author_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                        class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>








                <?php

            }
            if ($row > 0) {
                echo " <!-- Pager -->
            <ul class='pager'>
                    <li class='previous'>
                        <a href='#'>&larr; Older</a>
                    </li>
                    <li class='next'>
                        <a href='#'>Newer &rarr;</a>
                    </li>
                </ul>
           ";
            }

            ?>







        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"; ?>