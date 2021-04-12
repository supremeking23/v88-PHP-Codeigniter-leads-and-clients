<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Products</h2>
                <?= $this->session->flashdata("remove-item"); ?>
                <?= $this->session->flashdata("add-to-cart-success"); ?>
               
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th>Name</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Sub total</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($cart_items as $item):?>
                        <tr>
                            <td><?= $item["product_name"]?></td>
                            
                            <td><?= $item["qty"]?></td>
                            <td>$<?= $item["price"] ?></td>
                            <td>$<?= $item["sub_total"] ?></td>
                            <td>
                                <form class="" action="<?php base_url()?>remove_item" method="POST">     
                                    <input type="hidden" name="product-id" value="<?= $item["product_id"]; ?>">
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">                            
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                        <tr>
                            <td colspan="5" class="text-center">Total : $<?= (empty( $total["grand_total"])) ? "" : $total["grand_total"]?></td>
                        </tr>
                    </tbody>
                </table>
                <a href="<?= base_url()?>">Add new product to cart</a>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Billing Info</h2>

                <?= $this->session->flashdata("errors") ?>
                
                <form action="<?= base_url()?>checkout_process" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value=""  placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value=""  placeholder="Enter your address">
                    </div>

                    <div class="form-group">
                        <label for="card">Card #:</label>
                        <input type="text" class="form-control" id="card" name="card" value=""  placeholder="">
                    </div>
                   
                   
                    <button type="submit" class="btn btn-primary">Order</button>
                </form>

                
            </div>
            <div class="col-md-12 mt-5">
                <a href="<?= base_url()?>" class="">Go back</a>
            </div>
        </div>
    </div> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>