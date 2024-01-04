<?php include "includes/header.php" ?>
<div id="wrapper">

    <?php include "navigation.php" ?>

    <div id="page-wrapper">


        <div class="container-fluid">

            <?php
            $role = $_SESSION['user_role'];

            if ($role == "Subscriber") {
                $user = $_SESSION['user_id'];
                $username = $_SESSION['username'];

                ?>
                <!-- /.row -->
                <div class="row">

                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-7 text-right">
                                        <div class='huge'><?php echo countwith('posts', 'post_author', $user);
                                        ?>
                                        </div>
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
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-7 text-right">
                                        <div class='huge'><?php echo countwith('comments', 'comment_author', $username); ?>
                                        </div>
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
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-7 text-right">
                                        <div class='huge'><?php echo countwith('posts', 'post_author', $user); ?></div>
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
                </div> <!-- /.row -->
                <?php

                $post_counts = countwith('posts', 'post_author', $user);
                $pubished_count = countwith4p('posts', 'post_status', 'Published', 'post_author', $user);
                $post_draft_count = countwith4p('posts', 'post_status', 'Drafts', 'post_author', $user);

                $cat_counts = countwith('posts', 'post_author', $user);


                $comment_counts = countwith('comments', 'comment_author', $username);
                $unapproved_comment_count = countwith4p('comments', 'comment_status', 'unapprove', 'comment_author', $user);







            } else {








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
                                        <div class='huge'><?php echo counts('posts'); ?></div>
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
                                        <div class='huge'><?php echo counts('comments'); ?></div>
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
                                        <div class='huge'><?php echo counts('users'); ?></div>
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
                                        <div class='huge'><?php echo counts('categories'); ?></div>
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
                </div> <!-- /.row -->








                <?php


                $post_counts = counts('posts');
                $pubished_count = countwith('posts', 'post_status', 'Published');
                $post_draft_count = countwith('posts', 'post_status', 'Drafts');

                $cat_counts = counts('categories');

                $user_counts = counts('users');
                $comment_counts = counts('comments');
                $unapproved_comment_count = countwith('comments', 'comment_status', 'unapprove');
                $subscriber_count = countwith('users', 'user_role', 'subscriber');





            } ?>
















            <?PHP






            ?>



            <div class="row">

                <script type="text/javascript">
                    google.charts.load('current', { 'packages': ['bar'] });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            if ($role == "Subscriber") {
                                $element_text = ['Active Posts', 'Published', 'Draft Post', 'Categories', 'Comments', 'Pending'];
                                $element_count = [$post_counts, $pubished_count, $post_draft_count, $cat_counts, $comment_counts, $unapproved_comment_count];
                            } else {
                                $element_text = ['Active Posts', 'Published', 'Draft Post', 'Categories', 'Users', 'Comments', 'Pending', 'Subscribers'];
                                $element_count = [$post_counts, $pubished_count, $post_draft_count, $cat_counts, $user_counts, $comment_counts, $unapproved_comment_count, $subscriber_count];

                            }

                            for ($i = 0; $i < count($element_text); $i++) {

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