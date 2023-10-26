<nav class="navbar navbar-inverse navbar-fixed-top">
		
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		</button>
		<a class="navbar-brand" style="color:lightgreen;" href="#">Inventory Program</a>
	</div>
	
	<div class="collapse navbar-collapse menubar" id="myNavbar" >
		<ul class="nav navbar-nav">
			
			<li class="dropdown">
				
				<a class="dropdown-toggle active" data-toggle="dropdown" href="#">Files<span class="caret"></span></a>
				
				<ul class="dropdown-menu">
					
					<li><a href="products.php">Products</a></li>
					<li><a href="categories.php">Categories</a></li>
					<li><a href="customers.php">Clients</a></li>
					<li class="divider"></li>
					<li><a href="users.php">Users</a></li>
					<li class="divider"></li>
					<li><a href=".">Log Out</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				
				<a class="dropdown-toggle active" data-toggle="dropdown" href="#">Transactions<span class="caret"></span></a>
				
				<ul class="dropdown-menu">
					<li><a href="sales.php">Sales</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				
				<a class="dropdown-toggle active" data-toggle="dropdown" href="#">Reports<span class="caret"></span></a>
				
				<ul class="dropdown-menu">
					<li><a href="#" id="report_sales">Sales Summary</a></li>
				</ul>
				
			</li>
			
		</ul>
		
		<ul class="nav navbar-nav">
			<li><a target="_blank" style="color:yellow;" href="menu.php" id="new_tab"><span class="glyphicon glyphicon-plus">New Tab</span></a></li>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="." id="log_out"><span class="glyphicon glyphicon-log-out">Log-out&nbsp;</span></a></li>
		</ul>
	</div>
	
</nav>
