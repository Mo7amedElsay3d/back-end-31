<?php

include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
include_once '../config/database.php';
require_once '../config/functions.php';
$select = "SELECT * FROM `orders`";
$alldata = mysqli_query($conn, $select);
$counter=0;
// if(isset($_GET['edit'])){
//     $id=$_GET['edit'];
//     $update = "UPDATE customers SET name='$name' ,email='$email',gender='$gender',phone='$phone' WHERE id=$id";
//     $E = mysqli_query($conn,$update);
//     $editData=mysqli_fetch_assoc($E);
// }
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $delete = "DELETE FROM orders where id=$id";
    $d = mysqli_query($conn,$delete);
    redirect("orders");
}
?>
<div class="continer col-8">
    <div class="card">
        <div class="card-body">
            <h6 class="mt-3">list All Orders 
                <a class="float-end btn btn-info" href="./create.php">Create</a>
                
            </h6>
            <table class="text-center table ">
                <tr>
                    <th>#N</th>
                    <th>Amount</th>
                    <th colspan="2">Action</th>
                </tr>
                <tr>
                <?php foreach($alldata as $item): ?>
                    <th><?= ++$counter?></th>
                    <th><?= $item['amount']?></th>
                    <th><a href="./show.php?show=<?= $item['id']?>"><i class=" text-primary fa-regular fa-eye"></i></a></th>
                    <th><a href="./edit.php?edit=<?= $item['id']?>"><i class=" text-warning fa-solid fa-pen-to-square"></i></a></th>
                    <th><a href="index.php?delete=<?=$item['id']?>"><i class="text-danger fa-solid fa-trash-can"></i></a></th> 
                    </tr>

                    <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?php
include_once '../../shared/script.php';
?>