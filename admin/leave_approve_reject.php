<?php 
include('conn/connection.php');
$id= $_GET['app_id'];
$status = $_GET['status'];
echo $id . $status ;
if($_GET['status']=="approved"){
    $status = 0;
    $insert = "UPDATE `leave_table` SET `status`='$status' WHERE `id`='$id'";
    $query_run = mysqli_query($conn, $insert);
    if($query_run){
        header('Location: view_applications.php');
    }
    else{
        echo "failed";
    }
}
else if($_GET['status']=="rejected"){
    $status = 1;
    $insert = "UPDATE `leave_table` SET `status`='$status' WHERE `id`='$id'";
    $query_run = mysqli_query($conn, $insert);
    if($query_run){
        header('Location: view_applications.php');
    }
    else{
        echo "failed";
    }
}

?>