<?php

include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
include_once '../config/database.php';
require_once '../config/functions.php';
$select = "SELECT * FROM customers";
$alldata = mysqli_query($conn, $select);
$counter=0;

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $select = "SELECT image FROM customers WHERE id=$id";
    $oneRow= mysqli_query($conn,$select);
    $numrow=mysqli_num_rows($oneRow);
        $data=mysqli_fetch_assoc($oneRow);
    
    $oldimage=$data['image'];
        unlink("./upload/$oldimage");

    $delete = "DELETE FROM customers where id=$id";
    $d = mysqli_query($conn,$delete);
    $alldata = mysqli_query($conn, $select);
    
}
?>
<div class="continer col-8">
        <form method="post" action="./search.php">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <input name="searchvalue" type="text" id="myInput" placeholder="customer name" class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-grid">
                       <button name="searchBtn" class="btn btn-info"> search</button>
                    </div>
                </div>
            </div>
            <div class="card">
        </form>
        <div class="card-body">
            <h6 class="mt-3">list All Customers
                <a class="float-end btn btn-info" href="./create.php">Create</a>
                
            </h6>
            <table id="myTable" class="table">
                <tr>
                    <th>#N</th>
                    <th>name</th>
                    <th>email</th>
                    <th colspan="2">Action</th>
                </tr>
                <tr>
                <?php foreach($alldata as $item):?>
                <tr>
                    <th> <?=++$counter ?></th>
                    <th> <?=$item['name'] ?></th>
                    <th> <?=$item['email'] ?></th>
                    <th> <img width="30" src="upload/<?= $item['image']?>" alt=""></th>
                    <th><a href="edit.php?edit=<?= $item['id']?>"><i class=" text-info fa-solid fa-pen-to-square"></i></a></th>
                    <th><a href="index.php?delete=<?=$item['id']?>"><i class="text-danger fa-solid fa-trash-can"></i></a></th> 
                </tr>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?php
include_once '../../shared/script.php';
?>