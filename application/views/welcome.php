<div class="jumbotron">
	<h3>Welcome to this showcase website built for diligent by a mere human, as an interview test.</h3>
	
	<? if ($username=="") { ?>
		<span class="mt-4 card card-body">Please register in order to discover more</span>
	<?php }else{?>
		<div class="mt-4 card card-body">I am happy to see that you has finnaly registered <?=$username?>.<div>
		<div class="mt-4 card card-body">Go to your <a style="display: inline!important;" href="<?=base_url()?>index.php/Main/profile"><strong>Profilepage</strong></a> to discover more.</div>
	<?php } ?>
</div>