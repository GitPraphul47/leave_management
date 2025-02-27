<?php 
include('conn/connection.php');
$id = $_GET['id'];
$delete = "DELETE FROM `admin_data` WHERE `id`='$id'";
$run = mysqli_query($conn, $delete);
if($run){
    ?>
    <script>
    alert('the information/user has been deleted :-) ');
    window.location.href="view_users.php";
    </script>
<?php
}
?>