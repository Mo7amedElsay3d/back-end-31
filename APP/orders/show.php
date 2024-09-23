<?php

include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
include_once '../config/database.php';
require_once '../config/functions.php';
$select = "SELECT * FROM `orders`";
$alldata = mysqli_query($conn, $select);
// if(isset($_GET['edit'])){
//     $id=$_GET['edit'];
//     $update = "UPDATE customers SET name='$name' ,email='$email',gender='$gender',phone='$phone' WHERE id=$id";
//     $E = mysqli_query($conn,$update);
//     $editData=mysqli_fetch_assoc($E);
// }
if(isset($_GET['show'])) {
    $id=$_GET['show'];
    $select = "SELECT * FROM alljoindata WHERE id=$id";
    $oneRow= mysqli_query($conn,$select);
    $numRow=mysqli_num_rows($oneRow);
    if($numRow==1){
        $data=mysqli_fetch_assoc($oneRow);
    }else{
        header("location:/round31/error404.php");
    }
} else{
    header("location:/round31/error404.php");
}

    
?>
<div class="continer col-8">
    <div class="card">
        <div class="card-body">
            <h6 class="mt-3">list one Orders  <?=$data['ID'] ?>
                <a class="float-end btn btn-info" href="./create.php">Create</a>
                
            </h6>
            <hr>
            <h6>amount : <?=$data['amount'] ?> </h6>
            <hr>
            <h6>name_product : <?=$data['name_product'] ?> </h6>
            <hr>
            <h6>name : <?=$data['name'] ?> </h6>
            <hr>
            <h6>email : <?=$data['email'] ?> </h6>
            <hr>
            <h6>phone : <?=$data['phone'] ?> </h6>
            <hr>
            
            
        </div>
    </div>
</div>

<?php
include_once '../../shared/script.php';
?>