<?php
include("connection.php");
session_start();


// for signup 
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pass = $_POST['pass'];
    $c_pass = $_POST['c_pass'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $destination = "img/" . $image;
    $sec_pass=password_hash($pass,PASSWORD_BCRYPT);
   

    if ($image_size <= 48000000) {
        if ($image_extension == 'jpg' || $image_extension == 'jpeg' || $image_extension == 'png') {
           
            
                if (move_uploaded_file($image_tmp_name, $destination)) {
                    // Check for duplicate email
                    $emailCheckQuery = $pdo->prepare("select COUNT(*) from admin where email = :email");
                    $emailCheckQuery->bindParam(':email', $email);
                    $emailCheckQuery->execute();
    
                    if ($emailCheckQuery->fetchColumn() > 0) {
                        echo "<script>alert('Email address is already registered')</script>";
                    } else {
                     
if ($pass == $c_pass) {
    // Generate a unique activation token
    $token = bin2hex(random_bytes(15));

    $query = $pdo->prepare("insert into admin (name, email, mobile, pass, token, status, image) VALUES (:name, :email, :mobile, :pass, :token, 'inactive', :image)");
    $query->bindParam(':name', $name);
    $query->bindParam(':email', $email);
    $query->bindParam(':mobile', $mobile);
    $query->bindParam(':pass', $sec_pass);
    $query->bindParam(':token', $token);
    $query->bindParam(':image', $image);

    if ($query->execute()) {
        // Send an activation email
        $to_mail = $email;
        $subject = "Activate Your Account";
        $body = "Hi, $name. Click here to activate your account: http://localhost/project/adminpanel/activate.php?token=$token";
        $sender = "From: xgaming72272@gmail.com";

        if (mail($to_mail, $subject, $body, $sender)) {
            $_SESSION['msg'] = "Check your mail to activate your account $email";

            echo "<script>alert('Your are successfully registered. Check your email for activation instructions.');
            location.assign('index.php');</script>";
        } else {
            echo "Email sending failed...";
        }
    }
} else {
    echo "<script>alert('Passwords do not match')</script>";
}
                    }
                } else {
                    echo "<script>alert('Failed to move uploaded image')</script>";
                }
            }else {
                echo "<script>alert('Not a valid image extension')</script>";
            }
            
        } else {
            echo "<script>alert('File size is too large')</script>";
        }
    } 

// for signin
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $user_entered_pass = $_POST['pass']; // Password entered by the user

    $query = $pdo->prepare("select * FROM admin WHERE email = :email AND status='active'");
    $query->bindParam(':email', $email);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $hashed_pass = $result['pass']; 
        if (password_verify($user_entered_pass, $hashed_pass)) {
            // Passwords match
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['image'] = $result['image'];

                  echo "<script>alert('Login successful'); 
                location.assign('index.php');
                </script>";
            
            
        } else {
            echo "<script>alert('Invalid email or password');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
    
}


