<?php
include "includes/header.php";
include "includes/navigation.php";

?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php
            $per_page = 5;

            $query_count = "SELECT * FROM posts";

            $find_count = mysqli_query($connection, $query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count / $per_page);


            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = "";
            }
            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }

            $query = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id Desc LIMIT $page_1, $per_page";
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

                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title . $post_id ?></a>
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

    <ul class="pager">

        <?php
        for ($i = 1; $i <= $count; $i++) {

            if ($i == $page) {
                echo "<li><a class='active-link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {


                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }

        ?>




    </ul>

    <?php include "includes/footer.php"; ?>