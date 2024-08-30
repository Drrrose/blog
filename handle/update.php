<?php 
 if (isset($_POST['submit']) and isset($_GET['id'])) {
    require_once '../inc/conn.php';
    global $conn ;
    $errors = [];
    
    function getPostData($key) {
        if (!empty($_POST[$key])) {
            return cleardata($_POST[$key]);
        }
        return null;
    }

    function cleardata($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = cleardata($_GET['id']);

    function query($Q){   
        global $conn ;
        $runQ = mysqli_query($conn, $Q);
        return $runQ;
    }

    $title = getPostData('title');
    $body = getPostData('body');
    
    
        
    $image = $_FILES['image'];
    $error = $image['error'];
    
    if (!is_null($title) or !is_null($body) or $error == 0 ) {
        $setClause = [];
        if (!is_null($title)) {
            $setClause[] = "`title` = '$title'";
        }
        if (!is_null($body)) {
            $setClause[] = "`body` = '$body'";
        }
        if ($error == 0 ) {

        $imgname = $image['name'];
        $tmp_name = $image['tmp_name'];
        $size = $image['size'];
        $ext = strtolower(pathinfo($imgname, PATHINFO_EXTENSION)); // use strtolower to handle case sensitivity
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        // validate img 
        $imagenewname = uniqid() . ".$ext";
        if (move_uploaded_file($tmp_name, "../uploads/$imagenewname")){
            $query = "SELECT id , image FROM posts WHERE id = $id";
            $runQ = query($query);
        
            if (mysqli_num_rows($runQ)==1) {
                $img = mysqli_fetch_assoc($runQ);
                if (!empty($img)) {
                    unlink("../uploads/".$img['image']);
                }
            }
            $setClause[] = "`image` = '$imagenewname'";
        }else {
            $_SESSION['errors'] = "Image upload failed";
            header('Location: ../index.php');
            exit();
        }
        }
        
        $setClause = implode(", ", $setClause);

        $query = "UPDATE posts SET $setClause WHERE id = $id";
        $runquery = query($query);

        if ($runquery) {
            $_SESSION['success'] = "Data updated successfully";
        } else {
            $_SESSION['errors'] = "Something went wrong";
        }
        header('Location: ../index.php');
    } else {
        $_SESSION['errors'] = "At least one field must be filled out";
        header('Location: ../index.php');
    }
            






}else {
    $_SESSION['errors'] = ['bad getaway'];
    header('location:../index.php');
 }