<?php
include('conn/connection.php');
$nav_select = "SELECT * FROM `user_data` WHERE `id` = '$user_id'";
$nav_run = mysqli_query($conn, $nav_select);
$nav_data = mysqli_fetch_array($nav_run);
$Profile_image = $nav_data['image'];
$Profile_name = $nav_data['fname']." ".$nav_data['lname'];
?>

<nav class="navbar_"> 
        <a href="index.php" class="logo">
            <img src="images/user.png" alt="">
            <div> User Panel</div>
        </a>
        <!-- search bar  -->
        <div class="search_bar">
            <button class="fa fa-bars menu_side_bar" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"></button>
            <form action="" class="">
                <input type="text" class="search_input_feild" placeholder="search here">
                <button type="submit" ><i class="fa fa-search" ></i></button>
            </form>
        </div>

        <div class="last_nav">
            <!-- notification bell  -->
            <div class="notification">
                <a href="notifications.php" class=""><i class="fa fa-bell"></i></a>
            </div>
            <!-- profile page link  -->
            <div class="profile">
                <a href="profile.php" class="">
                    <img src="<?php echo $Profile_image ;?>" alt="" class="profile_photo">
                </a>
            </div>
            <button class="fa fa-bars menu_side_bar" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"></button>
        </div>
    </nav>