<?php
include("header.php");

if(isset($_GET['customerdetail'])){
$query = $pdo -> query('select * from orders ');
    $result = $query -> fetch(PDO:: FETCH_ASSOC);
   
    $_SESSION['shiped'] = $_SERVER['REQUEST_URI'];
    


    ?>
    
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h1 class="mb-4 text-center">Shiped Orders</h1>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                            <th scope="col">U_id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>

                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $pdo->prepare("select * from orders where id = :id");
                        $query->bindParam('id', $_GET['customerdetail']);
                        $query->execute();
                        $result = $query->fetch(PDO::FETCH_ASSOC);
                        ?>
                           <tr>
                                <td><?php echo $result['id'] ?></td>
                                <td><?php echo $result['u_id'] ?></td>
                                <td><?php echo $result['first-name'] ?></td>
                                <th><?php echo $result['last-name'] ?></td>
                                <th><?php echo $result['email'] ?></td>
                                <td><?php echo $result['address'] ?></td>
                                <td><?php echo $result['city'] ?></td>
                                <td><?php echo $result['mobile'] ?></td>
                                <form action="" method="post">
                                <td>
                                    <select class="bg-light text-dark" name="status" id="">
                                        <option value="Pendding"><?php echo $result['status']?></option>
                                        <option value="Pending">Pending</option>
                                        <option value="ready_to_ship">Ready TO Ship</option>
                                        <option value="shiped">Shiped</option>
                                        <option value="delivered">Delivered</option>
                                        </select>
                                </td>
                                
                                <td><button type="submit" name="status_update" class="btn btn-primary">Update</button></td>

                                <!-- <td><a href="orders.php"><button type="button" class="btn btn-primary">Back</button></a></td> -->
                                </form>
                               
                            </tr>

                           

                        <?php
                        
                    
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->
    <?php

}else{
    ?>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h1 class="mb-4 text-center">Shiped Orders</h1>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">P_Id</th>
                            <!-- <th scope="col">Image</th> -->
                            <th scope="col">Name</th>
                            <th scope="col">Color</th>
                            <th scope="col">Storage</th>
                            <th scope="col">Type</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $pdo->query("select * from orders where status = 'shiped'");
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $order) {
                        ?>
                             <tr>
                                <td><?php echo $order['p_id'] ?></td>
                                <!-- <th><img style="width: 100px;" src="img/<?php echo $order['image'] ?>" alt=""></th> -->
                                <td><?php echo $order['name'] ?></td>
                                <th><?php echo $order['color'] ?></td>
                                <th><?php echo $order['storage'] ?></td>
                                <td><?php echo $order['type'] ?></td>
                                <td><?php echo $order['price'] ?></td>
                                <td><?php echo $order['qty'] ?></td>
                                <td><?php echo $order['total'] ?></td>
                                <td><?php echo $order['status'] ?></td>
                                <td><a href="?customerdetail=<?php echo $order['id']?>"><button type="button" class="btn btn-primary">Customer Detal</button></a></td>
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
<!-- Table End -->
    <?php
}


?>




<?php
include("footer.php");
?>