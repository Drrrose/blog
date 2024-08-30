<?php 
require_once '../inc/conn.php';


    if (!isset($_SESSION["user_id"])):
        header("location:../Login.php");
        exit();
    endif;

    $user_id = $_SESSION["user_id"];


if (isset($_POST['submit'])) {
    
    function cleardata($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $errors = [];

    $title = cleardata($_POST['title']);
    $body = cleardata($_POST['body']);    

    $image = $_FILES['image'];
    if ($image) {
        $error = $image['error'];
        $imgname = $image['name'];
        $tmp_name = $image['tmp_name'];
        $ext = strtolower(pathinfo($imgname, PATHINFO_EXTENSION)); // use strtolower to handle case sensitivity
        $size = $image['size'];
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
    }

    // Validate title
    if (empty($title)) {
        $errors[] = "Title is required";
    }

    // Validate body
    if (empty($body)) {
        $errors[] = "Body is required";
    }

    // Validate image
    if ($error != 0) {
        $errors[] = "Error uploading image.";
    } elseif (!in_array($ext, $allowed)) {
        $errors[] = "Image format is not valid.";
    } elseif ($size >= 5242880) {
        $errors[] = "Image size is too large. Maximum size is 5MB";
    }

    if (empty($errors)) {
        $imagenewname = uniqid() . ".$ext";
        if (move_uploaded_file($tmp_name, "../uploads/$imagenewname")) {
            $query = "INSERT INTO posts (`title`, `body`, `image`, `user_id`)
                      VALUES ('$title', '$body', '$imagenewname', '$user_id')";
            $runQ = mysqli_query($conn, $query);
            if ($runQ) {
                $_SESSION['success'] = "Post added successfully.";
                header("Location: ../index.php");
                exit();
            } else {
                $errors[] = "Failed to add post. Please try again.";
            }
        } else {
            $errors[] = "Failed to upload image.";
        }
    }

    $_SESSION['errors'] = $errors;
    header("Location: ../addPost.php");
    exit();
} else {
    $_SESSION['errors'] = ["Invalid form submission."];
    header("Location: ../addPost.php");
    exit();
}