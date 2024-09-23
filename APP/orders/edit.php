<?php

include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
include_once '../config/database.php';
require_once '../config/functions.php';
//get all customers
$customers="SELECT * FROM customers";
$customersdata= mysqli_query($conn,$customers);
//get all products
$products="SELECT * FROM products";
$productsdata= mysqli_query($conn,$products);
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $select = "SELECT * FROM orders WHERE id=$id";
    $oneRow= mysqli_query($conn,$select);
    $numRow=mysqli_num_rows($oneRow);
    if($numRow==1){
        $data=mysqli_fetch_assoc($oneRow);
    }else{
        header("location:/round31/error404.php");
    }


    if(isset($_POST['send'])){
        $amount=$_POST['amount'];
        $product=$_POST['product'];
        $customer=$_POST['customer'];
        $insert="UPDATE orders SET amount=$amount,customer_id=$customer,product_id=$product where id=$id";
        $i=mysqli_query($conn,$insert);
        redirect('orders/index.php');
    }
}   else{
    header("location:/round31/error404.php");
}
   

?>
<div class="continer col-8">
    <div class="card">
        <div class="card-body">
            <h6 class="mt-3">Edit Orders
                <a class="float-end btn btn-info" href="./index.php">Back</a>
                
            </h6>
            <form method="post">
            <div class="form-group">
                    <label for="">Order Amount</label>
                    <input type="number" value="<?=$data['amount'] ?>" class="form-control" name="amount">
                </div>
                <div class="form-group">
                    <label for="">coustomer Name</label>
                    <select  class="form-control" name="customer">
                    <?php foreach($customersdata as $item):?>
                        <?php if($item['id']== $data['customer_id']): ?>
                        <option selected value="<?=$item['id']?>"><?=$item['name']?></option>
                        <?php else: ?>
                            <option  value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                        </select>

                </div>
                <div class="form-group">
                    <label for="">product Name</label>
                    <select  class="form-control" name="product">
                    <?php foreach($productsdata as $item):?>
                        <?php if($item['id']== $data['product_id']): ?>
                        <option selected value="<?=$item['id'] ?>"><?=$item['name_product']?></option>
                        <?php else: ?>
                            <option  value="<?=$item['id'] ?>"><?=$item['name_product']?></option>
                        <?php endif ;?>
                        <?php endforeach;?>
                        </select>

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