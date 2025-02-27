
<!-- for mobile screen  -->
<div class="offcanvas offcanvas-start w-25" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header navbar_side">
    <a href="index.php" class="logo offcanvas-title d-flex text-align-center text-decoration-none w-75 h-50" id="staticBackdropLabel ">
        <!-- <img src="images/user.png" alt="" class="w-25 h-25"> -->
        <div class=" fs-2 fw-bolder text-light w-75"> <?php  echo "$role_get" ;?> Panel</div>
    </a>
    <button type="button" class="btn-close " data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
    <div class=" bg-secondary p-3 h-100 ">
        <ul class="list-group list-group-flush bg-secondary">
            <li class="list-group-item bg-secondary text-light">
                <a href="index.php" class="bg-secondary text-light text-decoration-none fs-3"> <i class="fa fa-home"></i>  Home</a>
            </li>
            <li class="list-group-item bg-secondary text-light">
                <a href="register_users.php" class="bg-secondary text-light text-decoration-none fs-3"> <i class="fa fa-address-book-o"></i>  Register Users</a>
            </li>
            <li class="list-group-item bg-secondary text-light">
                <a href="view_users.php" class="bg-secondary text-light text-decoration-none fs-3"> <i class="fa fa-group"></i>  View Users</a>
            </li>
            <li class="list-group-item bg-secondary text-light">
                <a href="update_profile.php" class="bg-secondary text-light text-decoration-none fs-3"> <i class="fa fa-address-card-o"></i>  Update Profile</a>
            </li>
            <?php if ($role_get == "Admin") {?>
            <li class="list-group-item bg-secondary text-light">
                <a href="add_subadmin.php" class="bg-secondary text-light text-decoration-none fs-3"> <i class="fa fa-home"></i> Register SubAdmin</a>
            </li>
            <li class="list-group-item bg-secondary text-light">
                <a href="view_admin.php" class="bg-secondary text-light text-decoration-none fs-3"> <i class="fa fa-home"></i> View Admin</a>
            </li>
            <?php } ?>
            
            <li class="list-group-item bg-secondary text-light">
                <a href="view_applications.php" class="bg-secondary text-light text-decoration-none fs-3"> <i class="fa fa-address-card-o"></i>  View Applications</a>
            </li>
        </ul>
        <!-- footer of side bar  -->
        <div class="position-absolute bottom-0  m-3">
            <a href="admin_log_out.php" class="text-decoration-none m-2 text-light">Log Out</a>
            <a href="log_out.php" class="text-decoration-none m-2 text-light">Change PAssword</a>
        </div>
    </div>
</div>



<!-- for bigger screens  -->

<!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Enable both scrolling & backdrop</button> -->

<!-- <div class="bg-light  cm-5" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabeldata-bs-dismiss="offcanvas">Backdrop with scrolling</h5>
    <button type="button" class="btn-close" " aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Try scrolling the rest of the page to see this option in action.</p>
  </div>
</div> -->

 

