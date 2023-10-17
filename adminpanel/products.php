<?php
include("header.php");

?>

    <!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproductModal">
                    Add Product
                </button>

                <div class="modal fade " id="addproductModal" tabindex="-1" aria-labelledby="addproductModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addproductModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container mt-2">
                                    <form method="post" enctype="multipart/form-data">
                                   
                                        <div class="mb-1">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Product name" required style="background-color: white;">
                                        </div>

                                        <div class="mb-1">
                                            <label for="name" class="form-label">color</label>
                                            <input type="text" class="form-control" id="name" name="color" placeholder="product color" required style="background-color: white;">
                                        </div>

                                        <div class="mb-1">
                                            <label for="name" class="form-label">Storage</label>
                                            <input type="text" class="form-control" id="name" name="storage" placeholder="storage" required style="background-color: white;">
                                        </div>

                                        <div class="mb-1">
                                            <label for="name" class="form-label">type</label>
                                            <input type="text" class="form-control" id="name" name="type" placeholder="JV/FA" required style="background-color: white;">
                                        </div>

                                        <div class="mb-1">
                                            <label for="name" class="form-label">price</label>
                                            <input type="text" class="form-control" id="name" name="price" placeholder="price" required style="background-color: white;">
                                        </div>

                                        <div class="mb-1">
                                            <label for="name" class="form-label">Short discription</label>
                                            <input type="text" class="form-control" id="name" name="s_disc" placeholder="short discription" required style="background-color: white;">
                                        </div>

                                        <div class="mb-1">
                                            <label for="name" class="form-label">Long discription</label>
                                            <input type="text" class="form-control" id="name" name="l_disc" placeholder="long discription" required style="background-color: white;">
                                        </div>

                                        <div class="mb-1">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">category id</label>
                                            <select name="c_id" id="" class="form-control">
                                                <option value="">select category</option>
                                                <?php

                                                $query = $pdo->query("select * from category");
                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $product) {
                                                ?>
                                                    <option value="<?php echo $product['id'] ?>"><?php echo $product['name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="add_product">Add product</button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <h1 class="mb-4 text-center">Products</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Color</th>
                            <th scope="col">Storage</th>
                            <th scope="col">Type</th>
                            <th scope="col">price</th>
                            <th scope="col">Short Discription</th>
                            <th scope="col">Long Discription</th>
                            <th scope="col">Category id</th>
                            <th scope="col">image</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $pdo->query("select * from products ORDER BY id DESC");
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $product) {
                        ?>
                            <tr>
                                <th><?php echo $product['id'] ?></th>
                                <th><?php echo $product['name'] ?></th>
                                <th><?php echo $product['color'] ?></th>
                                <th><?php echo $product['storage'] ?></th>
                                <th><?php echo $product['type'] ?></th>
                                <th><?php echo $product['price'] ?></th>
                                <th><?php echo $product['s_disc'] ?></th>
                                <th><?php echo $product['l_disc'] ?></th>
                                <th><?php echo $product['category_id'] ?></th>
                                <th><img style="width: 100px;" src="img/<?php echo $product['image'] ?>" alt=""></th>

                                <td>
                                    <!-- update button  -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateproductModal_<?php echo $product['id'] ?>">Update</button>

                                    <div class="modal fade" id="updateproductModal_<?php echo $product['id'] ?>" tabindex="-1" aria-labelledby="updateproductModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-secondary">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateCategoryModalLabel_<?php echo $product['id'] ?>">Update Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- form update -->
                                                    <form method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?php echo $product['id']?>">
                                                   
                                                        <div class="mb-1">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Product name" required style="background-color: white;" value="<?php echo $product['name'] ?>">
                                                        </div>

                                                        <div class="mb-1">
                                                            <label for="name" class="form-label">color</label>
                                                            <input type="text" class="form-control" id="name" name="color" placeholder="product color" required style="background-color: white;" value="<?php echo $product['color'] ?>">
                                                        </div>

                                                        <div class="mb-1">
                                                            <label for="name" class="form-label">Storage</label>
                                                            <input type="text" class="form-control" id="name" name="storage" placeholder="storage" required style="background-color: white;" value="<?php echo $product['storage'] ?>">
                                                        </div>

                                                        <div class="mb-1">
                                                            <label for="name" class="form-label">type</label>
                                                            <input type="text" class="form-control" id="name" name="type" placeholder="JV/FA" required style="background-color: white;" value="<?php echo $product['type'] ?>">
                                                        </div>

                                                        <div class="mb-1">
                                                            <label for="name" class="form-label">price</label>
                                                            <input type="text" class="form-control" id="name" name="price" placeholder="price" required style="background-color: white;" value="<?php echo $product['price'] ?>">
                                                        </div>

                                                        <div class="mb-1">
                                            <label for="name" class="form-label">Short discription</label>
                                            <input type="text" class="form-control" id="name" name="s_disc" placeholder="short discription" required style="background-color: white;"
                                            value="<?php echo $product['s_disc'] ?>">
                                        </div>

                                        <div class="mb-1">
                                            <label for="name" class="form-label">Long discription</label>
                                            <input type="text" class="form-control" id="name" name="l_disc" placeholder="long discription" required style="background-color: white;"
                                            value="<?php echo $product['l_disc'] ?>">
                                        </div>

                                                        <div class="form-group">
                                                            <label for="">category id</label>
                                                            <select name="c_id" id="" class="form-control">
                                                                <option value="">select category</option>
                                                                <?php

                                                                $query = $pdo->query("select * from category");
                                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($result as $data) {
                                                                ?>
                                                                    <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-1">
                                                            <label for="image" class="form-label">Image</label>
                                                            <input type="file" class="form-control" id="image" name="image" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="update_product">Update</button>
                                                </div>
                                                   </form>

                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete button  -->
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteproductModal_<?php echo $product['id'] ?>" class="btn btn-primary">Delete</button>

                                    <div class="modal fade" id="deleteproductModal_<?php echo $product['id'] ?>" tabindex="-1" aria-labelledby="deleteproductModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-secondary">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteproductModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this category?</p>
                                                </div>
                                                <div class="modal-footer">
                                               
                                                <form action="" method="post">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" name="delete_product">Delete</button>
                                                    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                                                </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>



                                </td>


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
include("footer.php")
?>