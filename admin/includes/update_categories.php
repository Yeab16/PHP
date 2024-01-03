
<form action="" method="post">                     
<div class="form-group">
<label for="cat-title">Edit Category</label>
<input type="text" class="form-control" name="cat_title">
</div>
<div class="form-group">
  <input class="btn btn-primary" type="submit" name="update_category" value="update"/>
</form>



<?php
if(isset($_POST['update_category'])){


    $the_cat_title=$_POST['cat_title'];
    $queryU="UPDATE categories SET cat_title='{$the_cat_title}' WHERE cat_id={$cat_id}";
    mysqli_query($connection,$queryU);
}

?>