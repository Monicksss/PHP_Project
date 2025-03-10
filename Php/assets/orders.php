<?php include('admin/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-0">Orders</h4>
                </div>
                <div class="col-md-8">
                    <form action="" method="GET">
                        <div class="row g-1">
                            <div class="col-md-4">
                                <input type="date" 
                                    name="date" 
                                    class="form-control"
                                    value="<?= isset($_GET['date']) ? htmlspecialchars($_GET['date']) : ''; ?>"
                                />
                            </div>
                            <div class="col-md-4">
                                <select name="payment_status" class="form-select">
                                    <option value="">Select Payment Status</option>
                                    <option value="Cash Payment" <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'Cash Payment' ? 'selected' : ''; ?>>Cash Payment</option>
                                    <option value="Online Payment" <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'Online Payment' ? 'selected' : ''; ?>>Online Payment</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="orders.php" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php
            // Pagination setup
            $limit = 5; // Number of records per page
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $offset = ($page - 1) * $limit;

            // Filters
            $orderDate = isset($_GET['date']) ? validate($_GET['date']) : '';
            $paymentStatus = isset($_GET['payment_status']) ? validate($_GET['payment_status']) : '';

            // Base query
            $baseQuery = "SELECT o.*, c.* FROM orders o JOIN customers c ON c.id = o.customer_id";
            $conditions = [];

            if ($orderDate) {
                $conditions[] = "o.order_date='$orderDate'";
            }
            if ($paymentStatus) {
                $conditions[] = "o.payment_mode='$paymentStatus'";
            }
            if (!empty($conditions)) {
                $baseQuery .= " WHERE " . implode(" AND ", $conditions);
            }
            $baseQuery .= " ORDER BY o.id DESC";

            // Count total records
            $countQuery = $baseQuery;
            $countQuery = preg_replace("/SELECT o\.\*, c\.\* FROM/", "SELECT COUNT(*) as total FROM", $countQuery);
            $countResult = mysqli_query($conn, $countQuery);
            $totalRecords = mysqli_fetch_assoc($countResult)['total'];
            $totalPages = ceil($totalRecords / $limit);

            // Final query with pagination
            $query = $baseQuery . " LIMIT $limit OFFSET $offset";
            $orders = mysqli_query($conn, $query);

            if ($orders) {
                if (mysqli_num_rows($orders) > 0) {
                    ?>
                    <table class="table table-striped table-bordered align-items-center justify-content">
                        <thead>
                            <tr>
                                <th>Tracking No.</th>
                                <th>C Name</th>
                                <th>C Phone</th>
                                <th>Order Date</th>
                                <th>Order Status</th> 
                                <th>Payment Mode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $orderItem) : ?>
                                <tr>
                                    <td class="fw-bold"><?= htmlspecialchars($orderItem['tracking_no']) ?></td>
                                    <td><?= htmlspecialchars($orderItem['name']); ?></td>
                                    <td><?= htmlspecialchars($orderItem['phone']); ?></td>
                                    <td><?= date('d M, Y', strtotime($orderItem['order_date'])) ?></td>
                                    <td><?= htmlspecialchars($orderItem['order_status']); ?></td>
                                    <td><?= htmlspecialchars($orderItem['payment_mode']); ?></td>
                                    <td>
                                        <a href="orders-view.php?track=<?= urlencode($orderItem['tracking_no']); ?>" class="btn btn-info mb-0 px-2 btn-sm">view</a>
                                        <a href="orders-view-print.php?track=<?= urlencode($orderItem['tracking_no']); ?>" class="btn btn-primary mb-0 px-2 btn-sm">Print</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>    
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo '<h5>No Record Available</h5>';
                }
            } else {
                echo "<h5>Something Went Wrong</h5>";
            }
            ?>

            <!-- Pagination links -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php include('admin/footer.php'); ?>
