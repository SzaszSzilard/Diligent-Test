<div class="jumbotron">
	<h2>This is your registration page ;}</h2>
	<form method="post">
		
		<?php 
		if ( isset($error) && $error != '' )
			echo "<div class='alert alert-danger'>$error</div>";
		elseif ( isset($notice) && $notice != '' )
			echo "<div class='alert alert-success'>$notice</div>";
		?>
		
		<div class="form-group">
			<label for="usr">Name:</label>
			<input type="text" class="form-control" id="usr" placeholder="Enter your username" name="usr" <?=$usr!=''?"value='$usr'":''?>>
		</div>
		
		<div class="form-group">
			<label for="email">Email:</label>
			<!-- <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email"> it would help me check the mail validity -->
			<input type="text" class="form-control" id="email" placeholder="Enter your email" name="email" <?=$email!=''?"value='$email'":''?>>
		</div>
		
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="pwd" placeholder="Enter a password" name="pwd" <?=$pwd!=''?"value='$pwd'":''?>>
		</div>
		
		<button class="btn btn-success" type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
	</form>
</div>