<div class="container">
    <div class="col-6 offset-5">
        <?php echo $calendar; ?>
    </div>
    <div class="col-4 offset-4">
        <?php echo form_open(base_url().'Calendar/add_event'); ?>
            <?php echo $error; ?>
            <h2 class="text-center">Calendar</h2>       
                <div class="form-group">
                    <input type="date" class="form-control" required="required" name="date">
                </div>
                
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Description" required="required" name="detail">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Add event</button>
                </div>
                
        <?php echo form_close(); ?>
	</div>
</div>