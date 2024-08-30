<?php 



if (isset($_POST['submit'])) {
    require_once '../inc/conn.php';
    global $conn;
    $errors = [];

    function cleardata($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function query($Q) {
        global $conn;
        $runQ = mysqli_query($conn, $Q);
        return $runQ;
    }

    $email = cleardata($_POST['email']);
    $password = cleardata($_POST['password']);

    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $runq = query($query);

        if (mysqli_num_rows($runq) == 1) {
            $user = mysqli_fetch_assoc($runq);
            $database_password = $user['password'];
            $database_name = $user['name'];
            $user_id = $user['id'];

            $confirm = password_verify($password, $database_password);
            if ($confirm) {
                $_SESSION["user_id"] = $user_id;
                $_SESSION["success"] = "Welcome $database_name";
                header("Location:../index.php");
                exit();
            } else {
                $_SESSION["errors"] = ["Email or password is wrong"];
                header("Location:../login.php");
                exit();
            }
        } else {
            $_SESSION["errors"] = ["Issue while logging in"];
            header("Location:../login.php");
            exit();
        }
    } else {
        $_SESSION["errors"] = $errors;
        header("Location:../login.php");
        exit();
    }
} else {
    header("Location:../login.php");
    exit();
}