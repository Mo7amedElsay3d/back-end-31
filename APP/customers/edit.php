<?php

include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
include_once '../config/database.php';
require_once '../config/functions.php';
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $select = "SELECT * FROM customers WHERE id=$id";
    $oneRow= mysqli_query($conn,$select);
    $numrow=mysqli_num_rows($oneRow);
    if($numrow ==1){
        $data=mysqli_fetch_assoc($oneRow);
    }else{
        header("location:/round31/error404.php");

    }


    if(isset($_POST['send'])){
      $name =$_POST['name'];
      $email =$_POST['email'];
      $gender =$_POST['gender'];
      $phone =$_POST['phone'];
      //image code
      if(empty($_FILES['my_image']['name'])){
       $image_name=$data['image'];
      }else{
        $oldimage=$data['image'];
        unlink("./upload/$oldimage");
        $image_name=rand(0,255).rand(0,255).$_FILES['my_image']['name'];
        $tmp_name= $_FILES['my_image']['tmp_name'];
        $location="./upload/$image_name";
        move_uploaded_file($tmp_name,$location);
      }

      $update = "UPDATE customers SET name='$name' ,email='$email',gender='$gender',phone='$phone',image='$image_name' WHERE id=$id";
      $i =mysqli_query($conn,$update);
      redirect('customers/index.php');
    }
}   else{
    header("location:/round31/error404.php");
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
                    <input type="text"value="<?=$data['name']?>"class="form-control"name="name">
                </div>
                <div class="form-group">
                    <label for="">customer email</label>
                    <input type="email"value="<?=$data['email']?>"class="form-control"name="email">
                </div>  <div class="form-group">
                    <label for="">customer gender</label>
                    <?php if($data['gender']=="Male"):?>
                    <input type="radio"value="Male"checked name="gender"> Male
                    <input class="my-3"type="radio"value="female"name="gender">Female
                    <?php else:?>
                        <input type="radio"value="Male"name="gender" > Male
                    <input class="my-3"checked type="radio"value="female"name="gender">Female
                    <?php endif;?>

                </div>  <div class="form-group">
                    <label for="">customer phone</label>
                    <input type="text"value="<?=$data['phone']?>"class="form-control"name="phone">
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