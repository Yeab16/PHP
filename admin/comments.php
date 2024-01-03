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



if (isset($_GET['allComments'])) { 
    $post_id=$_GET['allComments'];
    include "post_comments.php";

} else {
    include "view_all_comments.php";

}



?>





<?php

if(isset($_GET['delete'])){
    $comment_id = $_GET['delete'];
    $query="DELETE FROM comments WHERE comment_id = {$comment_id}";
    $delete_query = mysqli_query($connection,$query);
    header("Location:comments.php");
}

?>
<?php

if(isset($_GET['unapprove'])){
 $the_comment_id = $_GET['unapprove'];
    $query="UPDATE comments SET comment_status='unapprove' WHERE comment_id = {$the_comment_id}";
    $unapprove_comment_query = mysqli_query($connection,$query);
    header("Location:comments.php");
}

?>
<?php

if(isset($_GET['approve'])){
    
     $the_comment_id = $_GET['approve'];
     $query="UPDATE comments SET comment_status='approve' WHERE comment_id = {$the_comment_id}";
    $approve_comment_query = mysqli_query($connection,$query);
    header("Location:comments.php");
    
}

?>





                        
                        </div>




                        
                    </div>
                </div>
                

            </div>
            

        </div>
       

   <?php include "includes/footer.php"?>