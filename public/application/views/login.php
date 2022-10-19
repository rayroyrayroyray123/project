<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'login/check_login'); ?>
				<h2 class="text-center">Login</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>

					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password">
					</div>

					<?php echo $captcha; ?>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter captcha text" required="required" name="captcha">
					</div>

					<?php echo $error; ?>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Log in</button>
					</div>

					<div class="clearfix">
						<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
						<a href="<?php echo base_url(); ?>register"> Sign up</a>
						<a href="<?php echo base_url(); ?>forget_password" class="float-right"> Forget password?</a>
					</div>   
			<?php echo form_close(); ?>
	</div>
</div>
