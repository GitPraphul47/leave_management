 <?php 
 session_start();
include('conn/connection.php');
// retrieving data from database for pagination using select qyerry 
$limit = "SELECT * FROM `admin_data`"; 
$results = mysqli_query($conn, $limit) or die("failed")  ;
if (mysqli_num_rows($results) == 0){
    // redirecting to admin signup if no data in database .
    header('Location:admin_sign_up.php');
}
if(isset($_POST['login'])){
$email = $_POST['email'];
$role = $_POST['role'];
$password = md5($_POST['password']);
if($email!="" && $role!=""){
$select = "SELECT * FROM `admin_data` WHERE  `email`='$email' OR `username`='$email' AND `role`='$role' AND `password`='$password' ";
$run = mysqli_query($conn, $select);
$data = mysqli_fetch_array($run);

$_SESSION['id'] = $data['id'];
$_SESSION['role'] = $data['role'];

if(mysqli_num_rows($run)){
    header('Location:index.php');   
}
}else{
    echo "<script> alert('fill empty entries')</script>";
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
        <div class="top">
             Admin Login
        </div>
        <form action="" class="form_cont" method="post">
            <div>
                <input type="text" placeholder="Email or Username" name="email">
            </div>
            <div>
                <input type="password" placeholder="password" name="password">
            </div>
            <div>
                <select class="role_select fs-4 p-1 rounded ps-3" name="role">
                    <option value="">Select Your Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Subadmin">Subadmin</option>
                    <option value="User" >User</option>    
                </select>
            </div>
            <div>
                <!-- <input type="button" class="button" value="Login" name="submit"> -->
                 <button class="button" type="submit" name="login" >Login</button>
            </div>
            <div>
                <a href="" class="">Forget Password</a>
                <span>| New User?</span>
                <a href="admin_sign_up.php" class="">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>