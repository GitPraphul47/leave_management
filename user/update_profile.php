<?php
session_start();
include ('conn/connection.php'); // connection file

$user_id = $_SESSION['id'];

// using select query to fetch already known data 
$select = "SELECT * FROM `user_data` WHERE `id`='$user_id'";
    $run= mysqli_query($conn, $select);
    $data = mysqli_fetch_array($run);
    $fname = $data['fname'];
    $lname = $data['lname'];
    $username = $data['username'];
    $email = $data['email'];
    $phone = $data['phone'];
    $birthday = $data['birthday'];
    $image = $data['image'];
    $gender = $data['gender'];
    $education = explode(",", $data['education']);
    $city = $data['city'];
    $district = $data['district'];
    $pincode = $data['pincode'];
    $password = $data['password'];

    // now we use update query 
    if(isset($_POST['submit'])){
        $my_fname = trim(ucwords(mysqli_real_escape_string($conn, $_POST['my_fname'])));
        $my_lname = trim(ucwords(mysqli_real_escape_string($conn, $_POST['my_lname'])));
        $my_user_name = trim(mysqli_real_escape_string($conn, $_POST['my_username']));
            if ($my_user_name==""){
                $my_user_name = $fname."_".rand(0,300);
            }
        $my_email = trim(mysqli_real_escape_string($conn, $_POST['my_email']));
        $my_phone = trim(mysqli_real_escape_string($conn, $_POST['my_phone']));
        $my_birthday = mysqli_real_escape_string($conn, $_POST['my_bday']);
        // image is saved differently 
        $filename =$_FILES['my_image']['name'];
        $tempname = $_FILES['my_image']["tmp_name"]; //for temporary name for file 
        $my_image = "./images/" . $filename; // path redirect for file 
        if($filename =="" && $image != "")
        {
            $my_image = $image;
        }   
        move_uploaded_file($tempname, $my_image);  // by this function it shows that its file that is being saved
        $my_gender = $_POST['my_gender'];
        $my_education =implode(",", $_POST['my_education']);
        $my_city = $_POST['my_city'];
        $my_district = $_POST['my_district'];
        $my_pincode = $_POST['my_pincode'];

        $update = "UPDATE `user_data` SET `fname`='$my_fname', `lname`='$my_lname', `username`='$my_user_name',  `email` = '$my_email', `phone` = '$my_phone', `birthday` = '$my_birthday', `image`='$my_image', `gender` = '$my_gender', `education` = '$my_education', `city` = '$my_city', `district` = '$my_district', `pincode`='$my_pincode' WHERE `id`= '$user_id'";
        $query_run = mysqli_query($conn, $update);
        if($query_run){
            ?>
                <script>
                alert('information has been updated  :-) ');
                window.location.href="view_users.php";
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
            <div class="d-flex">
                <div class="">
                    <div class="">
                        <label for="Name" class="m-2 col-2">First Name :</label>
                        <input type="text" class="m-1 p-1 rounded col-3" name="my_fname" value="<?php echo $fname; ?>" placeholder="Enter the First Name ">
                        <label for="Name" class="m-2 col-2">Last Name :</label>
                        <input type="text" class="m-1 p-1 rounded col-3" name="my_lname" placeholder="Enter the Last Name "  value="<?php echo $lname; ?>">
                    </div>
                    <div class="">
                        <label for="userName" class="m-2 col-2">UserName :</label>
                        <input type="text" class="m-1 p-1 rounded col-3" name="my_username" placeholder="Enter the UserName "  value="<?php echo $username ; ?>">
                        <label for="Email" class="m-2 col-2">Email :</label>
                        <input type="email" class="m-1 p-1 rounded col-3" name="my_email" placeholder="Enter the E-mail "  value="<?php echo $email; ?>">
                    </div>
                    <div class="">
                        <label for="Phone" class="m-2 col-2">Phone :</label>
                        <input type="Number" class="m-1 p-1 rounded col-3" name="my_phone" placeholder="Phone Number"  value="<?php echo $phone; ?>">
                        <label for="Birthday" class="m-2 col-2">Birthday :</label>
                        <input type="date" class="m-1 p-1 rounded col-3" name="my_bday" placeholder="Enter Birthday"  value="<?php echo $birthday; ?>">
                    </div>
                </div>
                <div class="pd-5 d-flex w-25">
                    <div class="pd-5 w-25">
                        <label for="email" class="fs-4 text-center">Profile Image:</label>
                        <input type="file" name="my_image" class="fs-4">
                    </div>
                    <div class="box w-50 float-center h-100 p-1">
                        <img src="<?php echo $image;?>" alt="" class="w-100">
                    </div>
                </div>
            </div>
            <div class="d-flex p-1">
                <div class=" d-flex pt-2 ">
                    <label for="gender" class="fs-3 m-1"> Gender :</label>
                    <div class="col-3 d-flex h-50 m-2">
                        <input type="radio" class="m-2 fs-3  " value="Male" <?php if($gender == 'Male') echo 'checked="checked"'; ?> name="my_gender">
                        <label for="gender" class="fs-3">Male</label>
                        <input type="radio" class="m-2 fs-3" value="Female" <?php if($gender == 'Female') echo 'checked="checked"'; ?> name="my_gender">
                        <label for="gender" class="fs-3">Female</label>
                        <input type="radio" class="m-2 fs-3" value="Other" name="my_gender" <?php if($gender == 'other') echo 'checked="checked"'; ?>>
                        <label for="email" class="fs-3">Other</label>
                    </div>
                </div>
                <div class=" d-flex ">
                    <label for="education" class="fs-3 m-3 ms-4">Education:</label>
                    <div class="d-flex h-50">
                        <input type="checkbox" class=" fs-3 m-1 ms-5 me-1" value="10th"  name="my_education[]" <?php if(in_array('10th', $education)) {echo 'checked="checked"';} ?>>
                        <label for="education" class="fs-3 m-3 me-5">10th</label>
                        <input type="checkbox" class=" fs-3 m-1 me-1" value="12th"  name="my_education[]" <?php if(in_array('12th', $education)) echo 'checked="checked"'; ?>>
                        <label for="education" class="fs-3 m-3 me-5 ">12th</label>
                        <input type="checkbox" class=" fs-3 m-1 me-1" value="Graduation"  name="my_education[]" <?php if(in_array('Graduation', $education)) echo 'checked="checked"'; ?>>
                        <label for="education" class="fs-3 m-3">Graduation</label>
                        <input type="checkbox" class=" fs-3 m-1 me-1" value="Post_Graduation"  name="my_education[]" <?php if(in_array('Post_Graduation', $education)) echo 'checked="checked"'; ?>>
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
                    <select name="my_city"  value="<?php echo $city; ?>" class=" fs-4 p-1 rounded ps-3">
                        <option value="" class="">Select your city</option>
                        <option value="Dehradun" class="" <?php if($city == 'Dehradun') echo 'selected="selected"'; ?>>Dehradun</option>
                        <option value="Rudraprayag" class="" <?php if($city == 'Rudraprayag') echo 'selected="selected"'; ?>>Rudraprayag</option>
                        <option value="Srinagar" class="" <?php if($city == 'Srinagar') echo 'selected="selected"'; ?>>Srinagar</option>
                        <option value="Guptakashi" class=""<?php if($city == 'Guptakashi') echo 'selected="selected"'; ?>>Guptakashi</option>
                    </select>
                </div>
                <!-- city code ends here  -->
                <!-- distict code starts here  -->
                <div class="form-group d-flex w-25">
                    <label for="DistrictName" class="fs-4 m-2  ">District :</label>
                    <select name="my_district" id="" class="fs-4 p-1 rounded " value="<?php echo $district; ?>">
                        <option value="" class="">Select Your District</option>
                        <option value="Dehradun" class="" <?php if($district == 'Dehradun') echo 'selected="selected"'; ?>>Dehradun</option>
                        <option value="Rudraprayag" class="" <?php if($district == 'Rudraprayag') echo 'selected="selected"'; ?>>Rudraprayag</option>
                        <option value="Pauri" class="" <?php if($district == 'Pauri') echo 'selected="selected"'; ?>>Pauri</option>
                        <option value="Chamoli" class="" <?php if($district == 'Chamoli') echo 'selected="selected"'; ?>>Chamoli</option>
                        <option value="Haridwar" class="" <?php if($district == 'Haridwar') echo 'selected="selected"'; ?>>Haridwar</option>
                    </select>
                </div>
                <!-- district code ends here  -->
                <!-- pincode/zipcode code starts here  -->
                <div class="form-group d-flex w-25">
                <label for="email" class="fs-4 m-2">Pincode:</label>
                <input type="text" class="p-1 ms-4 fs-4 rounded "  name="my_pincode" minlength="6" maxlength="6" value="<?php echo $pincode; ?>">
                </div>
                <!-- pincode/zipcode code ends here  -->
            </div>
            <button type="submit" class="btn btn-primary  fs-4 m-2" name="submit" value="">Update</button>
         <a href="index.php" class="btn btn-primary  fs-4 m-2">Cancel</a>
        </form>      
    </main>
    <!-- footer starts here  -->
    <?php include 'footer.php';?>
</body>
</html>