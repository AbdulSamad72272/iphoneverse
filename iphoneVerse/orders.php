<?php
ob_start();
include("header.php");


if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $query = $pdo->prepare("select * from orders where u_id = :id ORDER BY id DESC");
    $query->bindParam('id', $_SESSION['id']);
    $query->execute();
    $orders = $query->fetchAll(PDO::FETCH_ASSOC);

    // $productPrice = 500; // Product price
    // $productWeight = 5.1;  // Product weight in kg
    // $customerCountry = "US"; // Customer's country
    
    // // Define shipping rates for different countries and weight ranges
    // $shippingRates = [
    //     'UK' => [
    //         ['min' => 0, 'max' => 1, 'price' => 200],
    //         ['min' => 1, 'max' => 5, 'price' => 300],
    //         ['min' => 5, 'max' => 10, 'price' => 400],
    //     ],
    //     'US' => [
    //         ['min' => 0, 'max' => 1, 'price' => 300],
    //         ['min' => 1, 'max' => 5, 'price' => 400],
    //         ['min' => 5, 'max' => 10, 'price' => 500],
    //     ],
    //     'Canada' => [
    //         ['min' => 0, 'max' => 1, 'price' => 400],
    //         ['min' => 1, 'max' => 5, 'price' => 500],
    //         ['min' => 5, 'max' => 10, 'price' => 600],
    //     ],
    //     // Add more countries and rates as needed
    // ];
    
    // // Calculate the correct shipping price
    // $shippingPrice = 0;
    
    // if (isset($shippingRates[$customerCountry])) {
    //     foreach ($shippingRates[$customerCountry] as $range) {
    //         if ($productWeight >= $range['min'] && $productWeight <= $range['max']) {
    //             $shippingPrice = $range['price'];
    //             break;
    //         }
    //     }
    
    //     if ($shippingPrice === 0) {
    //         // If the weight is not found in the defined ranges, set a default rate for weights over 10KG
    //         $shippingPrice = 800; // Set the default rate or modify as needed
    //     }
    // }
    
    // // Calculate subtotal and total price
    // $subtotal = $productPrice;
    // $total = $subtotal + $shippingPrice;
    
    // echo "Product Price: $" . $productPrice . "<br>";
    // echo "Shipping Price: $" . $shippingPrice . "<br>";
    // echo "Subtotal: $" . $subtotal . "<br>";
    // echo "Total: $" . $total;
    



//     $productPrice = 500; // Product price
//     $product_weight = 1;  // Product weight in kg
//     $country = "UK"; // Customer's country

// if ($country === 'UK') {
//     if ($product_weight <= 1) {
//         $shipping_cost = 200;
//     } elseif ($product_weight <= 5) {
//         $shipping_cost = 300;
//     } elseif ($product_weight <= 10) {
//         $shipping_cost = 400;
//     } else {
//         $shipping_cost = 0;
//     }
// } elseif ($country === 'US') {
//     if ($product_weight <= 1) {
//         $shipping_cost = 300;
//     } elseif ($product_weight <= 5) {
//         $shipping_cost = 400;
//     } elseif ($product_weight <= 10) {
//         $shipping_cost = 500;
//     } else {
//         $shipping_cost = 0;
//     }
// } elseif ($country === 'Canada') {
//     if ($product_weight <= 1) {
//         $shipping_cost = 400;
//     } elseif ($product_weight <= 5) {
//         $shipping_cost = 500;
//     } elseif ($product_weight <= 10) {
//         $shipping_cost = 600;
//     } else {
//         $shipping_cost = 0;
//     } 
// } else {
//     echo "Invalid country"; // Handle the case where the country is not one of the specified options.
// }

// // Output the shipping cost
//  // Calculate subtotal and total price
//     $subtotal = $productPrice;
//     $total = $subtotal + $shipping_cost;
    
//     echo "Product Price: $" . $productPrice . "<br>";
//     echo "Shipping Price: $" . $shipping_cost . "<br>";
//     echo "Subtotal: $" . $subtotal . "<br>";
//     echo "Total: $" . $total;

$userIP = $_SERVER['REMOTE_ADDR'];
echo "User's IP Address: " . $userIP;




    ?>



    <div class="container">
        
        <?php if (!empty($orders)) { ?>
            <h3 style="margin: 20px;" class="mb-4 text-center">Your Orders</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Color</th>
                        <th scope="col">Storage</th>
                        <th scope="col">Type</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $order) {
                        ?>
                        <tr>
                            <td><img style="width: 100px;" src="../adminpanel/img/<?php echo $order['image'] ?>" alt=""></td>
                            <td><?php echo $order['name'] ?></td>
                            <td><?php echo $order['color'] ?></td>
                            <td><?php echo $order['storage'] ?></td>
                            <td><?php echo $order['type'] ?></td>
                            <td><?php echo $order['price'] ?></td>
                            <td><?php echo $order['qty'] ?></td>
                            <td><?php echo $order['price'] * $order['qty']; ?></td>
                            <td><?php echo $order['status']?></td>
                           
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        
    </div>

<?php
}else { ?>
    <p style="margin: 10px; text-align:center">You don't have any order</p>
<?php 
} 
}
?>

