<?php include "includes/header.php" ?>
<?php 

if(isset($_SESSION['username'])){

$username = $_SESSION['username'];
$query="SELECT * FROM users WHERE username = '$username'";
$select_user_profile_query=mysqli_query($connection,$query);
while($row=mysqli_fetch_array($select_user_profile_query)){


    
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
    $user_role = $row['user_role'];
    
}

}








?>








    <div id="wrapper">

   <?php include "navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $username ?></small>
                        </h1>





                        <form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="firstname">Firstname</label>
    <input type=" text" class="form-control" value="<?php echo $user_firstname ?>" name="firstname" id="firstname">
</div>
<div class="form-group">
    <label for="lastname">Lastname</label>
    <input type=" text" class="form-control" value="<?php echo $user_lastname ?>" name="lastname" id="lastname">
</div>
<div class="form-group">
    <label for="userRole">Role</label>
    <select name="userRole" id="userRole" class="form-control">
    <option name="userRole" value=''>Select Option</option>
    <option name="userRole" value='Subscriber'>Subscriber</option>
    <option name="userRole" value='Admin'>Admin</option>

    </select>
</div>
                        <div class="form-group">
    <label for="username">Username</label>
    <input type=" text" class="form-control" value="<?php echo $username ?>" name="username" id="username">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" value="<?php echo $user_email ?>" name="email" id="email">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" value="<?php echo $user_password ?>" name="password" id="password">
</div>

<div class="form-group">
    
    <input class="btn btn-primary" type="submit"  name="edit_user" value="Edit user">
</div>


</form>


<?php
if(isset($_POST['edit_user'])){

    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_role= $_POST['userRole'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashFormat="$2y$10$";
    $salt="secreatethingsaredangers";
    $hashF_and_salt = $hashFormat . $salt;
    $password=crypt($password,$hashF_and_salt);
    
   
       

 $query1 ="UPDATE users SET username='{$username}',user_password='{$password}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',
user_email='{$email}',user_role='{$user_role}'
 WHERE user_id={$user_id}";


   $update_user=
    mysqli_query($connection,$query1);
    confirm($update_user);
}

?>





   <?php include "includes/footer.php"?>