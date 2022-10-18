<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'Comment/do_comment'); ?>
				<h2 class="text-center">Comment</h2>       
                    <div class="form-group">
                        <?php echo $error; ?>
                    </div>
                    <div class="form-group">
                    <?php foreach ($query->result() as $row)
                        {
                            echo $row->username." : ";
                            echo $row->comment ;
                            echo '<br>';  
                        } ?>
					</div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Comment" required="required" name="comment">
                    </div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Send</button>
					</div>
					   
			<?php echo form_close(); ?>
	</div>
</div>