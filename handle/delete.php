<?php 

 if (isset($_POST['submit']) and isset($_GET['id'])) {
     require_once '../inc/conn.php';
     global $conn ;

     $id = $_GET['id'];
    function query($Q){   

    global $conn ;
    $runQ = mysqli_query($conn, $Q);
    return $runQ;
    }

    $query = "SELECT id , image FROM posts WHERE id = $id";
    $runQ = query($query);

    if (mysqli_num_rows($runQ)==1) {
        $img = mysqli_fetch_assoc($runQ);
        if (!empty($img)) {
            unlink("../uploads/".$img['image']);
        }
        $deletequery = "DELETE FROM posts WHERE id = $id";
        $runQ = query($deletequery);

        if ($runQ) {
            $_SESSION['success'] = "Post deleted successfully";
        }else {
            $_SESSION['errors'] = ['Error while deleting'];
        }
        header('Location: ../index.php');
        exit();
        

    } else {
        $_SESSION['errors'] = [ "something wrong happend"];
    header('location:../index.php');
     }
    



} else {
    $_SESSION['errors'] = ['bad getaway'];
    header('location:../index.php');
 }
