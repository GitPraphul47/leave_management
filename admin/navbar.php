<?php 
$nav_select = "SELECT * FROM `admin_data` WHERE `id` = '$admin_id' AND `role`='$role_get'";
$nav_run = mysqli_query($conn, $nav_select);
$nav_data = mysqli_fetch_array($nav_run);
$Profile_image = $nav_data['images'];

$noti_select = "SELECT * FROM `leave_table` WHERE `status`=''" ;
$noti_run = mysqli_query($conn, $noti_select);
$notificaton_count = mysqli_num_rows($noti_run);

?>
<nav class="navbar_"> 
        <a href="index.php" class="logo">
            <img src="images/user.png" alt="">
            <div> <?php  echo "$role_get" ;?> Panel</div>
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
            <div class="notification position-relative">
                <a href="notifications.php" class=""><i class="fa fa-bell"></i><i class="fs-6 text-center text-info bg-danger px-2 rounded-circle position-absolute start-50"><?php echo $notificaton_count ;?></i></a>
            </div>
            <!-- profile page link  -->
            <div class="profile">
                <a href="profile.php" class="">
                    <img src="<?php echo $Profile_image ;?>" alt="" class="profile_photo ">
                </a>
            </div>
            <button class="fa fa-bars menu_side_bar" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"></button>
        </div>
    </nav>