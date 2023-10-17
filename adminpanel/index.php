<?php
include("header.php");
if (!isset($_SESSION['id'])) {
    echo "<script>location.assign('signin.php')</script>";
}


$query = $pdo->query("select * from category");
$cat = $query->fetchAll(PDO::FETCH_ASSOC);
$count_cat = count($cat);

$query = $pdo->query("select * from products");
$pro = $query->fetchAll(PDO::FETCH_ASSOC);
$count_pro = count($pro);

$query = $pdo->query("select * from orders where status  = 'delivered'");
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
$count_ord = count($orders);

$query = $pdo->query("select * from orders where status  = 'pending'");
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
$count_pen_ord = count($orders);

$query = $pdo->query("select * from orders where status  = 'ready_to_ship'");
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
$count_rea_ord = count($orders);

$query = $pdo->query("select * from orders where status  = 'shiped'");
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
$count_shi_ord = count($orders);

$query = $pdo->query("select  sum(total) as total from orders where status  = 'delivered'");
$revn = $query->fetch(PDO::FETCH_ASSOC);
$rev = $revn['total'];

?>



<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line  fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Categories</p>
                    <h6 class="mb-0"><?php echo $count_cat; ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Products</p>
                    <h6 class="mb-0"><?php echo $count_pro;?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Sales</p>
                    <h6 class="mb-0"><?php echo $count_ord;?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0"><?php echo $count = $rev; ?></h6>
                </div>
            </div>
        </div>
         <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Pending Orders</p>
                    <h6 class="mb-0"><?php echo $count_pen_ord; ?></h6>
                </div>
            </div>
        </div>
         <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Ready orders</p>
                    <h6 class="mb-0"><?php echo $count_rea_ord; ?></h6>
                </div>
            </div>
        </div>
         <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Shiped Orders</p>
                    <h6 class="mb-0"><?php echo $count_shi_ord; ?></h6>
                </div>
            </div>
        </div>
         <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Delivered Orders</p>
                    <h6 class="mb-0"><?php echo $count_ord?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Sales Chart Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Top selling products</h6>
                 
                </div>
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale</th>
                        <th>Total Revenue</th>
                    </thead>
                    <tbody>
                                       
                                            
                                        
               
                            <?php
                            $query = $pdo->query("SELECT orders.id, orders.name,orders.price, orders.status, orders.image,  SUM(qty) as total_sold
			                FROM orders 
			                JOIN products ON orders.p_id = products.id
                            where orders.status  = 'delivered'
			                GROUP BY p_id
			                ORDER BY total_sold DESC limit 5");
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach ($result as $products) {
                                $revenu = $products['price']*$products['total_sold'];
                            ?>
                             <tr>
                            <td><?php echo  $products['name'] ?></td>
                            <td><?php echo  $products['price'] ?></td>
                            <td><?php echo  $products['total_sold'] ?></td>
                            <td><?php echo  $revenu ?></td>
                            </tr>
                                <?php
                            }
                                ?>
                               
                                    </tbody>

                                 </table>
                </div>
            </div>
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Letest Products</h6>
                        
                    </div>
                    <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Storage</th>
                        <th>Type</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                    <?php
                            $query = $pdo->query("select * from products order by id desc limit 10 ");
                            $products = $query->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach ($products as $letest_pro){
                            ?>
                             <tr>
                            <td><?php echo  $letest_pro['name'] ?></td>
                            <td><?php echo  $letest_pro['color'] ?></td>
                            <td><?php echo  $letest_pro['storage'] ?></td>
                            <td><?php echo  $letest_pro['type'] ?></td>
                            <td><?php echo  $letest_pro['price'] ?></td>
                            </tr>
                                <?php
                            }
                                ?>
                               
                                    </tbody>

                                 </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Chart End -->



    <?php
    include("footer.php");
    ?>