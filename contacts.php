<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>
<?php
if (isset($_POST['contact'])) {



    $to = "yeabisrafantahun@gmail.com";
    $header = $_POST['header'];
    $subject = $_POST['subject'];
    $msg = $_POST['msg'];

    // the message
    // $msg = "First line of text\nSecond line of text";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email
    mail($to, $subject, $msg, $header);




} ?>
<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="header" id="email" class="form-control"
                                    placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="username" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="username" class="form-control"
                                    placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">

                                <textarea class="form-control" name="msg" id="body" cols="50" rows="10"></textarea>
                            </div>

                            <input type="submit" name="contact" id="btn-submit" class="btn btn-custom btn-lg btn-block"
                                value="Contact">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>


    <?php


    if (isset($_POST['registeration'])) {


        $username = $_POST['username'];
        // $post_image_temp = $_FILES['image']['tmp_name'];
        // $post_image = $_FILES['image']['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        if (!empty($username) && !empty($email) && !empty($password)) {

            $q = "SELECT randSalt FROM users";
            $select_q = mysqli_query($connection, $q);
            if (!$select_q) {
                die("Query Failed" . mysqli_error($connection));
            } else {
                $row = mysqli_fetch_array($select_q);
                $hashF_and_salt = $row['randSalt'];
                $password = crypt($password, $hashF_and_salt);

                // move_uploaded_file($post_image_temp,"../images/$post_image");
    
                $query = "INSERT INTO users(username,user_password,user_email,user_role)";

                $query .= "VALUES('{$username}','{$password}','{$email}','Subscriber')";

                $create_user_query = mysqli_query($connection, $query);
                confirm($create_user_query);

            }
        } else {
            echo "<script> alert('Fields can not be empty')</script>";
        }
    }

    ?>


















    <?php include "includes/footer.php"; ?>