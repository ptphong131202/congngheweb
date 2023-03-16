<?php
include "../bootstrap.php";
session_start();

use CT275\Project\Product;
use CT275\Project\Category;

$product = new Product($PDO);
$cat = new Category($PDO);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shop Hoàng Thượng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php include('../partials/header.php') ?>

	<!-- Main Page Content -->
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div>
                <div style="margin-bottom: 55px"></div>
                <div class="dropdown">
                    <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Danh mục sản phẩm
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                            $cats = $cat->show_category_frontend();
                            foreach($cats as $cat):
                        ?>
                        <li><a class="dropdown-item" href="shopcategory.php?catId=<?=htmlspecialchars($cat->getId())?>"><?=htmlspecialchars($cat->catName)?></a></li>
                        <?php endforeach ?>	
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-lg-9 col-md-12">
            <div>
                <h1 class="text-center">SHOP</h1>
            </div>
            <div class="row">
                <?php 
                    if(isset($_GET['catId']) && $_GET['catId']!=NULL) {
                    $catId = $_GET['catId'];
                    $products = $product->getproductbycatId($catId);
                    foreach($products as $product): 
                ?>
                <?php if($cat->find($product->catId)->mode == 1) {
                ?>
                <div class="col-4 mb-5">
                    <div class="card shadow-lg" style="width: 16rem;">
                        <a href="productdetails.php?proid=<?=htmlspecialchars($product->getId())?>"><img style="width: 254px;height: 215px;" class="img-fluid" src="admin/uploads/<?=htmlspecialchars($product->image)?>" ></a>
                        <div class="card-body">
                            <h5><a class="text-decoration-none text-danger text-center" href="#"><?=htmlspecialchars($product->productName)?></a></h5>
                            <span class="current_price text-danger text-center"><?=htmlspecialchars($product->price)." "."VNĐ" ?></span>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
                <?php endforeach ?>
            </div>  

            <?php
            }else {   
                $products = $product->all();
                foreach($products as $product): 
            ?>
            <?php if($cat->find($product->catId)->mode == 1) {
            ?>
            <div class="col-4 mb-5">
                <div class="card shadow-lg" style="width: 16rem;">
                <a href="productdetails.php?proid=<?=htmlspecialchars($product->getId())?>"><img style="width: 254px;height: 215px;" class="img-fluid" src="admin/uploads/<?=htmlspecialchars($product->image)?>" ></a>
                    <div class="card-body">
                        <h5><a class="text-decoration-none text-danger text-center" href="#"><?=htmlspecialchars($product->productName)?></a></h5>
                        <span class="current_price text-danger text-center"><?=htmlspecialchars($product->price)." "."VNĐ" ?></span>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
            <?php endforeach ?>
            <?php
            }
            ?>                                                        
        </div>
    </div>


	<?php include('../partials/footer.php') ?>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
	
</body>

</html>