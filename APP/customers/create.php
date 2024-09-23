<?php

include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
include_once '../config/database.php';
require_once '../config/functions.php';
if(isset($_POST['send'])){
    $name =$_POST['name'];
    $email =$_POST['email'];
    $gender =$_POST['gender'];
    $phone =$_POST['phone'];
    //image code
    $image_name=rand(0,255).rand(0,255).$_FILES['my_image']['name'];
    $tmp_name= $_FILES['my_image']['tmp_name'];
    $location="./upload/$image_name";
    move_uploaded_file($tmp_name,$location);

    $insert = "INSERT INTO customers VALUES (null,'$name','$email','$gender','$phone','$image_name')";
    $i= mysqli_query($conn,$insert);
    redirect('customers/index.php');
}
?>
<div class="continer col-8">
    <div class="card">
        <div class="card-body">
            <h6 class="mt-3">Create New Customers
                <a class="float-end btn btn-info" href="./index.php">Back</a>
                
            </h6>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">customer name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="">customer email</label>
                    <input type="email" class="form-control" name="email">
                </div>  <div class="form-group">
                    <label for="">customer gender</label>
                    <input type="radio"  value="male"  name="gender"> Male
                    <input type="radio" value="female"  name="gender"> Female

                </div>  <div class="form-group">
                    <label for="">customer phone</label>
                    <input type="text" class="form-control" name="phone">
                </div>
                </div>  <div class="form-group">
                    <label for="">customer Image</label>
                    <input type="file" accept="image/*" class="form-control" name="my_image">
                </div>
                <div class="d-grid">
                    <button class="btn btn-info w-50 mx-auto" name="send">submit</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<?php
include_once '../../shared/script.php';
?>