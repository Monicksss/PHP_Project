<?php include('admin/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Category</h4>
            <a href="categories.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
         <?php alertMessage(); ?>

         <form action="code.php" method="POST">

         <?php 
         $parmValue = checkParamId('id');

         if(!is_numeric($parmValue)){
            echo '<h5>'.$parmValue.'</h5>';
            return false;
         }

         
         $category = getById('categories', $parmValue);

         if( $category['status'] == 200)
         {     

         ?>
         
         <input type="hidden" name="categoryId" value="<?= $category['data']['id']; ?>"/>

         <div class="row">
            <div class="col-md-12 mb-3">
              <input type="text" name="name" value="<?= $category['data']['name']; ?>"required class="form-control">
              <label for="">Name *</label>
            </div>

            <div class="col-md-12 mb-3">
              <label for="">Description</label>
              <textarea name="description" class="form-control" rows="3" <?= $category['data']['description']; ?>></textarea>
            </div>

            <div class="col-md-6">
                <label>Status(UnChecked=visible, Checked=Hidden)</label>
                <br>
                <input type="checkbox" name="status"<?= $category['data']['status'] == true ? 'checked':''; ?> style="width: 30px; height:30px;">
            </div>

            <div class="col-md-6 mb-3 text-end">
                <br>
              <button type="submit" name="updateCategory"class="btn btn-primary">Update</button>
            </div>

         </div>
         <?php
        }
        else{
              echo '<h5>'.$category['message'].'</h5>';
        }

        ?>
         </form>
    
    </div>

</div>


</div>



<?php include('admin/footer.php'); ?>