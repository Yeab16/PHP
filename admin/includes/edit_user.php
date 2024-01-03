<?php  

if(isset($_GET['u_id'])){

    $the_user_id = $_GET['u_id'];
}
        
        $query="SELECT * FROM users WHERE user_id = $the_user_id";
        $select_user=mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_user)){
        
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];
            

        }
            ?>





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
    <option name="userRole" value='<?php $user_role ?>'><?php echo $user_role ?></option>
  
    <?php   
    
    if($user_role == "Admin"){
  echo "<option name='userRole' value='Subscriber'>Subscriber</option>
  ";
    }else{
        echo "<option name='post_status' value='Admin'>Admin</option>
        ";
    }
    
    ?>
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
  
    
        $q="SELECT randSalt FROM users";
        $select_q = mysqli_query($connection,$q);
        if(!$select_q){
          die("Query Failed".mysqli_error($connection));
        }else{
        $row=mysqli_fetch_array($select_q);
        $hashF_and_salt = $row['randSalt'];
      $password=crypt($password,$hashF_and_salt);}
       

 $query1 ="UPDATE users SET username='{$username}',user_password='{$password}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',
user_email='{$user_email}',user_role='{$user_role}'
 WHERE user_id={$the_user_id}";


   $update_user=
    mysqli_query($connection,$query1);
    confirm($update_user);
}

?>