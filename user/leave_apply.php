<?php
session_start();
include ('conn/connection.php'); // connection file

$user_id = $_SESSION['id'];
    

if(isset($_POST['submit'])){
    $name = trim(ucwords(mysqli_real_escape_string($conn, $_POST['my_name'])));
    $reason = trim(ucwords(mysqli_real_escape_string($conn, $_POST['reason'])));
    $requested_at = date('Y-m-d H:i:s');

    $insert = "INSERT INTO `leave_table` (`user_id`, `name`, `reason`, `requested_at`) VALUES('$user_id', '$name', '$reason', '$requested_at')";
    $query_run = mysqli_query($conn, $insert);
    if($query_run){    
        echo "<script>alert('Your request has been submitted Successfully')</script>";
        }
         else{
            echo "<script>alert('querry not running :-) ')</script>" ;
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
            LEAVE APPLY 
        </div>
        <form action="" class="bg-info-subtle p-5 fs-3" method="post" enctype="multipart/form-data">
            <div class="">
                <div class="">
                    <div class="">
                        <label for="Name" class="m-2 col-2">Name :</label>
                        <input type="text" name="my_name" class="m-1 p-1 rounded col-3" placeholder="Enter the First Name " value="<?php echo $Profile_name; ?>">
                        <label for="Name" class="m-2 col-2">USer Id :</label>
                        <input type="text" name="" class="m-1 p-1 rounded col-3" placeholder="Enter the user id" value="<?php echo $user_id; ?>" disabled>
                    </div>
                    <div class="">
                        <label for="Name" class="m-2 col-2">Reason :</label>
                        <input type="textarea" name="reason" class="m-1 p-1 rounded col-3" placeholder="Enter the Reason" rows=5 column=5 >
                    </div>
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