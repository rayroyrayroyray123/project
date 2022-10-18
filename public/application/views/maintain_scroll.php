<script type="text/javascript">
    var a = 
    <?php 
    if(get_cookie('page_number') != null){
        echo get_cookie('page_number');
    };
    ?>
    
    var scroll;
    window.addEventListener('scroll', (event) => {
        scroll = this.scrollY;
        console.log(scroll);
    })
    window.onbeforeunload = function(){
        // document.cookie = scroll;  
        document.cookie = 'page_number=' + scroll;   
    };

    window.onload=function() {
        // var down = document.cookie();
        // console.log(down);
        
        window.scrollTo(0, a );
    };
</script>
<div class="container">
      <div class="col-4 offset-4">
      
			<div>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.


                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, 
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. 
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, 
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut 
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor.
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat 
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. 
                    Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. 
                    Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, 
                    non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
               
            </div>
	</div>
</div>