<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'Reset_password/reset'); ?>
				<h2 class="text-center">Reset Password</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="New Password" required="required" name="new_password">
					</div>

					<div class="form-group">
						<input type="password" class="form-control" placeholder="Enter again" required="required" name="password">
					</div>

					<div class="form-group">
					<?php echo $error; ?>
					</div>

                    <div class="form-group">
                        <label>Captcha</label>
                    </div>
                    
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Reset</button>
					</div>
					   
			<?php echo form_close(); ?>
	</div>
</div>