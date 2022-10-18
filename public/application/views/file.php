<link href='dropzone.css' type='text/css' rel='stylesheet'>
<script src='dropzone.js' type='text/javascript'></script>
<?php echo form_open_multipart('upload/do_upload');?>
<?php echo form_open_multipart('upload/move_uploaded_file');?>
<div class="row justify-content-center">
    <div class="col-md-4 col-md-offset-6 centered">
        <?php echo $error;?>
		<div class="form-group">
            <input type="file" name="userfile" size="20" /> 
        </div>
		<div class="form-group">
            <input type="submit" value="upload" />
        </div>
    </div>
    
</div>
<div class="container" >
    <div class='content'>
        <form action="Upload.php" class="dropzone" id="dropzonewidget">
        </form> 
    </div> 
</div>
<?php echo form_close(); ?>
<h3></h3>
<div class="main"> </div>

