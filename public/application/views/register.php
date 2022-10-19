<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="container">
    <div class="col-4 offset-4">
		<?php echo form_open(base_url().'register/do_register'); ?>
			<h2 class="text-center">Register</h2>       
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Account name" required="required" name="username">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" required="required" name="password">
				</div>
				<div class="form-group">
					<input type="email" class="form-control" placeholder="E-mail" required="required" name="email">
				</div>
				<div class="form-group">
				<div class="form-group">
					<div class="g-recaptcha" data-sitekey="6Lf8YhQgAAAAAI_CLrIDUb-2cBhyVGEY1TXeB0cT"></div>
				</div>
				<?php echo $error; ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Register</button>
				</div>
					
		<?php echo form_close(); ?>

		<div>
		
		</div>
	</div>
</div>



