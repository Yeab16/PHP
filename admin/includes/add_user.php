<?php 
if(isset($_POST['create_user'])){


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$user_role= $_POST['userRole'];
$username = $_POST['username'];
// $post_image_temp = $_FILES['image']['tmp_name'];
// $post_image = $_FILES['image']['name'];
$email = $_POST['email'];
$password = $_POST['password'];


$q="SELECT randSalt FROM users";
      $select_q = mysqli_query($connection,$q);
      if(!$select_q){
        die("Query Failed".mysqli_error($connection));
      }else{
      $row=mysqli_fetch_array($select_q);
      $hashF_and_salt = $row['randSalt'];
    $password=crypt($password,$hashF_and_salt);



// move_uploaded_file($post_image_temp,"../images/$post_image");

$query ="INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_role)";

$query.="VALUES('{$username}','{$password }','{$firstname}','{$lastname}','{$email}','{$user_role}')";

$create_user_query = mysqli_query($connection,$query);
confirm($create_user_query);

      }
}

?>
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="firstname">Firstname</label>
    <input type=" text" class="form-control" name="firstname" id="firstname">
</div>
<div class="form-group">
    <label for="lastname">Lastname</label>
    <input type=" text" class="form-control" name="lastname" id="lastname">
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
    <input type=" text" class="form-control" name="username" id="username">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password">
</div>

<div class="form-group">
    
    <input class="btn btn-primary" type="submit"  name="create_user" value="Add user">
</div>


</form>
