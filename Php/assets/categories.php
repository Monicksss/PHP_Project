<?php include('admin/header.php'); ?>

<div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Categories</h4>
                <a href="admins-create.php" class="btn btn-primary float-end">Add Admin</a>
            </div>
            <div class="card-body">

                <?php alertMessage();?>

                <?php
                 $categories = getAll('categories');
                
                 if(!$categories){
                   
                    echo '<h4> Something Went Wrong!</h4>';
                    return false;
                 }

                 if(mysqli_num_rows($categories)>0)
             {
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                            <?php foreach($categories as $item) :  ?>
                            <tr>
                                <td><?= $item['id']?> </td>
                                <td><?= $item['name']?> </td>
                                
                                <td>
                                    <?php 
                                    if($item['status'] == 1){
                                        echo '<span class="badge bg-danger">Hidden</span>';
                                    }else{
                                        echo '<span class="badge bg-primary">Visible</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="categories-edit.php?id=<?= $item['id']; ?>" class="btn btn-success">Edit</a>
                                    <a href="categories-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php
            }else{
            ?>
                <tr>
                <h4 class="mb-0">No Record found</h4>
                </tr>

                    <?php
                     }
                   ?>
                       
            </div>
        </div>                

                        
</div>


                            
<?php include('admin/footer.php');?>

