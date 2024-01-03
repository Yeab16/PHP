


<div class="table-responsive">
<table class="table table-bordered table-hover w-20 ">
        <thead> <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response To</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        
        <?php   
        
        $query="SELECT * FROM comments";
        $select_post=mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_post)){
        
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
           
      
 echo "<tr>";
      echo"<td>$comment_id</td>";
          echo "<td>$comment_author</td>";
          echo "<td>$comment</td>";
  
    echo "<td>$comment_email</td>";
          echo "<td>$comment_status</td>";
          $query2="select * from posts WHERE post_id={$comment_post_id}";
          $cat=mysqli_query($connection,$query2);
           while($row1 = mysqli_fetch_assoc($cat)){
            $post_id = $row1['post_id'];
            $post_title = $row1['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";  
           }
         
         
          
          echo "<td> $comment_date</td>";
          echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
          echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
          echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
        echo "</tr>";
         
        }
        
        
        
        ?>
        
        
        
        
     
      


        </tbody>
        





</table>
    </div>