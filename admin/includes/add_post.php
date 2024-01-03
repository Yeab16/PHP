<?php
if (isset($_POST['create_post'])) {


    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];

    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_image = $_FILES['image']['name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_comment_count = 4;
    $post_date = date('d-m-y');


    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status)";

    $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{0}','{$post_status}')";

    $create_post_query = mysqli_query($connection, $query);
    confirm($create_post_query);


}

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" id="title" />
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <select name="post_category_id" id="post_category_id" class="form-control">

            <?php

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirm($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option name='post_category_id' value='{$cat_id}'>{$cat_title}</option>";

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
                echo "<option name='post_author' value='{$user_id}'>{$username}</option>";

            }

            ?>
        </select>

    </div>







    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status" class="form-control">
            <option name='post_status' value='Drafts'>Drafts</option>
            <option name='post_status' value='Published'>Publish</option>

        </select>
    </div>


    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" id="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="post_tags">
    </div>
    <div class="form-group">
        <label for="body">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="body" cols="30" rows="10">


</textarea>
    </div>
    <div class="form-group">

        <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
    </div>


</form>