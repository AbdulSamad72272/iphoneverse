<?php
ob_start();
include("header.php");

if (!isset($_SESSION['id'])) {
    echo "<script>alert('You have to login first ');
    location.assign('signin.php');
    </script>";
    $_SESSION['back_to_wishlist_url'] = $_SERVER['REQUEST_URI'];
}

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $query = $pdo->prepare("select * from wishlist where u_id = :id");
    $query->bindParam('id', $_SESSION['id']);
    $query->execute();
    $whishlist = $query->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="container">
        
        <?php if (!empty($whishlist)) { ?>
            <h3 style="margin: 20px;" class="mb-4 text-center">Your wishlist</h3>
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
                    foreach ($whishlist as $wish) {
                        ?>
                        <tr>
                            <td><img style="width: 100px;" src="../adminpanel/img/<?php echo $wish['image'] ?>" alt=""></td>
                            <td><?php echo $wish['name'] ?></td>
                            <td><?php echo $wish['color'] ?></td>
                            <td><?php echo $wish['storage'] ?></td>
                            <td><?php echo $wish['type'] ?></td>
                            <td><?php echo $wish['price'] ?></td>
                            <td><?php echo $wish['qty'] ?></td>
                            <td><?php echo $wish['price'] * $wish['qty']; ?></td>
                            <td class="column-5">
                                <a class="btn btn-danger" href="?delete_wishlist=<?php echo $wish['id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        
    </div>

<?php
}else { ?>
    <p style="margin: 10px; text-align:center">Your wishlist is empty</p>
<?php 
} 
}
?>

