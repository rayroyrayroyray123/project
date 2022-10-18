<div class="container">
    <div class="col-4 offset-4">
        <?php echo form_open(base_url().'CourseList/add_Course'); ?>
            <h2 class="text-center">Course List </h2>   
                <?php echo '<br><br>'; ?>  
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Course Name" required="required" name="courseName">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Course Detail" required="required" name="courseDetail">
                </div>
                <?php echo $error; ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Add course</button>
                </div>
                    
        <?php echo form_close(); ?>
    </div>
    <div class="col-7 offset-3">
        
        <table border=1 >
            <tr>
                <th>Course Name</th>
                <th>Course Detail</th>
                <th>Course Teacher</th>
                <th>Likes</th>
                <th>favorite</th>
            </tr>

            <?php $count=0; ?> 
            <?php foreach ($query->result() as $row){ ?>
                <?php echo form_open(base_url().'CourseList/add_favourite_course'); ?>
                <tr>
                    <td> <?php echo $row->course_name; ?>  </td>
                    <td> <?php echo $row->course_detail; ?>  </td>
                    <td> <?php echo $row->teacher; ?> </td>
                    <td> <?php echo $row->likes;?> </td>
                    <input type="hidden" name="<?php echo $count = $count + 1; ?>" value="<?php echo $row->course_name; ?>">
                    <td> <button type="submit" class="btn btn-primary btn-block">Favorite</button> </td>
                </tr>
                <?php echo form_close(); ?>
            <?php } ?>
        </table>
        
    </div>
    <!-- Reference -->
    <!-- https://developer.paypal.com/demo/checkout/#/pattern/client -->
    <div class="col-4 offset-4">
        <div id="paypal-button-container"></div>
        <!-- Include the PayPal JavaScript SDK -->
        <?php header("content-type:text/html;charset=utf-8"); ?>
        <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
        <script type="text/javascript">
            // Render the PayPal button into #paypal-button-container
            paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '88.44'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
            }).render('#paypal-button-container');
        </script>

        
    </div>
</div>

