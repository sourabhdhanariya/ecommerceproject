<?php
include 'header.php';
include 'sidebar.php';
include 'Classes/transaction.php';
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">Transaction Management</h5>
                        <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                        <ul class="breadcrumb-title b-t-default p-t-10">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Transaction Management</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Page-header end -->
                <!-- Page-body start -->
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-3 float-right">
                                <select id="timeFilter" class="form-select tablesize" aria-label="Default select example" onchange="filterByTime(this)">
                                    <option value="all" selected>Filter by Time</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                    <option value="weekly">Weekly</option>
                                </select>
                            </div>


                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa-chevron-left"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-times close-card"></i></li>
                                </ul>
                            </div>

                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive tablesize ">
                                <table id="example" class="table data-table ">

                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Transaction ID</th>
                                            <th>Order ID</th>

                                            <th>Paid</th>
                                            <th>Created</th>
                                            <th>Method</th>

                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $obj = new Transaction();

                                        $obj->updateStatusOrder();

                                        $sql = $obj->selectorder();


                                        $selectedTime = isset($_GET['time']) ? $_GET['time'] : 'all';

                                        if ($selectedTime !== 'all') {
                                            if ($selectedTime === 'monthly') {
                                                $sql .= " AND DATE_FORMAT(`date`, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')";
                                            } elseif ($selectedTime === 'yearly') {
                                                $sql .= " AND YEAR(`date`) = YEAR(NOW())";
                                            } elseif ($selectedTime === 'weekly') {
                                                $sql .= " AND DATE_FORMAT(`date`, '%Y-%U') = DATE_FORMAT(NOW(), '%Y-%U')";
                                            }
                                        }

                                        $obj = new Database();
                                        $obj->sqlData($sql);
                                        $results = $obj->getResult();
                                        $counter = 1;

                                        if (!empty($results)) {
                                            foreach ($results as $row) {
                                                $transaction_id = $row['transaction_id'];
                                                $date = $row['date'];
                                                $id = $row['id'];
                                                $order_id = $row['order_id'];
                                                $status = $row['status'];
                                                $card_type = $row['card_type'];
                                                $price = $row['price'];
                                                $order_name = $row['order_name'];
                                        ?>
                                                <tr class="order-row" data-status="<?= $status ?>" data-order-date="<?= $date ?>">
                                                    <td><?= $counter ?></td>
                                                    <td> <?= $transaction_id ?> </td>
                                                    <td><a href="order.php"><?= $order_name ?></a>
                                                    </td>
                                                    <td><?= $price ?></td>
                                                    <td><?= $date ?></td>
                                                    <td><?= $card_type ?></td>
                                                    <td>
                                                        <form method="POST" action="transaction.php">
                                                            <input type="hidden" name="id" value="<?= $id ?>">
                                                            <select name="status" id="statusSelect" class="custom-select" onchange="this.form.submit()">
                                                                <option value="0" <?= $status == 0 ? 'selected' : '' ?>>Refunded</option>
                                                                <option value="1" <?= $status == 1 ? 'selected' : '' ?>>Completed</option>
                                                                <option value="2" <?= $status == 2 ? 'selected' : '' ?>>Refund Pending</option>
                                                            </select>

                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                                $counter++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4">No data found.</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <script src="./js/transaction.js"></script>
                    <?php include 'footer.php' ?>