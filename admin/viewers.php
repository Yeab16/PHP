<?php include "includes/header.php" ?>

<div id="wrapper">

    <?php include "navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>



                    <?php if (isset($_GET['viewers'])) {
                        $post_id = $_GET['viewers'];
                        ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Total view</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
 $times=0;
                                    $Vquery = "SELECT * FROM  viewersid where post_id =  $post_id";
                                    $view_user = mysqli_query($connection, $Vquery);
                                    while ($row = mysqli_fetch_assoc($view_user)) {


$times=$times+1;}

                                    $Vquery = "SELECT DISTINCT v_id FROM  viewersid where post_id =  $post_id";
                                    $view_user = mysqli_query($connection, $Vquery);
                                    while ($row = mysqli_fetch_assoc($view_user)) {
                                        $u_id = $row['v_id'];

      

                //     $query = "SELECT * FROM viewersid WHERE post_id = $post_id && v_id = $u_id";
                // $select_all_posts_query = mysqli_query($connection, $query);
                // while ($row = mysqli_fetch_assoc($select_all_posts_query)){
                //     $times=count($row);
                // }



                                        


                                        $query = "SELECT * FROM users where user_id =  $u_id";
                                        $select_user = mysqli_query($connection, $query);
                                       
                                        while ($row = mysqli_fetch_assoc($select_user)) {
                                                   
                                            $user_id = $row['user_id'];
                                            $username = $row['username'];
                                            $user_firstname = $row['user_firstname'];
                                            $user_lastname = $row['user_lastname'];
                                            $user_email = $row['user_email'];
                                            $user_image = $row['user_image'];
                                            $user_role = $row['user_role'];
                                            $user_views_count = $row['user_views_count'];
                                            
                                            


                                            echo "<tr>";
                                            echo "<td> $user_id</td>";
                                            echo "<td>$username</td>";
                                            echo "<td>$user_firstname </td>";
                                            echo "<td>$user_lastname</td>";
                                            echo "<td>$user_email</td>";

                                            echo "<td>$user_role</td>";
                                            echo "<td>$user_views_count</td>";
                                            echo "<td><a href='user.php?admin={$user_id}'>Admin</a></td>";
                                            echo "<td><a href='user.php?subscriber={$user_id}'>Subscriber</a></td>";
                                            echo "<td><a href='user.php?src=edit_user&u_id={$user_id}'>Edit</a></td>";
                                            echo "<td><a onClick=\"javascript: return confirm('Are you sure to delete');\" href='user.php?delete={$user_id}'>Delete</a></td>";
                                            echo "</tr>";

                                        }
                                    
                                }

                                    ?>








                                </tbody>






                            </table>
                        </div>
                    </div>
                </div>





                <?php




                    } else {
                    }

                    ?>