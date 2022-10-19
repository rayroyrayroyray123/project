<div class="container">
    <div class="col-6 offset-5">
    </div>
    <div class="col-4 offset-4">
        <?php echo form_open(base_url().'Calendar/delete'); ?>
            
            <h2 class="text-center">The Event detail</h2>      
                
                <h4> Day of the event </h4>
                <?php echo $date ?>

                <h4> Description of the event </h4>
                <?php echo $description ?>

                <input type="hidden" name="calendar_detail" value=<?php echo $date ?> >
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Delete Event</button>
                </div>
        <?php echo form_close(); ?>

        <form action="https://infs3202-7976c100.uqcloud.net/book/Calendar">
            <input type="submit" class="btn btn-primary btn-block" value="Back to calendar" />
        </form>
	</div>
</div>