// Verify Email and Send Reset Link
if (isset($_POST['verify_email'])) {
    $email = $_POST['email'];
    $query = $pdo->prepare("SELECT COUNT(*) FROM admin WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();

    if ($query->fetchColumn() > 0) {
        $query = $pdo->prepare("SELECT name, token FROM admin WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $name = $result['name'];
            $token = $result['token'];

            // Send email to reset pass
            $to_mail = $email;
            $subject = "Reset Your Password";
            $reset_link = "http://localhost/project/adminpanel/reset_pass.php?token=$token"; // Include the token in the URL
            $body = "Hi, $name. Click here to reset your password: $reset_link";

            $sender = "From: xgaming72272@gmail.com";

            if (mail($to_mail, $subject, $body, $sender)) {
                $_SESSION['msg'] = "Check your email to reset your password: $email";
                header('location: signin.php');
            } else {
                echo "Email sending failed...";
            }
        } else {
            echo "<script>alert('Email not found');</script>";
        }
    }
}


// for forgot pass 
if (isset($_POST['update_pass'])) {
    
        $token = $_POST['token'];
    
        $newpass = $_POST['newpass'];
        $c_newpass = $_POST['c_newpass'];

        if ($newpass === $c_newpass) {
            // Hash the new password (you should hash it for security)
            $sec_newpass = password_hash($newpass, PASSWORD_BCRYPT);

            $query = $pdo->prepare("UPDATE admin SET pass = :pass WHERE token = :token");
            $query->bindParam(':pass', $sec_newpass);
            $query->bindParam(':token', $token);

            if ($query->execute()) {
                $_SESSION['msg'] = "Your password has been updated.";
                header('location: signin.php');
               
            } else {
                $_SESSION['passmsg'] = "Password not updated.";
            }
        } else {
            echo "<script>alert('Pass do not match');</script>";
        }
    } 

// for category add 

if(isset($_POST['add_category'])){
    $name=$_POST['name'];
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_extension=pathinfo($image, PATHINFO_EXTENSION);
    $destination="img/".$image;
    if($image_size<=48000000){
        if($image_extension=='jpg'|| $image_extension=='jped'|| $image_extension=='png'){
          if(move_uploaded_file($image_tmp_name,$destination)){
            $query=$pdo->prepare("insert into category(name, image) values(:name, :image)");
            $query->bindParam('name',$name);
            $query->bindParam('image',$image);
            $query->execute();
            echo "category added";
          }
        }else{
            echo "not valid extension";
        }

    }else{
        echo "file is greater";
    }
}

//  for category update 

if(isset($_POST['update_category'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_extension=pathinfo($image,PATHINFO_EXTENSION);
    $destination="img/".$image;

    if($image_size<=48000000){
        if($image_extension=="jpg" || $image_extension=="jpeg" || $image_extension=="png"){
            if(move_uploaded_file($image_tmp_name,$destination)){
    $query=$pdo->prepare("update category set name=:name, image=:image where id=:id");
    $query->bindParam('id',$id);
    $query->bindParam('name',$name);
    $query->bindParam('image',$image);
    $query->execute();
    echo "category update";
}
        }
    }
}

// for category delete 

if(isset($_POST['category_delete'])){
    $id=$_POST['id'];
    $query=$pdo->prepare("delete from category where id=:id");
    $query->bindParam('id',$id);
    $query->execute();
    echo "category deleted";
      
}


// for product add 

if(isset($_POST['add_product'])){
    $name=$_POST['name'];
    $color=$_POST['color'];
    $storage=$_POST['storage'];
    $type=$_POST['type'];
    $price=$_POST['price'];
    $s_disc=$_POST['s_disc'];
    $l_disc=$_POST['l_disc'];
    $c_id=$_POST['c_id'];
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_extension=pathinfo($image, PATHINFO_EXTENSION);
    $destination="img/".$image;
    if($image_size<=48000000){
        if($image_extension=='jpg'|| $image_extension=='jped'|| $image_extension=='png'){
          if(move_uploaded_file($image_tmp_name,$destination)){
            $query=$pdo->prepare("insert into products(name, color, storage, type, price, s_disc, l_disc, category_id, image) values(:name, :color, :storage, :type, :price, :s_disc, :l_disc, :c_id, :image)");
            $query->bindParam('name',$name);
            $query->bindParam('color',$color);
            $query->bindParam('storage',$storage);
            $query->bindParam('type',$type);
            $query->bindParam('price',$price);
            $query->bindParam('s_disc',$s_disc);
            $query->bindParam('l_disc',$l_disc);
            $query->bindParam('c_id',$c_id);
            $query->bindParam('image',$image);
            $query->execute();
            echo "product added";
          }
        }else{
            echo "not valid extension";
        }

    }else{
        echo "file is greater";
    }
}

//  for product update 

if(isset($_POST['update_product'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $color=$_POST['color'];
    $storage=$_POST['storage'];
    $type=$_POST['type'];
    $price=$_POST['price'];
    $c_id=$_POST['c_id'];
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_extension=pathinfo($image,PATHINFO_EXTENSION);
    $destination="img/".$image;

    if($image_size<=48000000){
        if($image_extension=="jpg" || $image_extension=="jpeg" || $image_extension=="png"){
            if(move_uploaded_file($image_tmp_name,$destination)){
    $query=$pdo->prepare("update products set name=:name, color=:color, storage=:storage, type=:type, price=:price, category_id=:c_id, image=:image where id=:id");
    $query->bindParam('id',$id);
    $query->bindParam('name',$name);
    $query->bindParam('color',$color);
    $query->bindParam('storage',$storage);
    $query->bindParam('type',$type);
    $query->bindParam('price',$price);
    $query->bindParam('c_id',$c_id);
    $query->bindParam('image',$image);
    $query->execute();
    echo "category update";
}
        }
    }
}

// for product delete 
if (isset($_POST['delete_product'])) {
        $id = $_POST['id'];
        $query = $pdo->prepare("delete from  products WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        echo "Product deleted";
}


// for status update 
if(isset($_POST['status_update'])){
    $status = $_POST['status'];
    $query = $pdo -> prepare("update orders set status = :status where id = :id");
    $query -> bindParam('id',$_GET['customerdetail']);
    $query -> bindParam('status',$status);
    $query -> execute();
    
    if (isset($_SESSION['pending']) && $_SESSION['pending'] === $_SERVER['REQUEST_URI']) {
        header("location: orders.php");
    } elseif (isset($_SESSION['ready_to_ship']) && $_SESSION['ready_to_ship'] === $_SERVER['REQUEST_URI']) {
        header("location: ready_to_ship.php");
    } elseif (isset($_SESSION['shipped']) && $_SESSION['shipped'] === $_SERVER['REQUEST_URI']) {
        header("location: shipped.php");
    } else {
        header("location: delivered.php");
    }
    
    
}
