<?php
include("connection.php");
session_start();


//Include required PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// for signup 
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $pass = $_POST['pass'];
    $c_pass = $_POST['c_pass'];
    // $image = $_FILES['image']['name'];
    // $image_size = $_FILES['image']['size'];
    // $image_tmp_name = $_FILES['image']['tmp_name'];
    // $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    // $destination = "img/" . $image;
    $sec_pass = password_hash($pass, PASSWORD_BCRYPT);


    // if ($image_size <= 48000000) {
    //     if ($image_extension == 'jpg' || $image_extension == 'jpeg' || $image_extension == 'png') {


    // if (move_uploaded_file($image_tmp_name, $destination)) {
    // Check for duplicate email
    $emailCheckQuery = $pdo->prepare("select COUNT(*) from users where email = :email");
    $emailCheckQuery->bindParam(':email', $email);
    $emailCheckQuery->execute();

    if ($emailCheckQuery->fetchColumn() > 0) {
        echo "<script>alert('Email address is already registered')</script>";
    } else {

        if ($pass == $c_pass) {
            // Generate a unique activation token
            $token = bin2hex(random_bytes(15));

            $query = $pdo->prepare("insert into users (name, email, mobile, city, pass, token, status) VALUES (:name, :email, :mobile, :city, :pass, :token, 'inactive')");
            $query->bindParam(':name', $name);
            $query->bindParam(':email', $email);
            $query->bindParam(':mobile', $mobile);
            $query->bindParam(':city', $city);
            $query->bindParam(':pass', $sec_pass);
            $query->bindParam(':token', $token);



            if ($query->execute()) {

                //Create instance of PHPMailer
                $mail = new PHPMailer(true);
                //Set mailer to use smtp
                $mail->isSMTP();
                //Define smtp host
                $mail->Host = "smtp.gmail.com";
                //Enable smtp authentication
                $mail->SMTPAuth = true;
                //Set smtp encryption type (ssl/tls)
                $mail->SMTPSecure = "tls";
                //Port to connect smtp
                $mail->Port = "587";
                //Set gmail username
                $mail->Username = "xgaming72272@gmail.com";
                //Set gmail password
                $mail->Password = "ueob jeuj jhiy rfin";
                //Email subject
                $mail->Subject = "Activate Your Account";
                //Set sender email
                $mail->setFrom('xgaming72272@gmail.com');
                //Enable HTML
                $mail->isHTML(true);
                //Email body
                $mail->Body = "Hi, $name. click here to activate your account
                             http://localhost/project/iphoneverse/activate.php?token=$token";
                
                //Add recipient
                $mail->addAddress($email);
                //Finally send email
                if ($mail->send()) {
                    $_SESSION['msg']="check your mail to activate your account $email";
                    echo "<script>alert('You are  successfully registered. Check your email for activation instructions.');location.assign('signin.php');</script>";
                }
                //Closing smtp connection
                $mail->smtpClose();

                //   $to_mail=$email;
                //   $subject = "Activate Your Account";
                //   $body = "Hi, $name. click here to activate your account
                //    http://localhost/project/iphoneverse/activate.php?token=$token";
                //   $sender = "From: xgaming72272@gmail.com";

                //   if (mail($to_mail, $subject, $body, $sender)) {
                //      $_SESSION['msg']="check your mail to activate your account $email";

                //      echo "<script>alert('You are  successfully registered. Check your email for activation instructions.');
                //      location.assign('signin.php');</script>";
                //   } else {
                //       echo "Email sending failed...";
                //   }
            }
        } else {
            echo "<script>alert('Passwords do not match')</script>";
        }
    }
}
// }else {
//     echo "<script>alert('Not a valid image extension')</script>";
// }
//     }else {
//         echo "<script>alert('File size is too large')</script>";
//     }
// }


// for signin
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $user_entered_pass = $_POST['pass'];

    $query = $pdo->prepare("select * FROM users WHERE email = :email AND status='active'");
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
            $_SESSION['city'] = $result['city'];
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

    if (isset($_SESSION['back_to_review_url'])) {
        header("Location: " . $_SESSION['back_to_review_url']);
    } elseif (isset($_SESSION['back_to_checkout_url'])) {
        header("Location: " . $_SESSION['back_to_checkout_url']);
    } elseif (isset($_SESSION['back_to_wishlist_url'])) {
        header("Location: " . $_SESSION['back_to_wishlist_url']);
    }
}

