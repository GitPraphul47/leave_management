<?php 
// include('<admin>conn/connection.php');
if(isset($_POST['enter'])){
$role = $_POST['role'];

if($role =="Admin" or $role=="Subadmin"){
    header('Location: admin/index.php');
}
else{
    header('Location: user/index.php');
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME</title>
    <link rel="stylesheet" href="admin/css/login_page.css">
</head>
<body>
    <div class="head_ing">WELCOME</div>
    <!-- creating a login page  -->
    <div class="container">
        <div class="top">
            Are you admin or User !?
        </div>
        <form action="" class="form_cont" method="post" >
            <!-- <div>
                <input type="text" placeholder="Email or Username" name="email">
            </div>
            <div>
                <input type="password" placeholder="password" name="password">
            </div> -->
            <div>
                <select class="role_select fs-4 p-1 rounded ps-3" name="role">
                    <option value="Admin">Select Your Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Subadmin">Subadmin</option>
                    <option value="User" >User</option>    
                </select>
            </div>
            <div>
                <!-- <input type="button" class="button" value="Login" name="submit"> -->
                 <button class="button" type="submit" name="enter" >Enter</button>
            </div>
            <!-- <div>
                <a href="" class="">Forget Password</a>
                <span>| New User?</span>
                <a href="sign_up_page.html" class="">Sign Up</a>
            </div> -->
        </form>
    </div>
</body>
</html>