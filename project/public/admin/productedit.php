<?php

include_once "C:/xampp/apps/project/bootstrap.php";


use CT275\Project\Product;
use CT275\Project\Category;

    $product = new Product($PDO);
    $cat = new Category($PDO); 


    $productId = isset($_REQUEST['productId']) ?
	filter_var($_REQUEST['productId'], FILTER_SANITIZE_NUMBER_INT) : -1;

    if ($productId < 0 || !($product->find($productId))) {
        header("Location: productlist.php"); 
    }

    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($product->update($_POST,$_FILES)) {
            header("Location: productlist.php");
        }	
	$errors = $cat->getValidationErrors();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoàng Thượng</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <style>
        a {
            text-decoration:none;
        }
    </style>
</head>
<body class="container-fluid">
    <?php include('partials_admin/header.php') ?>
    <?php
        if($_SESSION["adminlogin"] == FALSE) {
            header("Location:login.php");
        }
    ?>
    <?php include('partials_admin/sidebar.php') ?>

    <div class="col-lg-10" >
        <div class="container border rounded">
            <h4 class="m-4 text-primary">Chỉnh sửa bánh</h4>
            <div class="mt-5"> 
                
                <form action="" method="post" enctype="multipart/form-data">	
					<!-- Tên bánh -->
                    <div class="row mb-4">
                        <div class="col-2">
                            <label class="form-check-label col-form-label ms-4 fw-semibold" >Tên</label>
                        </div>
                        <div class="col-10 w-50">
                            <input class="form-control" type="text" name="productName" value="<?=htmlspecialchars($product->productName)?>"/>
                        </div>
                    </div>
                    <?php if (isset($errors['productName'])) : ?>
						<span class="text-danger">
							<strong><?= htmlspecialchars($errors['productName']) ?></strong>
						</span>
                    <?php endif ?>
					<!-- Danh mục sản phẩm -->
					<div class="row mb-4">
                        <div class="col-2">
                            <label class="form-check-label col-form-label ms-4 fw-semibold" >Danh mục sản phẩm</label>
                        </div>
                        <div class="col-10 w-50">
                        <select class="form-select" aria-label="Default select example" name="category">
                            <option hidden>Chọn Danh mục sản phẩm</option>
                            <?php 
                                $cats = $cat->all();
                                foreach($cats as $cat): 
                            ?>

                            <option selected value="<?=htmlspecialchars($cat->getId())?>">
                                <?=htmlspecialchars($cat->catName)?>
                            </option>
                            <?php endforeach ?>	
                        </select>
                        </div>
                    </div>
                    <?php if (isset($errors['catId'])) : ?>
						<span class="text-danger">
							<strong><?= htmlspecialchars($errors['catId']) ?></strong>
						</span>
                    <?php endif ?>

					<!-- Mô tả bánh -->
					<div class="row mb-4">
                        <div class="col-2">
                            <label class="form-check-label col-form-label ms-4 fw-semibold" >Mô tả</label>
                        </div>
                        <div class="col-10 w-50">
							<textarea class="form-control"  name="product_desc" style="height: 100px; resize:none"><?=htmlspecialchars($product->product_desc)?></textarea>
                        </div>
                    </div>
                    <?php if (isset($errors['product_desc'])) : ?>
						<span class="text-danger">
							<strong><?= htmlspecialchars($errors['product_desc']) ?></strong>
						</span>
                    <?php endif ?>

					<!-- Giá -->
                    <div class="row mb-4">
                        <div class="col-2">
                            <label class="form-check-label col-form-label ms-4 fw-semibold" >Giá</label>
                        </div>
                        <div class="col-10 w-50">
                            <input class="form-control" type="number" name="price"  value="<?=htmlspecialchars($product->price)?>"/>
                        </div>
                    </div>
                    <?php if (isset($errors['price'])) : ?>
						<span class="text-danger">
							<strong><?= htmlspecialchars($errors['price']) ?></strong>
						</span>
                    <?php endif ?>

					<!-- Ảnh bánh -->
                    <div class="row mb-4">
                        <div class="col-2">
                            <label class="form-check-label col-form-label ms-4 fw-semibold" >Upload ảnh</label>
                        </div>
                        <div class="col-10 w-50">
                            <img src="uploads/<?=htmlspecialchars($product->image)?>" width="90">
                            <br>
                            <input class="form-control" type="file" name="image" />
                        </div>
                    </div>
                    <?php if (isset($errors['image'])) : ?>
						<span class="text-danger">
							<strong><?= htmlspecialchars($errors['image']) ?></strong>
						</span>
                    <?php endif ?>

					<!-- Trạng thái sản phẩm -->
                    <div class="row mb-4">
                        <div class="col-2">
                            <label class="form-check-label col-form-label ms-4 fw-semibold" >Trạng thái</label>
                        </div>
                        <div class="col-10 w-50">
                        <select class="form-select" aria-label="Default select example" name="status_product">
                            <option selected>Chọn trạng thái</option>
                            <?php
                                if($product->status_product == 1) {
                            ?>
                                <option selected value="1">Còn Hàng</option>
                                <option value="0">Hết Hàng</option>
                            <?php
                                }else if($product->status_product == 0){
                            ?>     
                                <option value="1">Còn Hàng</option>
                                <option selected value="0">Hết Hàng</option>
                            <?php
                                }
                            ?>    
                        </select>
                        </div>
                    </div>
                    <?php if (isset($errors['status_product'])) : ?>
						<span class="text-danger">
							<strong><?= htmlspecialchars($errors['status_product']) ?></strong>
						</span>
                    <?php endif ?>

                    <div class="row" style="padding-bottom:5%">
                        <div class="col-2"></div>
                        <div class="col-10 ">
                            <input class="btn btn-success" type="submit" name="submit" Value="Update" />
                        </div>
                    </div>
                </form>
               
            </div>
        </div>  
    </div>    

 </div>
    <?php include('partials_admin/footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $("#example").DataTable();
        });
    </script>
    
</body>