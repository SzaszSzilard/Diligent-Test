<body>
	<div class="container">
	  
	<nav class="mb-5 navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#">Diligent</a>
		  
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		</button>
		  
		<div class="collapse navbar-collapse" id="navbarText">
			
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="<?=base_url()?>">Welcome <span class="sr-only">(current)</span></a>
				</li>
			  
				<li class="nav-item">
					<a class="nav-link" href="#">Profile</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>index.php/Main/registration">Registration</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>index.php/Main/login">Login</a>
				</li>
			</ul>

			<span class="navbar-text">Hello, <?=$username=="anonymus"?"Please log in":$username?>!</span>
		  </div>
	</nav>