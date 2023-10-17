<?php
include("header.php");
?>


<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            Add Category
                        </button>
                        <div class="modal fade " id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container mt-2">
                                    <form method="post" enctype="multipart/form-data">
                                        
                                        <div class="mb-1">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Category name" required style="background-color: white;">
                                            <div class="invalid-feedback">
                                                Please provide a category name.
                                            </div>
                                        </div>

                                        <div class="mb-1">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                            <div class="invalid-feedback">
                                                Please upload an image.
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" name="add_category" class="btn btn-primary mt-3">Submit</button>
                                    </form>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
                                </div>
                                </div>
                            </div>
                            </div>

                            <h1 class="mb-4 text-center">Category</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">image</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query=$pdo->query("select * from category");
                                    $result=$query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($result as $data){
                                    ?>
                                     <tr>
                                        <th><?php echo $data['id']?></th>
                                        <th><?php echo $data['name']?></th>
                                        <th><img style="width: 100px;" src="img/<?php echo $data['image']?>" alt=""></th>
                                       
                                        <td>
                                            <!-- update button  -->
                                         
                                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#updateCategoryModal_<?php echo $data['id']?>">Update</button>
                                        
                                        <div class="modal fade" id="updateCategoryModal_<?php echo $data ['id']?>" tabindex="-1" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-secondary">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form update -->
                                                <form method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?php echo $data ['id']?>">
                                                <div class="mb-3">
                                                    <label for="updateCategoryName" class="form-label">Category Name</label>
                                                    <input type="text" class="form-control" id="updateCategoryName" name="name" require style="background-color: white;" value="<?php echo $data['name']?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="updateCategoryImage" class="form-label">Category Image</label>
                                                    <input type="file" class="form-control" name="image"  require>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="update_category">Save</button>
                                            </div>
                                                </form>
                                            </div>
                                            
                                            </div>
                                        </div>
                                        </div>

                                        <!-- delete button  -->
                                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal_<?php echo $data['id']?>">Delete</button>
                                    
                                        <div class="modal fade" id="deleteCategoryModal_<?php echo $data['id']?>" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-secondary">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCategoryModalLabel_<?php echo $data['id']?>">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this category?</p>
                                            </div>
                                            <div class="modal-footer">
                                               
                                                <form action="" method="post">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" name="category_delete">Delete</button>
                                                    <input type="hidden" name="id" value="<?php echo $data['id']?>">
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