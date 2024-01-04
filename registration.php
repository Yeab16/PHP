<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php
if (isset($_GET['lang']) && !empty($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];


    if (isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']) {

        echo "<script type='text/javascript'>loaction.reload();";
    }
    if (isset($_SESSION['lang'])) {

        include "includes/languages/" . $_SESSION['lang'] . ".php";
    } else {

        include "includes/languages/en.php";
    }
}




?>




<!-- Page Content -->
<div class="container">


    <form action="" class="navbar-form navbar-right" id="language_form">
        <div class="form-group">

            <select name="lang" class="form-control" onchange="changeLanguage()">
                <option value="en" <?php if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
                    echo "selected";
                } ?>>English</option>
                <option value="am" <?php if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'am') {
                    echo "selected";
                } ?>>Amharic</option>

            </select>
        </div>

    </form>

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1><?php echo _REGISTER ?></h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only"><?php echo _USERNAME ?></label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="<?php echo _USERNAME ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only"><?php echo _EMAIL ?></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="<?php echo _EMAIL ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only"><?php echo _PASSWORD ?></label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="<?php echo _PASSWORD ?>">
                            </div>

                            <input type="submit" name="registeration" id="btn-login"
                                class="btn btn-primary btn-lg btn-block" value="<?php echo _REGISTER ?>">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>
    <script>

        function changeLanguage() {
            document.getElementById('language_form').submit();
        }
    </script>



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