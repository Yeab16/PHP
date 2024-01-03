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

<?php 



if(isset($_GET['src'])){
    $source = $_GET['src'];
    }else{
    $source='';
    
}

switch($source){

    case 'add_user':
    include "includes/add_user.php";
    break;
    case 'edit_user':
        include "includes/edit_user.php";
    break;
    default:
    include "view_all_users.php";
    break;
    
}


?>


<?php

if(isset($_GET['delete'])){

    if(isset($_SESSION['user_role'])){
if($_SESSION['user_role']=='admin'){
    $user_id = mysqli_real_escape_string($connection,$_GET['delete']);
    $query="DELETE FROM users WHERE user_id = {$user_id}";
    $delete_query = mysqli_query($connection,$query);
    header("Location:user.php");
}

    }
  
   
}

?>
<?php

if(isset($_GET['admin'])){
 $the_id = $_GET['admin'];
    $query="UPDATE users SET user_role='Admin' WHERE user_id = {$the_id}";
    $admin_query = mysqli_query($connection,$query);
    header("Location:user.php");
}

?>
<?php

if(isset($_GET['subscriber'])){
 $the_id = $_GET['subscriber'];
    $query="UPDATE users SET user_role='Subscriber' WHERE user_id = {$the_id}";
    $subscriber_query = mysqli_query($connection,$query);
    header("Location:user.php");
}

?>





                        
                        </div>




                        
                    </div>
                </div>
                

            </div>
            

        </div>
       

   <?php include "includes/footer.php"?>