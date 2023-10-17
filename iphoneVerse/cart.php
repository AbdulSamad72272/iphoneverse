<?php
include("header.php");
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
?>
<div class="container">
<h1 class="mb-4 text-center">Your Cart</h1>
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
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
       $sub_total=0;
            foreach ($_SESSION['cart'] as $value) {
            ?>
                <tr>
                    <td><img style="width: 100px;" src="../adminpanel/img/<?php echo $value['image'] ?>" alt=""></td>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['color'] ?></td>
                    <td><?php echo $value['storage'] ?></td>
                    <td><?php echo $value['type'] ?></td>
                    <td><?php echo $value['price'] ?></td>
                    <td><?php echo $value['qty'] ?></td>
                    <td><?php echo $value['price'] * $value['qty'];
                    $total=$value['price']*$value['qty'];
                    $sub_total+=$total; 
                    ?></td>
                    <td class="column-5">
                        <a class="btn btn-danger" name="remove" href="?remove=<?php echo $value['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php
            }
            
        } else {
            ?>

<p style="margin: 10px; text-align:center">Your cartt is empty</p>
<?php
        }
?>
       
    </tbody>
</table>

<?php
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

    if (isset($_SESSION['city']) && $_SESSION['city'] == 'karachi') {
        $fee = 300;
    }else{
        $fee = 600;
    }
    

    ?>

<div style="background-color: lightgrey; margin-right: 20px; padding: 20px; border-radius: 10px" class="container mt-4 bg-secondary">
    <div class="row">
    <h3 style="margin-left: 10px;">Cart Total</h3>

        <div class="col-md-6">
       
            <!-- Left side: Subtotal, Shipping, and Total sections with a light gray background -->
            <div class="cart-summary">
                <ul class="cart-total-chart">
                    <p><span>Subtotal:</span> </p>
                    <p><span>Shipping:</span></p>
                    <p></p><span><strong>Total:</strong></span></span></p>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Right side: Total Price without a background -->
            <div class="cart-summary text-right">
               <p><span><?php echo $sub_total ?></span></p>
               <p><span><?php echo $fee * $cartcount = count($_SESSION['cart']); ?></span></p>
                <p><strong><?php echo $sub_total + $fee ?></strong></p>
            </div>
        </div>
    </div>
     <!-- Proceed to Checkout button with a red background -->
    <a style="margin-top: 10px;" href="checkout.php" class="primary-btn order-submit btn-block mt-5">Proceed to Checkout</a>

</div>


    <?php
}
?>

</div>


