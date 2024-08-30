<?php 

if (isset($_POST['submit'])) {

    require_once '../../inc/conn.php';
    global $conn ;
    $errors = [];

    function cleardata($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function query($Q){   
        global $conn ;
        $runQ = mysqli_query($conn, $Q);
        return $runQ;
    }

    $name = cleardata($_POST['name']);
    $email = cleardata($_POST['email']);
    $password = cleardata($_POST['password']);
    $phone = cleardata($_POST['phone']);

    // validation
    
    if (empty($name)) {
    $errors[]= "name is required";
    }
    if (empty($email)) {
    $errors[]= "email is required";
    }
    if (empty($password)) {
    $errors[]= "password is required";
    }
    if (empty($phone)) {
    $errors[]= "phone is required";
    }

    if (empty($errors)) {
    $password = password_hash($password,PASSWORD_DEFAULT);

    $query = "INSERT INTO users (`name` , `email`,`password` , `phone`) 
    values('$name' , '$email' , '$password' , '$phone')";

    $runQ = query($query);

    if ($runQ) {
        header('location:../../Login.php');
        exit();
    }else {
        $_SESSION["errors"] = ["error while inserting"];
    header('location: ../register.php');
    exit();
       
    }
    } 

    $_SESSION["errors"] = ["register issue"];
    header('location: ../register.php');
   


} else {
    header('location:http://localhost/assignment/blog/');
    exit();
}
