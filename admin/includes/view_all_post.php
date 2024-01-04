<?php
if (isset($_POST['checkBoxArray'])) {

  foreach ($_POST['checkBoxArray'] as $postValueId) {
    $bulk_options = $_POST['bulk_options'];

    switch ($bulk_options) {

      case 'Published':

        $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id={$postValueId}";
        $update_post = mysqli_query($connection, $query);
        confirm($update_post);
        break;
      case 'Drafts':

        $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id={$postValueId}";
        $update_post = mysqli_query($connection, $query);
        confirm($update_post);
        break;

      case 'Delete':

        $query = "DELETE FROM posts WHERE post_id={$postValueId}";
        $delete_post = mysqli_query($connection, $query);
        confirm($delete_post);
        $delete_query_comment = "DELETE FROM comments WHERE comment_post_id = {$postValueId}";
        $delete_query_comments = mysqli_query($connection, $delete_query_comment);

        break;
      case 'Clone':

        $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
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
          $post_date = date('d-m-y');
          $post_content = $row['post_content'];

          $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status)";

          $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author_id}',now(),'{$post_image}','{$post_content}','{$post_tags}','{0}','{$post_status}')";

          $create_post_query = mysqli_query($connection, $query);
          confirm($create_post_query);
        }

        break;
    }





  }

}
?>

<form action="" method="post">
  <div class="table-responsive">
    <table class="table table-bordered table-hover ">

      <div id="bulkOptionContainer" class="col-xs-4">

        <select class="form-control" name="bulk_options" id="" class="form-control">
          <option value=''>Select Options</option>
          <option value='Drafts'>Drafts</option>
          <option value='Published'>Publish</option>
          <option value='Delete'>Delete</option>
          <option value='Clone'>Clone</option>

        </select>
      </div>

      <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="./post.php?src=add_post" class="btn btn-primary">Add New</a>
      </div>
</form>







<thead>
  <tr>
    <th><input id="selectAllBoxes" type="checkbox"></th>
    <th>Id</th>
    <th>Author</th>
    <th>Title</th>
    <th>Category</th>
    <th>Status</th>
    <th>Image</th>
    <th>Content</th>
    <th>Tags</th>
    <th>Comments</th>
    <th>Date</th>
    <th>Views</th>
    <th>View post</th>
    <th>Edit</th>
    <th>Delete</th>

  </tr>
</thead>
<tbody>

  <?php

  $role = $_SESSION['user_role'];

  if ($role == "Subscriber") {
    $user = $_SESSION['user_id'];


    $query = "SELECT * FROM posts where post_author = '{$user}'ORDER BY post_id Desc";
  } else {
    $query = "SELECT * FROM posts ORDER BY post_id Desc";
  }

  $select_post = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($select_post)) {

    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author_id = $row['post_author'];
    $post_user = $row['post_user'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];

    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
    $post_views = $row['post_views_count'];

    $query1 = "SELECT * FROM categories WHERE cat_id=$post_category_id";
    $select_categories = mysqli_query($connection, $query1);
    while ($row = mysqli_fetch_assoc($select_categories)) {

      $post_cat = $row['cat_title'];


    }

    $query_user = "SELECT * FROM users WHERE user_id=$post_author_id";
    $select_user = mysqli_query($connection, $query_user);
    while ($row = mysqli_fetch_assoc($select_user)) {

      $post_author = $row['username'];


    }
    $query_user = "SELECT * FROM comments WHERE comment_post_id=$post_id";
    $post_comment_count = mysqli_query($connection, $query_user);
    $count_comment = mysqli_num_rows($post_comment_count);



    echo "<tr>";
    echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value=$post_id></td>  ";
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_title</td>";

    echo "<td>$post_cat</td>";
    echo "<td>$post_status</td>";
    echo "<td><img class='img-responsive' src='../images/$post_image'  alt='image'></td>";
    echo "<td>$post_content</td>";
    echo "<td>$post_tags</td>";

    echo "<td><a href='comments.php?allComments={$post_id}'>$count_comment</a></td>";

    echo "<td class='mx-auto' style='width: 200px;'>$post_date</td>";
    echo "<td><a href='viewers.php?viewers={$post_id}'  >$post_views</a> </td>";
    echo "<td><a href='../post.php?p_id={$post_id}' class='btn btn-primary'>View Post</a></td>";
    echo "<td><a href='post.php?src=edit_post&p_id={$post_id}' class='btn btn-info'>Edit</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure to delete');\" href='post.php?delete={$post_id}' class='btn btn-danger'>Delete</a></td>";
    echo "</tr>";

  }


  ?>








</tbody>


</div>



</table>