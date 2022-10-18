<?php echo form_open_multipart('Image_controller/value');?>

<div class="row justify-content-center">
    <div class="col-md-4 col-md-offset-6 centered">
		<div class="form-group">
            <input type="file" name="userfile" size="20" /> 
        </div>

        <?php if( $watermark_image != "") { ?>
        <img src="<?php echo $watermark_image; ?>" alt="result"/>
        <?php } ?>
        
        <div class="form-group">
            <input type="radio" name="mode" value="rotate" >rotate
            <input type="radio" name="mode" value="resize">resize
            <input type="radio" name="mode" value="crop">crop
            <input type="radio" name="mode" value="watermark" checked>watermark
        </div>

		<div class="form-group">
            <input type="submit" value="upload" name = 'submit'/>
        </div>
        
    </div>
</div>


