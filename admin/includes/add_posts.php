<?php 
if(isset($_POST['create_post'])) {
  $post_title = $_POST['post_title'];
  $post_author = $_POST['post_author'];
  
  $post_category_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['name'];
  $post_tags =  $_POST['post_tags'];
  // $post_comment_count = 4;
  $post_date = date('d-m-y');
  $post_content = $_POST['post_content'];

  move_uploaded_file($post_image_temp, "../images/$post_image");



  $query = "INSERT INTO posts(post_category_id, 
                              post_title, 
                              post_author, 
                              post_date, 
                              post_image, 
                              post_content, 
                              post_tags, 
                             
                              post_status)";



$query .= "VALUES ({$post_category_id},
                   '{$post_title}',
                   '{$post_author}',
                    now(),
                   '{$post_image}',
                   '{$post_content}',
                   '{$post_tags}',
                  
                   '{$post_status}')";

    $create_post_query = mysqli_query($connection, $query);


    if(!$create_post_query) {
      die("QUERY FAILED" . mysqli_error($connection));
    }

    $the_post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success'> Post Updated. <a href='../post.php?p_id={$the_post_id}'> View Post</a> <a href='../post.php'> Edit More Post</a> </p>";
}




?>





<form action="" method="post" enctype="multipart/form-data">

    <div class="field">
        <label class="label" for="">Post Title</label>
        <div class="control">
            <input class="input" name="post_title" type="text">
        </div>

    </div>
    <!-- 

<div class="form-group">
  <label for="">Post Category </label>
    <input class="form-control" name="post_category_id" type="text">
</div> -->

    <div class="field">
        <div class="control">
            <div class="select">
                <select name="post_category" id="post_category">
                    <?php 
        
        $query = "SELECT * FROM categories ";
        $select_categories = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_categories)) {
                              $cat_id = $row['category_id'];
                              $cat_title = $row['category_title'];

                                echo "<option value='{$cat_id}'>{$cat_title}</option>";
                        }
        
        ?>
                    <option value='0'>Seleccione</option>
                </select>
            </div>
        </div>

    </div>


    <div class="field">
        <label class="label" for="">Post Author</label>
        <div class="control">
            <input class="input" name="post_author" type="text">
        </div>
    </div>


    <div class="field">
        <label class="label" for="">Post Status</label>
        <div class="select">
            <div class="control">
                <select name="post_status" id="">
                    <option value=""> Select Status </option>
                    <option value="draft"> Draft </option>
                    <option value="published"> Publish </option>
                </select>
            </div>
        </div>
    </div>


    <div class="file">
        <label class="file-label">
            <input class="file-input" type="file" name="image">
            <span class="file-cta">
            <span class="file-icon">
                <i class="fas fa-upload"></i>
            </span>
            <span class="file-label">
                Cargar Imagen...
            </span>
            </span>
        </label>
    </div>


    <div class="field">
        <label class="label" for="post_tags">Post Tags</label>
        <div class="control">
            <input class="input" name="post_tags" type="text">
        </div>
    </div>

    <div class="field">
        <label class="label" for="">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"></textarea>
    </div>

    <div class="control">
        <input class="button is-link" type="submit" name="create_post" value="Publish Post">
    </div>

</form>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>