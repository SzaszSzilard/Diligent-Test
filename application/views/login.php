<div class="jumbotron">
	<h2>This is your login page :]</h2>
	<form method="post">
		
		<div class="form-group">
			<label for="usr">Name:</label>
			<input type="text" class="form-control" id="usr" placeholder="Enter your username" name="usr" <?=$usr!=''?"value='$usr'":''?>>
		</div>
		
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="pwd" placeholder="Enter a password" name="pwd" <?=$pwd!=''?"value='$pwd'":''?>>
		</div>
		
		<? 
		if ($fail >= 2 ):?>
		<div class="form-group g-recaptcha" data-sitekey="6LcWhWIUAAAAAANeg9QGWFXwoaFwQm6xgzJpVlmO"></div>
		<? endif ?>
				
		<button class="btn btn-success" type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
	</form>
</div>