// Verify Email and Send Reset Link
if (isset($_POST['verify_email'])) {
    $email = $_POST['email'];
    $query = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();

    if ($query->fetchColumn() > 0) {
        $query = $pdo->prepare("SELECT name, token FROM users WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $name = $result['name'];
            $token = $result['token'];


            //Create instance of PHPMailer
            $mail = new PHPMailer(true);
            //Set mailer to use smtp
            $mail->isSMTP();
            //Define smtp host
            $mail->Host = "smtp.gmail.com";
            //Enable smtp authentication
            $mail->SMTPAuth = true;
            //Set smtp encryption type (ssl/tls)
            $mail->SMTPSecure = "tls";
            //Port to connect smtp
            $mail->Port = "587";
            //Set gmail username
            $mail->Username = "xgaming72272@gmail.com";
            //Set gmail password
            $mail->Password = "ueob jeuj jhiy rfin";
            //Email subject
            $mail->Subject = "Reset Your Password";
            //Set sender email
            $mail->setFrom('xgaming72272@gmail.com');
            //Enable HTML
            $mail->isHTML(true);
            //Email body
            $mail->Body = "Hi, $name. Click here to reset your password
        http://localhost/project/iphoneverse/reset_pass.php?token=$token";
            //Add recipient
            $mail->addAddress($email);
            //Finally send email
            if ($mail->send()) {
                $_SESSION['msg'] = "Check your email to reset your password: $email";
                header('location: signin.php');
            }
            //Closing smtp connection
            $mail->smtpClose();

            // // Send email to reset pass
            // $to_mail = $email;
            // $subject = "Reset Your Password";
            // $reset_link = "http://localhost/project/iphoneverse/reset_pass.php?token=$token"; 
            // $body = "Hi, $name. Click here to reset your password: $reset_link";

            // $sender = "From: xgaming72272@gmail.com";

            // if (mail($to_mail, $subject, $body, $sender)) {
            //     $_SESSION['msg'] = "Check your email to reset your password: $email";
            //     header('location: signin.php');
            // } else {
            //     echo "Email sending failed...";
            // }
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
        $sec_newpass = password_hash($newpass, PASSWORD_BCRYPT);

        $query = $pdo->prepare("UPDATE users SET pass = :pass WHERE token = :token");
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

// for add to cart 
if (isset($_POST['addtocart'])) {
    if(isset($_SESSION['id'])){
    if (isset($_SESSION['cart'])) {

        // for duplication
        $productid = array_column($_SESSION['cart'], 'id');
        if (in_array($_POST['id'], $productid)) {
            echo "<script>
			alert('product already added into the cart');
			location.assign('index.php');
			</script>";
        } else {


            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count] = array(
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'color' => $_POST['color'],
                'storage' => $_POST['storage'],
                'type' => $_POST['type'],
                'price' => $_POST['price'],
                'image' => $_POST['image'],
                'qty' => $_POST['qty'],
            );

            echo "<script>
		alert('product added into cart')
		location.assign('index.php')
		</script>";
        }
    } else {
        $_SESSION['cart'][0] = array(
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'color' => $_POST['color'],
            'storage' => $_POST['storage'],
            'type' => $_POST['type'],
            'price' => $_POST['price'],
            'image' => $_POST['image'],
            'qty' => $_POST['qty'],
        );

        echo "<script>
		alert('product added into cart')
		location.assign('cart.php')
		</script>";
    }
}else{
    echo "<script>
		alert('You must be logged in to add items to your cart')
		location.assign('index.php')
		</script>";
}
}

// for card product remove 
if (isset($_GET['remove'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($_GET['remove'] == $value['id']) {
            unset($_SESSION['cart'][$key]);
            // reset array 
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            echo "<script>alert('product remove successfully')
			location.assign('cart.php')</script>";
        }
    }
}


// for checkout 
if (isset($_POST['order'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $p_id = $value['id'];
        $image = $value['image'];
        $name = $value['name'];
        $color = $value['color'];
        $storage = $value['storage'];
        $type = $value['type'];
        $price = $value['price'];
        $qty = $value['qty'];
        $total = $qty * $price;
        $u_id = $_SESSION['id'];
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zipcode = $_POST['zip-code'];
        $mobile = $_POST['mobile'];

        $query = $pdo->prepare("INSERT INTO orders (u_id, `first-name`, `last-name`, email, address, city, `zip-code`, mobile, p_id, image, name, color, storage, type, price, qty, total) VALUES (:u_id, :firstname, :lastname, :email, :address, :city, :zipcode, :mobile, :p_id, :image, :name, :color, :storage, :type, :price, :qty, :total)");
        $query->bindParam(':u_id', $u_id);
        $query->bindParam(':firstname', $firstname);
        $query->bindParam(':lastname', $lastname);
        $query->bindParam(':email', $email);
        $query->bindParam(':address', $address);
        $query->bindParam(':city', $city);
        $query->bindParam(':zipcode', $zipcode);
        $query->bindParam(':mobile', $mobile);
        $query->bindParam(':p_id', $p_id);
        $query->bindParam(':image', $image);
        $query->bindParam(':name', $name);
        $query->bindParam(':color', $color);
        $query->bindParam(':storage', $storage);
        $query->bindParam(':type', $type);
        $query->bindParam(':price', $price);
        $query->bindParam(':qty', $qty);
        $query->bindParam(':total', $total);
        $query->execute();
    }

    // Clear the cart after successful insertion
    unset($_SESSION['cart']);

    echo "<script>alert('Order added successfully'); location.assign('index.php');</script>";
}

// for update profile 
if (isset($_POST["update_profile"])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $destination = "../adminpanel/img/" . $image;
    if ($image_size <= 48000000) {
        if ($image_extension == 'jpg' || $image_extension == 'jpeg' || $image_extension == 'png') {
            if (move_uploaded_file($image_tmp_name, $destination)) {
                $query = $pdo->prepare("update users set name = :name, mobile = :mobile, city = :city, image = :image where id = :id");
                $query->bindParam('id', $_SESSION['id']);
                $query->bindParam('name', $name);
                $query->bindParam('mobile', $mobile);
                $query->bindParam('city', $city);
                $query->bindParam('image', $image);
                $query->execute();
                echo  "<script>alert('Profile updated successfully'); location.assign('index.php');</script>";
            }
        } else {
            echo "<script>alert('invalid image extension only 'jpg, jpeg and png allowed')</script>";
        }
    } else {
        echo "<script>alert('file is greater')</script>";
    }
}

// for reset pass 
if (isset($_POST['reset_pass'])) {
    $old_pass = $_POST['oldPass'];
    $new_pass = $_POST['newPass'];
    $c_newpass = $_POST['c_NewPass'];

    $query = $pdo->prepare("select count(*) from users where pass = :pass");
    $query->bindParam('pass', $old_pass);
    $query->execute();
    $count = $query->fetchColumn();

    if ($count === 0) {
        echo "<script>alert('Incorrect Password'); location.assign('index.php');</script>";
    } else {
        if ($new_pass == $c_newpass) {
            $query = $pdo->prepare("update users set pass = :pass where id = :id");
            $query->bindParam('id', $_SESSION['id']);
            $query->bindParam('pass', $new_pass);
            $query->execute();
            echo "<script>alert('Password updated successfully'); location.assign('index.php');</script>";
        } else {
            echo "<script>alert('Password Not Matched'); location.assign('index.php');</script>";
        }
    }
}

// for wishlist 
if (isset($_POST['wishlist'])) {
    if (isset($_SESSION['id'])) {


        $p_id = $_POST['id'];
        $image = $_POST['image'];
        $name = $_POST['name'];
        $color = $_POST['color'];
        $storage = $_POST['storage'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $qty * $price;
        $u_id = $_SESSION['id'];

        $query = $pdo->prepare("INSERT INTO wishlist (u_id, p_id, image, name, color, storage, type, price, qty, total) VALUES (:u_id, :p_id, :image, :name, :color, :storage, :type, :price, :qty, :total)");
        $query->bindParam(':u_id', $u_id);
        $query->bindParam(':p_id', $p_id);
        $query->bindParam(':image', $image);
        $query->bindParam(':name', $name);
        $query->bindParam(':color', $color);
        $query->bindParam(':storage', $storage);
        $query->bindParam(':type', $type);
        $query->bindParam(':price', $price);
        $query->bindParam(':qty', $qty);
        $query->bindParam(':total', $total);
        $query->execute();
        echo "<script>alert('Product added in your wishlist'); location.assign('index.php');</script>";
    } else {
        echo "<script>alert('You have to login first'); location.assign('signin.php');</script>";
    }
}

// for delete wishlist 
if (isset($_GET['delete_wishlist'])) {
    // for delete wishlist 
    if (isset($_GET['delete_wishlist'])) {
        $query = $pdo->prepare("DELETE FROM wishlist WHERE u_id = :u_id AND id = :id");
        $query->bindParam('u_id', $_SESSION['id']);
        $query->bindParam('id', $_GET['delete_wishlist']);
        $query->execute();
        echo "<script>alert('Wishlist Deleted successfully'); location.assign('wishlist.php');</script>";
    }
}

// for reviews 


if (isset($_POST['add_rev'])) {
    if (isset($_SESSION['id'])) {
        $review = $_POST['review'];
        if (isset($_GET['productid'])) {
            $query = $pdo->prepare("insert into reviews (u_id, p_id, name, review) VALUES (:u_id, :p_id, :name, :review)");
            $query->bindParam('u_id', $_SESSION['id']);
            $query->bindParam('p_id', $_GET['productid']);
            $query->bindParam('name', $_SESSION['name']);
            $query->bindParam('review', $review);

            if ($query->execute()) {
                echo "<script>alert('Your Review Added Successfully');</script>";
            } else {
                echo "Error adding review.";
            }
        }
    } else {
        $_SESSION['back_to_review_url'] = $_SERVER['REQUEST_URI'];
        echo "<script>alert('You have to login first'); location.assign('signin.php');</script>";
    }
}
