<?php include "includes/header.php" ?>
<div id="wrapper">
    <?php



?>



    <?php include "navigation.php" ?>

    <div id="page-wrapper">


        <div class="container-fluid">


            <?php
            $query = "SELECT * FROM posts";
            $select_all_post = mysqli_query($connection, $query);
            $post_counts = mysqli_num_rows($select_all_post);



            ?>
            <?php
            $query = "SELECT * FROM comments";
            $select_all_comments = mysqli_query($connection, $query);
            $comment_counts = mysqli_num_rows($select_all_comments);



            ?>
            <?php
            $query = "SELECT * FROM users";
            $select_all_user = mysqli_query($connection, $query);
            $user_counts = mysqli_num_rows($select_all_user);



            ?>
            <?php
            $query = "SELECT * FROM categories";
            $select_all_category = mysqli_query($connection, $query);
            $cat_counts = mysqli_num_rows($select_all_category);



            ?>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $post_counts?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="post.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comment_counts ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $user_counts ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="user.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-list fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <div class='huge'><?php echo $cat_counts ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?PHP
            $query = "SELECT * FROM posts WHERE post_status='published'";
            $select_all_pubished_post = mysqli_query($connection, $query);
            $pubished_count = mysqli_num_rows($select_all_pubished_post);

            $query = "SELECT * FROM posts WHERE post_status='draft'";
            $select_all_draft_post = mysqli_query($connection, $query);
            $post_draft_count = mysqli_num_rows($select_all_draft_post);

            $query = "SELECT * FROM comments WHERE comment_status='unapproved'";
            $unapproved_comments_query = mysqli_query($connection, $query);
            $unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);

            $query = "SELECT * FROM users WHERE user_role='subscriber'";
            $select_all_subscribers = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($select_all_subscribers);




            ?>



            <div class="row">

                <script type="text/javascript">
                    google.charts.load('current', { 'packages': ['bar'] });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            $element_text = ['Active Posts', 'Published', 'Draft Post', 'Categories', 'Users', 'Comments', 'Pending', 'Subscribers'];
                            $element_count = [$post_counts, $pubished_count, $post_draft_count, $cat_counts, $user_counts, $comment_counts, $unapproved_comment_count, $subscriber_count];
                            for ($i = 0; $i < 8; $i++) {

                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }



                            ?>

                        ]);








                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </body>
            </div>












        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/footer.php" ?>