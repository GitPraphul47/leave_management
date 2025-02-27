<?php 
session_start();
include('conn/connection.php');
$admin_id = $_SESSION['id'];
$role_get = $_SESSION['role'];
if(isset($_POST['submit'])){
    $fname = trim(ucwords(mysqli_real_escape_string($conn, $_POST['fname'])));
    $lname = trim(ucwords(mysqli_real_escape_string($conn, $_POST['lname'])));
    $user_name = trim(mysqli_real_escape_string($conn, $_POST['username']));
        if ($user_name==""){
            $user_name = $fname."_".rand(0,300);
        }
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($conn, $_POST['phone']));
    $role = trim(mysqli_real_escape_string($conn, $_POST['role']));
    // image is saved differently 
    $filename =$_FILES['image']['name'];
    $tempname = $_FILES['image']["tmp_name"]; //for temporary name for file 
    $image = "../images/" . $filename; // path redirect for file 
    move_uploaded_file($tempname, $image);  // by this function it shows that its file that is being saved
    $password = 123456;
    $c_password = 123456;// md5 function encrypts the password into hash value 
    // checking if passwords are same or not 
    if ($password == $c_password){
            // cheching if any entered email is already in the database 
            $select = " SELECT * FROM `admin_data` WHERE `email`= '$email' ";
            $run = mysqli_query($conn, $select);
            if(mysqli_num_rows($run)>0){
                ?>
                <script>alert('email already exists')</script>;
                <?php
            } else{
                // here starts insert querry 
                $insert = "INSERT INTO `admin_data`(`role`, `fname`, `lname`, `email`, `phone`, `username`, `images`, `password`) VALUES ('$role','$fname','$lname','$email','$phone','$user_name','$image', '$password')";
                $query_run = mysqli_query($conn, $insert);
                if($query_run){    
                    echo "<script>alert('Your Data has been submitted Successfully')</script>";
                }
                else{
                    echo "<script>alert('querry not running :-) ')</script>" ;
                   }
            }
    }
    else{
        ?>
            <script>alert('Both entered Passwords are not same ')</script>
        <?php
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add subadmin</title>
    <link href="css/style.css" rel="Stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body >
    <!-- top nav bar  -->
    <?php include 'navbar.php';?>
    <!-- main part here  -->
    <main class="">        
        <?php include 'sidebar.php';?>
        <div class="text-center fs-1 fw-bolder text-success bg-info">
            ADD SUBADMIN 
        </div>

        <form action="" class="bg-info-subtle p-5 fs-3"  method="post" enctype="multipart/form-data">
            <div class="d-flex w-100">
                <div class="w-75">
                    <div class="">
                        <label for="Name" class="m-2  col-4">First Name :</label>
                        <input type="text" class="m-1 p-1 rounded " name="fname" value="" placeholder="Enter the First Name ">
                    </div>
                    <div class="">
                        <label for="Name" class="m-2 col-4">Last Name :</label>
                        <input type="text" class="m-1 p-1 rounded " name="lname" placeholder="Enter the Last Name "  value="">
                    </div>
                    <div class="">
                        <label for="userName" class="m-2 col-4">UserName :</label>
                        <input type="text" class="m-1 p-1 rounded " name="username" placeholder="Enter the UserName "  value="">
                    </div>
                    <div class="">
                        <label for="Email" class="m-2 col-4">Email :</label>
                        <input type="email" class="m-1 p-1 rounded " name="email" placeholder="Enter the E-mail "  value="">
                    </div>
                    <div class="">
                        <label for="Phone" class="m-2 col-4">Phone :</label>
                        <input type="Number" class="m-1 p-1 rounded " name="phone" placeholder="Phone Number"  value="">
                    </div>
                    <?php 
                    if($role_get =="Admin"){
                        ?>
                        <div class="">
                            <label for="Phone" class="m-2 col-4">Role :</label>
                            <input type="text" class="m-1 p-1 rounded " name="role" placeholder="Role"  value="">
                        </div>
                   <?php 
                   }
                    ?>
                </div>
                <div class="pd-5 d-flex w-25 text-center">
                    <div class="pd-5 w-50">
                        <label for="email" class="fs-4 text-center">Profile Image:</label>
                        <input type="file" name="image" class="fs-4">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary  fs-4 m-2" name="submit" value="">Submit</button>
         <a href="index.php" class="btn btn-primary  fs-4 m-2">Cancel</a>
        </form>      
    </main>
    <!-- footer starts here  -->
    <?php include 'footer.php';?>
</body>
</html>