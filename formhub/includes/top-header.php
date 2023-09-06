<?php 
//session_start();

?>

<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">

<?php if(strlen($_SESSION['login']))
    {   ?>
				<li><a href="my-account.php"><i class="icon fa fa-user"></i>Welcome -<?php echo htmlentities($_SESSION['username']);?></a></li>
				<?php } ?>
<!--///////////////////////// Logo area ///////////////////////////////////////-->
<div class="logo">
	<a href="index.php">		
		<img src="img/logo1.png"alt="" class="mg-responsive" style="height:80px ; width:100px ;">
	</a>
</div>	
<!-- //////////////////////////////////////////////////////////////////////////// -->
					<li><a href="my-account.php"><i class="icon fa fa-user"></i>My Account</a></li>
					<li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
					<li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
					<li><a href="#"><i class="icon fa fa-key"></i>Checkout</a></li>
					
					<?php if(strlen($_SESSION['login'])==0)
    {   ?>
 <li><a href="login.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
<?php }
else{ ?>
	
				<li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
				<?php } ?>	
				</ul> 
				</div><!-- /.cnt-account  -->

				<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
						<a href="track-orders.php" class="dropdown-toggle" ><span class="key">Track Order</b></a>
						
					</li>

				
				</ul>
			</div>

	<!-- <li><div class="col-xs-1 col-sm-1 col-md-4 top-search-holder">
<div class="search-area">
    <form name="search" method="post" action="search-result.php">
        <div class="control-group">

            <input class="search-field" placeholder="Search here..." name="product" required="required" />

            <button class="search-button" type="submit" name="search"></button>    

        </div>
    </form> -->
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->		
</div><!-- /.top-search-holder -->
<!-- </li> -->

				<!-- <li><div class="col-xs-5 col-sm-5 col-md-3 animate-dropdown top-cart-row"></li> -->
				<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
				
			

<?php 

 if(isset($_Get['action'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;
			}
		}
		}
	}
?>
					


			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top-->