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

            if (isset($_GET['p_id'])) {

                $the_post_id = $_GET['p_id'];


                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                $update_view_query = mysqli_query($connection, $view_query);
                confirm($update_view_query);
                if (isset($_SESSION['user_id'])) {



                    $the_user_id = $_SESSION['user_id'];
                    $view_query_user = "UPDATE users SET user_views_count = user_views_count + 1 WHERE user_id = $the_user_id";
                    $update_view_query_user = mysqli_query($connection, $view_query_user);
                    confirm($update_view_query_user);

                    $userswhoview = $_SESSION['user_id'];
                    $v_query = "INSERT INTO viewersid(v_id,post_id)";

                    $v_query .= "VALUES($userswhoview,$the_post_id)";
                    $user_view_query = mysqli_query($connection, $v_query);
                    confirm($user_view_query);

                }

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                $select_all_posts_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author_id = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
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
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author.php?author=<?php echo $post_author_id ?>"><?php echo $post_author ?></a> </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>


                    <hr>









                    <?php

                }
            } else {
                header('Location:index.php');
            }

            ?>

            <!-- Blog Comments -->





            <?php

            if (isset($_SESSION['username'])) {


                if (isset($_POST['create_comment'])) {
                    $the_post_id = $_GET['p_id'];


                    $comment_author = $_SESSION['username'];
                    $comment_email = $_SESSION['email'];
                    $comment_content = $_POST['comment_content'];
                    if (!empty($comment_content)) {

                        $query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";

                        $query .= "VALUES ($the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";


                        $create_comment_query = mysqli_query($connection, $query);

                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                        $update_comment_count = mysqli_query($connection, $query);
                        if (!$create_comment_query) {
                            die('QUERY FAILED' . mysqli_error($connection));
                        }
                    } else {


                        echo "<script> alert('Fields can not be empty')</script>";
                    }






                }






            } else {
                echo "<script> alert('You must register to comment')</script>";
            }

            ?>










            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="Author">Your Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>




            </div>

            <hr>

            <!-- Posted Comments -->

            <?php

            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id}";
            $query .= " AND comment_status = 'approve'";
            $query .= " ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);
            if (!$select_comment_query) {
                die('Query Failed' . mysqli_error($connection));

            }


            while ($row = mysqli_fetch_array($select_comment_query)) {

                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];


                echo "
                  
                  
                  <!-- Comment -->
                  <div class='media'>
                      <a class='pull-left' href='#'>
                          <img class='media-object' src='' alt='Image'>
                      </a>
                      <div class='media-body'>
                          <h4 class='media-heading'> $comment_author
                              <small> $comment_date </small>
                          </h4>
                          $comment_content
                      </div>
                  </div>
                  
                  
                  
                  
                  ";



            }

            ?>











            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"; ?>