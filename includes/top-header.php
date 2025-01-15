<?php 
//session_start();

?>

<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">
				<script src="https://kit.fontawesome.com/4a07c4d5e3.js" crossorigin="anonymous"></script>


<?php if(strlen($_SESSION['login']))
    {   ?>
				<li><a href="my-account.php"><i class="icon fa fa-user"></i>Welcome - <?php echo htmlentities($_SESSION['username']);?></a></li>

					<?php 
					$query = mysqli_query($con, "
					SELECT users.balance as balance FROM users WHERE id = '" . mysqli_real_escape_string($con, $_SESSION['id']) . "'");
					$row=mysqli_fetch_array($query);
					?>
					<li><a href="wallet.php"><i class="icon fa fa-solid fa-wallet" style="margin-right:0px !important; color:#888888 !important;"></i>Wallet (RM <?php echo $row['balance']; ?>)</a></li>
					<li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
					<li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
					<li><a href="order-history.php"><i class="icon fa fa-solid fa-clock-rotate-left" style="margin-right:0px !important; color:#888888 !important;"></i>Order History</a></li>
					<li><a href="pending-orders.php"><i class="icon fa fa-solid fa-clock" style="margin-right:0px !important; color:#888888 !important;"></i>Pending Orders</a></li>

				<?php } ?>
					<?php if(strlen($_SESSION['login'])==0)
    {   ?>
<li><a href="login.php"><i class="icon fa fa-sign-in"></i>Welcome, Please Login</a></li>
<?php }
else{ ?>
	
				<li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
				<?php } ?>	
				</ul>
			</div><!-- /.cnt-account -->

<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
						<a href="track-orders.php" class="dropdown-toggle" ><span class="key">Track Order</b></a>
						
					</li>

				
				</ul>
			</div>
			
			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->