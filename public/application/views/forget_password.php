<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'forget_password/send_email'); ?>
				<h2 class="text-center">Forget Password</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Account name" required="required" name="username">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email" required="required" name="email">
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Send email</button>
					</div>
					   
			<?php echo form_close(); ?>
	</div>
</div>