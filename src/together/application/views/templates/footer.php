        </div>
        <script>
            get_notifications();
            
            $("#cancel-btn").click(function(){
                $("#notification-panel").css('display','none');
            });
            $("#nofity-icon").click(function(){
                $("#notification-panel").css('display','inline');
            });

            function get_notifications(){
                var url = '<?=base_url();?>user/get_notifications/<?php echo $this->session->userdata('user_id');?>';
                {
                    $.ajax({
                        url:url,
                        method:"POST",
                        data:{},
                        cache: false,
                        success:function(data){
                            $('#notify_box').html('');
                            $('#notify_box').html(data);
                            if($('#total_notify').val()>0){
                                $("#nofity-icon").css('color', '#F37022');
                                $("#nofity-icon").html('notifications_active')
                            };
                        }
                    });
                }
            }
        </script>
    </body>
</html>