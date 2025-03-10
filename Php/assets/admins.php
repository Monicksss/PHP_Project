<?php include('admin/header.php'); ?>

<div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Admins/Staff</h4>
                <a href="admins-create.php" class="btn btn-primary float-end">Add Admin</a>
            </div>
            <div class="card-body">
                <?php alertMessage();?>

                <?php
                 $admins = getAll('admins');
                
                 if(!$admins){
                   
                    echo '<h4> Something Went Wrong!</h4>';
                    return false;
                 }

                 if(mysqli_num_rows($admins)>0)
             {
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                            <?php foreach($admins as $adminItem) :  ?>
                            <tr>
                                <td><?= $adminItem['id']?> </td>
                                <td><?= $adminItem['name']?> </td>
                                <td><?= $adminItem['email']?> </td>
                                <td>
                                    <a href="admins-edit.php?id=<?= $adminItem['id']; ?>" class="btn btn-success">Edit</a>
                                    <a href="admins-delete.php?id=<?= $adminItem['id']; ?>" class="btn btn-danger">Delete</a>
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

