<?php

if (isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_categories = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_categories)) {

    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author_id = $row['post_author'];
    $post_user = $row['post_user'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];


}
?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" value="<?php echo $post_title ?>" name="post_title" />
    </div>
    <div class="form-group">
        <label for="post_category">Category</label>
        <select name="post_category" id="post_category" class="form-control">

            <?php

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirm($select_categories);


            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];


                if ($post_category_id === $cat_id) {
                    echo "<option name='post_author' value='{$post_category_id}' selected  hidden>{$cat_title}</option>";

                } else {
                    echo "<option name='post_author' value='{$cat_id}'>{$cat_title}</option>";
                }



            }


            ?>

        </select>
    </div>



    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select name="post_author" id="post_author" class="form-control">

            <?php

            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            confirm($select_users);

            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];


                if ($post_author_id === $user_id) {
                    echo "<option name='post_author' value='{$post_author_id}' selected  hidden>{$username}</option>";

                } else {
                    echo "<option name='post_author' value='{$user_id}'>{$username}</option>";
                }



            }

            ?>
        </select>

    </div>











    <!-- <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type=" text" class="form-control" value="<?php echo $post_author ?>" name="post_author">
</div> -->
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status" class="form-control">
            <option name='post_status' value='<?php $post_status ?>'><?php echo $post_status ?></option>
            <?php

            if ($post_status == "Drafts") {
                echo "<option name='post_status' value='Published'>Publish</option>
  ";
            } else {
                echo "<option name='post_status' value='Drafts'>Drafts</option>
        ";
            }

            ?>

        </select>
    </div>




    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image ?>" alt="">
        <input type="file" name="image">

    </div>




    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" value="<?php echo $post_tags ?>" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10">
    <?php echo $post_content ?>
</textarea>
    </div>
    <div class="form-group">

        <input class="btn btn-primary" type="submit" name="edit_post" value="Publish">
    </div>


</form>

<?php
if (isset($_POST['edit_post'])) {



    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_comment_count = 4;
    $post_date = date('d-m-y');
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_image_update = $_FILES['image']['name'];

    move_uploaded_file($post_image_temp, "../images/$post_image_update");




    $query1 = "UPDATE posts SET post_category_id={$post_category_id},post_title='{$post_title}',post_author='{$post_author}',
    post_date = now(),post_image='{$post_image_update}',post_content='{$post_content}',post_tags='{$post_tags}',
    post_status='{$post_status}' WHERE post_id={$the_post_id}";


    $update_post =
        mysqli_query($connection, $query1);
    confirm($update_post);
}

?>