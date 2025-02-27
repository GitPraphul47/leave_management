<?php 
session_start();
include ('conn/connection.php'); // connection file
$admin_id = $_SESSION['id'];
$role_get = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link href="css/style.css" rel="Stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body >
    <!-- top nav bar  -->
    <?php include 'navbar.php';?>
    <!-- main part here  -->
    <main class="container ">
        <!-- here is sidebar  -->
        <?php include 'sidebar.php';?>
            <!-- table to view details / -->
        <table class="table table-striped">
            <thead>
                <tr class="">
                    <th colspan="10 mx-auto">
                        <div class="search_bar text-center">
                            <form action="" class="mx-auto" method="post">
                                <input type="text" class="search_input_feild" placeholder="search here" name="search_item">
                                <button type="submit" name="search_user"><i class="fa fa-search" ></i></button>
                            </form>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>S.No.</th>
                    <th>Id</th>
                    <th>image</th>
                    <th>Name</th>
                    <th>role</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Update & Delete</th>
                </tr>
            </thead>
            <tbody>
                <!-- here the search items will be shown  -->
                <tr class="">
                    <?php 
                    $s=1;
                        if(isset($_POST['search_user'])){
                            $search_item = $_POST['search_item'];

                            $select = "SELECT * FROM `admin_data` WHERE `id` LIKE '%$search_item%' OR `fname` LIKE '%$search_item%' OR `lname`LIKE'%$search_item%' OR `phone` LIKE '%$search_item%'  OR `role` LIKE '%$search_item%'";
                            $run = mysqli_query($conn, $select);
                            while($data = mysqli_fetch_array($run)){
                                $admin_id2 = $data['id'];
                                $assigned_role = $data['role'];
                                $image = $data['images'];
                                $fname = $data['fname'];
                                $lname = $data['lname'];
                                $username = $data['username'];
                                $email = $data['email'];
                                $phone = $data['phone'];
                                ?>
                            <td><?php echo $s ; ?></td>
                            <td><?php echo $admin_id2 ; ?></td>
                            <td><img src="<?php echo $image ;?>" alt="" class="h-50 w-50"></td>
                            <td><?php echo $fname." ".$lname ; ?></td>
                            <td><?php echo $assigned_role ; ?></td>
                            <td><?php echo $username ; ?></td>
                            <td><?php echo $email ; ?></td>
                            <td><?php echo $phone ; ?></td>
                           
                            <td>
                                <button class="btn btn-success">
                                    <a href="update.php?id=<?php echo $id ?>" class="text-decoration-none text-light fa fa-edit" title="edit"></a>
                                </button> <br/>
                                <button class="btn btn-danger mt-2 text-light">
                                    <a href="delete.php?id=<?php echo $id ?>" class="text-decoration-none  fa fa-trash-o fs-4 text-light " title="delete user" > </a>
                                </button>
                            </td>
        
                        </tr>
                        <?php
                        $s++;
                        }// while loop ends here 
                     } else{
                        ?>                              
                </tr>
                <tr>
                    <?php
                    $s=1;
                    $content_limit = 2 ; // for the limit of content in one page 

                   if(isset($_GET['page'])){
                        $page = $_GET['page'];
                   }
                   else{
                    $page = 1;
                   }
                    // determin the offsett value or limit starting value on the page 
                    $offset = ($page-1)*$content_limit;
                    $select = "SELECT * FROM `admin_data` LIMIT {$offset},{$content_limit}" ;
                    $run = mysqli_query($conn, $select);
                    while($data = mysqli_fetch_array($run)){
                        $admin_id2 = $data['id'];
                        $assigned_role = $data['role'];
                        $image = $data['images'];
                        $fname = $data['fname'];
                        $lname = $data['lname'];
                        $username = $data['username'];
                        $email = $data['email'];
                        $phone = $data['phone'];
                        ?>
                    <td><?php echo $s ; ?></td>
                    <td><?php echo $admin_id2 ; ?></td>
                    <td><img src="<?php echo $image ;?>" alt="" class="h-25 w-25"></td>
                    <td><?php echo $fname." ".$lname ; ?></td>
                    <td><?php echo $assigned_role ; ?></td>
                    <td><?php echo $username ; ?></td>
                    <td><?php echo $email ; ?></td>
                    <td><?php echo $phone ; ?></td>
                    <?php if($role_get == "Admin"){ ?>
                    <td>
                        <button class="btn btn-success">
                            <a href="update_admin.php?id=<?php echo $id ?>" class="text-decoration-none text-light fa fa-edit" title="edit"></a>
                        </button> <br/>
                        <button class="btn btn-danger mt-2 text-light">
                            <a href="delete_subadmin.php?id=<?php echo $id ?>" class="text-decoration-none  fa fa-trash-o fs-4 text-light " title="delete user" > </a>
                        </button>
                    </td>
                        <?php } ?>
                </tr>
                <?php
                $s++;
                } // while loop ends here 
        
                ?>               
            </tbody>
            <tfoot> 
                <tr  class="text-center">
                    <td colspan="10">
                        <?php 
                            // retrieving data from database for pagination using select qyerry 
                            $limit = "SELECT * FROM `admin_data`"; 
                            $results = mysqli_query($conn, $limit) or die("failed")  ;
                            if (mysqli_num_rows($results) > 0){
                            //for total number of results in database 
                            $total = mysqli_num_rows($results);
                            $total_pages = ceil($total/$content_limit);
                            }else{
                                $total_pages = 0;
                            }
                            ?>
                            <?php
                                echo '<nav aria-label="Page navigation example">';
                                echo '<ul class="pagination">';
                                if($page>=2){   
                                    echo '<li class="page-item"><a href="view_admin.php?page='.($page-1).'" class="page-link">  Prev </a> </li>';   
                                } 
                                for($i = 1; $i<= $total_pages; $i++) { echo '<li class="page-item"><a href="view_admin.php?page='.$i.'" class="page-link">'.$i.' </a> </li>';  
                                } 

                                if( $total_pages > $page ){   
                                    echo '<li class="page-item"><a href="view_admin.php?page='.($page+1).'" class="page-link">Next</a> </li>';   
                                }  

                            echo ' </ul>';
                            echo '</nav>';
                            ?>
                    </td>
                </tr>
            </tfoot>
            <?php
                }//else ends here 
            ?>
        </table>

    </main>
    <!-- footer starts here  -->
    <?php include 'footer.php';?>
</body>
</html>