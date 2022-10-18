<html>
    <head>
        <title>Together</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dropzone.css">
        <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
        <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dropzone-5.7.0/dist/dropzone.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://unpkg.com/dropzone"></script>
		<script src="https://unpkg.com/cropperjs"></script>
    </head>
    <body>
        <?php
            if($this->session->userdata('logged_in')){
                if((time() - $this->session->userdata('logged_in_time')) > 86400){
                    redirect(base_url().'user/logout');
                };
            }else{
                redirect(base_url().'user/login');
            };
        ?>
        <div>
            <div class="nav d-flex container-fluid">
                <li class="nav-item col-4">
                    <div class="nav-box">
                        <a href="<?php echo base_url();?>post" class="nav-link">
                            <i class="material-icons">home</i>
                        </a>
                    </div>    
                </li>
                <li class="nav-item col-4">
                    <div class="nav-box" id="create-box">
                        <a href="<?php echo base_url();?>post/create" class="nav-link">
                            <i class="material-icons" id="create-btn">add</i>
                        </a>
                    </div>
                </li>
                <li class="nav-item col-4">
                    <div class="nav-box">
                        <a href="<?php echo base_url();?>social" class="nav-link">
                            <i class="material-icons">people</i>
                        </a>
                    </div>
                </li>
            </div>
            
    