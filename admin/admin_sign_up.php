<?php 
include('conn/connection.php');
if(isset($_POST['submit'])){
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $role = trim(mysqli_real_escape_string($conn, $_POST['role']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $con_password = trim(mysqli_real_escape_string($conn, $_POST['con_password']));
    if($password == $con_password){
        $insert = "INSERT INTO  `admin_data` (`email`, `role`, `password`) VALUES ('$email', '$role', '$password')";
        $run = mysqli_query($conn, $insert);
        if($run){
            ?>
            <script>
            alert('information has been updated  :-) ');
            window.location.href="admin_login.php";
            </script>
        <?php
        }
    }
    else{
        echo" <script> alert('both entered passwords are not same ') </script> " ;
    }
}


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_page</title>
    <link rel="stylesheet" href="css/login_page.css">
</head>
<body>
    <div class="head_ing">WELCOME</div>
    <!-- creating a login page  -->
    <div class="container">
        <div class="top_2">
            Sign Up Using 
        </div>
        <form action="" class="form_cont" method="post">
            <!-- <div>
                <input type="text" placeholder="Name">
            </div> -->
            <div>
                <input type="text" placeholder="Email" name="email">
            </div>
            <div>
                <input type="password" placeholder="password" name="password" required >
            </div>
            <div>
                <input type="password" placeholder="confirm password" name="con_password" required >
            </div>
            <div>
                <select class="role_select fs-4 p-1 rounded ps-3" name="role">
                    <option value="Admin">Select Your Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Subadmin">Subadmin</option>  
                </select>
            </div>
            <div>
                <button class="button" type="submit" name="submit" >Sign Up</button>
            </div>
            <div>
                <span>Already have an Account ?</span>
                <a href="admin_login.php" class="">Sign In</a>
            </div>
        </form>
    </div>
</body>
</html>