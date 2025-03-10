<?php include('admin/header.php'); ?>

<div class="container-fluid px-4">



    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Dashboard</h1>
            <?php alertMessage(); ?>
        </div>


        <div class="col-md-3 mb-3">
            <div class="card card-body bg-primary p-3">
                <p class="text-sm mb-0 text-capitalize ">Total Category</p>
                <h5 class="fw-bold mb-0">
                    <?= getcount('categories');  ?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-warning p-3">
                <p class="text-sm mb-0 text-capitalize ">Total Products</p>
                <h5 class="fw-bold mb-0">
                    <?= getcount('products');  ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body bg-info p-3">
                <p class="text-sm mb-0 text-capitalize ">Total Admins</p>
                <h5 class="fw-bold mb-0">
                    <?= getcount('admins');  ?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize ">Total Customers</p>
                <h5 class="fw-bold mb-0">
                    <?= getcount('customers');  ?>
                </h5>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <hr>
            <h5>Orders</h5>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize ">Today Orders</p>
                <h5 class="fw-bold mb-0">
                    <?php 
                       $todayDate = date('Y-m-d');
                       $todayOrders = mysqli_query($conn,"SELECT * FROM orders WHERE order_date='$todayDate' ");

                       if($todayOrders){
                        if(mysqli_num_rows($todayOrders) > 0){
                            $totalCountOrders = mysqli_num_rows($todayOrders);
                            echo $totalCountOrders;

                        }else{
                            echo '0';
                        }

                       }else{
                         echo "Something Went Wrong!";
                       }

                    ?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize ">Total Orders</p>
                <h5 class="fw-bold mb-0">
                    <?= getcount('orders');  ?>
                </h5>
            </div>
        </div>

    </div>
</div>



<?php include('admin/footer.php'); ?>