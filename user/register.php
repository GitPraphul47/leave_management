<?php 
include('conn/connection.php');
if(isset($_POST['submit'])){
    $fname = trim(ucwords(mysqli_real_escape_string($conn, $_POST['fname'])));
    $lname = trim(ucwords(mysqli_real_escape_string($conn, $_POST['lname'])));
    $user_name = trim(mysqli_real_escape_string($conn, $_POST['username']));
        if ($user_name==""){
            $user_name = $fname."_".rand(0,300);
        }
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($conn, $_POST['phone']));
    $birthday = mysqli_real_escape_string($conn, $_POST['bday']);
    // image is saved differently 
    $filename =$_FILES['image']['name'];
    $tempname = $_FILES['image']["tmp_name"]; //for temporary name for file 
    $image = "./images/" . $filename; // path redirect for file 
    move_uploaded_file($tempname, $image);  // by this function it shows that its file that is being saved
    $gender = $_POST['gender'];
    $education =implode(",", $_POST['education']);
    $city = $_POST['city'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $password = md5($_POST['password']);
    $c_password = md5($_POST['c_password']);// md5 function encrypts the password into hash value 
    // checking if passwords are same or not 
    if ($password == $c_password){
        // checking if any feilds are empty
        if($fname!="" && $lname!="" && $user_name!="" && $email!="" && $phone!="" && $birthday!="" && $image!="" && $gender!="" && $education!="" && $city!="" && $district!="" && $pincode!="" && $password!=""){
            // cheching if any entered email is already in the database 
            $select = " SELECT * FROM `admin_data` WHERE `email`= '$email' ";
            $run = mysqli_query($conn, $select);
            if(mysqli_num_rows($run)>0){
                ?>
                <script>alert('email already exists')</script>;
                <?php
            } else{
                // here starts insert querry 
                $insert = "INSERT INTO `admin_data`(`fname`, `lname`, `username`, `email`, `phone`, `birthday`, `image`, `gender`, `education`, `city`, `district`, `pincode`, `password`) VALUES ('$fname', '$lname', '$user_name', '$email', '$phone', '$birthday', '$image', '$gender', '$education', '$city', '$district', '$pincode', '$password')";
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
                <script>alert('Please Fill Empty Entries')</script>
            <?php
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
    <title>Register</title>
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
            REGISTER USER 
        </div>
        <form action="" class="bg-info-subtle p-5 fs-3" method="post" enctype="multipart/form-data">
            <div class="d-flex">
                <div class="">
                    <div class="">
                        <label for="Name" class="m-2 col-2">First Name :</label>
                        <input type="text" name="fname" class="m-1 p-1 rounded col-3" placeholder="Enter the First Name ">
                        <label for="Name" class="m-2 col-2">Last Name :</label>
                        <input type="text" name="lname" class="m-1 p-1 rounded col-3" placeholder="Enter the Last Name ">
                    </div>
                    <div class="">
                        <label for="userName" class="m-2 col-2">UserName :</label>
                        <input type="text" class="m-1 p-1 rounded col-3" name="username" placeholder="Enter the UserName ">
                        <label for="Email" class="m-2 col-2">Email :</label>
                        <input type="email" name="email" class="m-1 p-1 rounded col-3" placeholder="Enter the E-mail ">
                    </div>
                    <div class="">
                        <label for="Phone" class="m-2 col-2">Phone :</label>
                        <input type="Number" name="phone" class="m-1 p-1 rounded col-3" placeholder="Phone Number">
                        <label for="Birthday" class="m-2 col-2">Birthday :</label>
                        <input type="date" name="bday" class="m-1 p-1 rounded col-3" placeholder="Enter Birthday">
                    </div>
                </div>
                <div class="pd-5">
                    <label for="email" class="fs-4 text-center">Profile Image:</label>
                    <input type="file" name="image" class="fs-4">
                </div>
            </div>
            <div class="d-flex p-1">
                <div class=" d-flex pt-2 ">
                    <label for="gender" class="fs-3 m-1"> Gender :</label>
                    <div class="col-3 d-flex h-50 m-2">
                        <input type="radio" class="m-2 fs-3  " value="Male" name="gender">
                        <label for="gender" class="fs-3">Male</label>
                        <input type="radio" class="m-2 fs-3" value="Female" name="gender">
                        <label for="gender" class="fs-3">Female</label>
                        <input type="radio" class="m-2 fs-3" value="Other" name="gender">
                        <label for="email" class="fs-3">Other</label>
                    </div>
                </div>
                <div class=" d-flex ">
                    <label for="education" class="fs-3 m-3 ms-4">Education:</label>
                    <div class="d-flex h-50">
                        <input type="checkbox" class=" fs-3 m-1 ms-5 me-1" value="10th"  name="education[]">
                        <label for="education" class="fs-3 m-3 me-5">10th</label>
                        <input type="checkbox" class=" fs-3 m-1 me-1" value="12th"  name="education[]">
                        <label for="education" class="fs-3 m-3 me-5 ">12th</label>
                        <input type="checkbox" class=" fs-3 m-1 me-1" value="Graduation"  name="education[]">
                        <label for="education" class="fs-3 m-3">Graduation</label>
                        <input type="checkbox" class=" fs-3 m-1 me-1" value="Post_Graduation"  name="education[]">
                        <label for="education" class="fs-3 m-3">Post Graduation</label>
                    </div>
                </div>
                
            </div>
            <!-- ---------------- address part here -------------------- -->
            <div class="d-flex">
                <label for="Address" class="m-2">Address : </label>
                <!-- city code starts here  -->
                <div class="form-group d-flex w-25 ms-4">
                    <label for="cityname" class="fs-4 m-2">City :</label>
                    <select name="city"  value="" class=" fs-4 p-1 rounded ps-3">
                        <option value="" class="">Select your city</option>
                        <option value="Dehradun" class="">Dehradun</option>
                        <option value="Rudraprayag" class="">Rudraprayag</option>
                        <option value="Srinagar" class="">Srinagar</option>
                        <option value="Guptakashi" class="">Guptakashi</option>
                    </select>
                </div>
                <!-- city code ends here  -->
                <!-- distict code starts here  -->
                <div class="form-group d-flex w-25">
                    <label for="DistrictName" class="fs-4 m-2  ">District :</label>
                    <select name="district" id="" class="fs-4 p-1 rounded ">
                        <option value="" class="">Select Your District</option>
                        <option value="Dehradun" class="">Dehradun</option>
                        <option value="Rudraprayag" class="">Rudraprayag</option>
                        <option value="Pauri" class="">Pauri</option>
                        <option value="Chamoli" class="">Chamoli</option>
                        <option value="Haridwar" class="">Haridwar</option>
                    </select>
                </div>
                <!-- district code ends here  -->
                <!-- pincode/zipcode code starts here  -->
                <div class="form-group d-flex w-25">
                <label for="email" class="fs-4 m-2">Pincode:</label>
                <input type="text" class="p-1 ms-4 fs-4 rounded "  name="pincode" minlength="6" maxlength="6">
                </div>
                <!-- pincode/zipcode code ends here  -->
            </div>
            <!-- password code starts here  -->
            <div class="w-100 m-2">
                <!-- password  -->
                <div class="form-group d-flex w-100 m-3">
                    <label for="password" class="fs-3 w-25">Password:</label>
                    <input type="password" class="fs-4 w-50 p-1 rounded"  placeholder="Enter password" name="password">
                </div>
                <!-- confirm password -->
                <div class="form-group d-flex w-100 m-3">
                    <label for="cnfirm_password" class="fs-3 w-25">Confirm Password:</label>
                    <input type="password" class=" fs-4  w-50 p-1 rounded"placeholder="Confirm password" name="c_password">
                </div>
            </div>
            <!-- password code ends here  -->
            <button type="submit" class="btn btn-primary  fs-4 m-2" name="submit" value="">Submit</button>
        </form>
    </main>
    <!-- footer starts here  -->
    <?php include 'footer.php';?>
</body>
</html>