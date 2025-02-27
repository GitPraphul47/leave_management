<?php
session_start();
include ('conn/connection.php');
$admin_id = $_SESSION['id'];
$role_get = $_SESSION['role'];
// using select query to fetch already known data 
$select = "SELECT * FROM `admin_data` WHERE `id`='$admin_id'";
    $run= mysqli_query($conn, $select);
    $data = mysqli_fetch_array($run);
    $id = $data['id'];
    $fname = $data['fname'];
    $lname = $data['lname'];
    $username = $data['username'];
    $role = $data['role'];
    $email = $data['email'];
    $phone = $data['phone'];
    $image = $data['images'];


    // now we use update query 
    if(isset($_POST['submit'])){
        $my_fname = trim(ucwords(mysqli_real_escape_string($conn, $_POST['my_fname'])));
        $my_lname = trim(ucwords(mysqli_real_escape_string($conn, $_POST['my_lname'])));
        $my_user_name = trim(mysqli_real_escape_string($conn, $_POST['my_username']));
            if ($my_user_name==""){
                $my_user_name = $fname."_".rand(0,300);
            }
        $my_email = trim(mysqli_real_escape_string($conn, $_POST['my_email']));
        if($role_get =="Admin"){
        $my_role = trim(mysqli_real_escape_string($conn, $_POST['my_role']));}
        $my_phone = trim($_POST['my_phone']);
        // image is saved differently 
        $filename =$_FILES['my_image']['name'];
        $tempname = $_FILES['my_image']["tmp_name"]; //for temporary name for file 
        $my_image = "./../images_common/" . $filename; // path redirect for file 
        if($filename =="" && $image != "")
        {
            $my_image = $image;
        }   
        move_uploaded_file($tempname, $my_image);  // by this function it shows that its file that is being saved

        $update = "UPDATE `admin_data` SET `fname`='$my_fname', `lname`='$my_lname', `username`='$my_user_name',  `email` = '$my_email', `phone` = '$my_phone', `images`='$my_image' WHERE `id`= '$id'";
        $query_run = mysqli_query($conn, $update);
        if($query_run){
            ?>
                <script>
                alert('information has been updated  :-) ');
                window.location.href="index.php";
                </script>
            <?php
        }
        else{
            echo "<script> alert('updated failed')</script> ";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
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
            UPDATE YOUR INFORMATION 
        </div>

        <form action="" class="bg-info-subtle p-5 fs-3"  method="post" enctype="multipart/form-data">
            <div class="d-flex w-75">
                <div class="w-100">
                    <div class="">
                        <label for="Name" class="m-2  col-4">First Name :</label>
                        <input type="text" class="m-1 p-1 rounded " name="my_fname" value="<?php echo $fname; ?>" placeholder="Enter the First Name ">
                    </div>
                    <div class="">
                        <label for="Name" class="m-2 col-4">Last Name :</label>
                        <input type="text" class="m-1 p-1 rounded " name="my_lname" placeholder="Enter the Last Name "  value="<?php echo $lname; ?>">
                    </div>
                    <div class="">
                        <label for="userName" class="m-2 col-4">UserName :</label>
                        <input type="text" class="m-1 p-1 rounded " name="my_username" placeholder="Enter the UserName "  value="<?php echo $username; ?>">
                    </div>
                    <div class="">
                        <label for="Email" class="m-2 col-4">Email :</label>
                        <input type="email" class="m-1 p-1 rounded " name="my_email" placeholder="Enter the E-mail "  value="<?php echo $email; ?>">
                    </div>
                    <div class="">
                        <label for="Phone" class="m-2 col-4">Phone :</label>
                        <input type="Number" class="m-1 p-1 rounded " name="my_phone" placeholder="Phone Number"  value="<?php echo $phone; ?>">
                    </div>
                    <?php 
                    if($role_get =="Admin"){
                        ?>
                        <div class="">
                            <label for="Phone" class="m-2 col-4">Role :</label>
                            <input type="text" class="m-1 p-1 rounded " name="my_role" placeholder="Role"  value="<?php echo $role; ?>">
                        </div>
                   <?php }
                    ?>
                </div>
                <div class="pd-5 d-flex w-25 text-center">
                    <div class="pd-5 w-50">
                        <label for="email" class="fs-4 text-center">Profile Image:</label>
                        <input type="file" name="my_image" class="fs-4">
                    </div>
                    <div class="box w-50 float-center h-50 p-1">
                        <img src="<?php echo $image;?>" alt="" class="w-100">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary  fs-4 m-2" name="submit" value="">Update</button>
         <a href="index.php" class="btn btn-primary  fs-4 m-2">Cancel</a>
        </form>      
    </main>
    <!-- footer starts here  -->
    <?php include 'footer.php';?>
</body>
</html>