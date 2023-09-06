<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $id = intval($_GET['id']);
        $category = $_POST['category'];
        $subcat = $_POST['subcategory'];
        $productname = $_POST['productName'];
        $productcompany = $_POST['productCompany'];
        $productprice = $_POST['productprice'];
        $productpricebd = $_POST['productpricebd'];
        $productdescription = $_POST['productDescription'];
        $productscharge = $_POST['productShippingcharge'];
        $productavailability = $_POST['productAvailability'];

        // Update the product in the database
        $sql = "UPDATE products SET 
            category=:category,
            subcategory=:subcat,
            productName=:productname,
            productCompany=:productcompany,
            productPrice=:productprice,
            productPriceBeforeDiscount=:productpricebd,
            productDescription=:productdescription,
            shippingCharge=:productscharge,
            productAvailability=:productavailability
            WHERE id=:id";

        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':subcat', $subcat, PDO::PARAM_STR);
        $query->bindParam(':productname', $productname, PDO::PARAM_STR);
        $query->bindParam(':productcompany', $productcompany, PDO::PARAM_STR);
        $query->bindParam(':productprice', $productprice, PDO::PARAM_STR);
        $query->bindParam(':productpricebd', $productpricebd, PDO::PARAM_STR);
        $query->bindParam(':productdescription', $productdescription, PDO::PARAM_STR);
        $query->bindParam(':productscharge', $productscharge, PDO::PARAM_STR);
        $query->bindParam(':productavailability', $productavailability, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $msg = "Data updated successfully";
    }
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>FarmHub</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Style -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>
</head>

</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Edit Product</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Product Details</div>
                                    <div class="panel-body">
                                        <?php if (isset($msg)) { ?>
                                            <div class="succWrap"><strong>Success</strong>: <?php echo htmlentities($msg); ?></div>
                                        <?php } ?>
                                        <?php
                                        $id = intval($_GET['id']);
                                        $sql = "SELECT * FROM products WHERE id = :id";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':id', $id, PDO::PARAM_INT);
                                        $query->execute();
                                        $result = $query->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">ID</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="<?php echo htmlentities($result['id']); ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Category</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="category" class="form-control" value="<?php echo htmlentities($result['category']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">SubCategory</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="subcategory" class="form-control" value="<?php echo htmlentities($result['subcategory']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Product Name</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="productName" class="form-control" value="<?php echo htmlentities($result['productName']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Product Company</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="productCompany" class="form-control" value="<?php echo htmlentities($result['productCompany']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Product Price</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="productprice" class="form-control" value="<?php echo htmlentities($result['productPrice']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Price Before Discount</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="productpricebd" class="form-control" value="<?php echo htmlentities($result['productPriceBeforeDiscount']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Product Description</label>
                                                <div class="col-sm-4">
                                                    <textarea class="form-control" name="productDescription" rows="3"><?php echo htmlentities($result['productDescription']); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Shipping Charge</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="productShippingcharge" class="form-control" value="<?php echo htmlentities($result['shippingCharge']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Product Availability</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="productAvailability" class="form-control" value="<?php echo htmlentities($result['productAvailability']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
