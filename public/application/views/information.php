<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'information/change_information'); ?>
				<h2 class="text-center">Personal Information </h2>   
                    <?php echo "Current user Name: ".$username; ?>  
                    <?php echo '<br><br>'; ?>  
					<div class="form-group">
						<input type="password" class="form-control" placeholder="New password" required="required" name="password">
					</div>

                    <?php echo "Original E-mail : ".$email; ?> 
					<div class="form-group">
						<input type="email" class="form-control" placeholder="New E-mail" required="required" name="email">
					</div>

					<div class="form-group">
					<?php echo $error; ?>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Change</button>
					</div>
					   
			<?php echo form_close(); ?>

			<h3> My Favourite Course List </h3>
			<div>
				<ul>
				<?php foreach($query->result() as $row){ ?>
						<li> <?php echo $row->course_name; ?></li>
				<?php } ?>

				</ul>
			</div>
	</div>
</div>