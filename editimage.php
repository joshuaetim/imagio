<?php

    include 'editcode.php';

?>

    <?php 
    $title = 'Edit Image - Imagio';
    include('includes/nav.php') ?>
    <div class="container">
        <h3 class="p-3">Edit Image</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="container controls">
                        <div class="form-group">
                            <label for="blur">Blur</label>
                            <p><input type="range" id="blur" name="blur" max="10" min="" value="0" class="edit custom-range w-75"></p>

                            <label for="blur">Brightness (<span id="bVal">100</span>)</label>
                            <p><input type="range" id="brightness" name="brightness" max="200" min="0" value="100" class="edit custom-range w-75"></p>

                            <!-- <label for="blur">Grayscale</label>
                            <p><input type="range" id="grayscale" name="grayscale" max="100" min="0" value="0" class="edit custom-range w-75"></p> -->

                            

                            <label for="blur">Opacity</label>
                            <p><input type="range" id="opacity" name="opacity" max="100" min="0" value="100" class="edit custom-range w-75"></p>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input edit" id="grayscale" name="example1" value="100">
                                <label class="custom-control-label" for="grayscale">Black & White</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input edit" id="invert" name="invert" value="100">
                                <label class="custom-control-label" for="invert">Invert</label>
                            </div>
                            
                        </div>
                            
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="image-preview">
                        </div>
                        <div id="result" class="ml-3">
                        
                        </div>
                        <form action="#" method="POST" class="container ml-2" enctype="multipart/form-data">
                            <p>
                                <?php
                                    if(isset($error)){
                                        echobr($error);
                                    }
                                ?>
                            </p>
                            <input type="hidden" name="user_id" value="<?=$query['id']?>">
                            <div class="form-group">
                                <label for="name">Image Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?=$imageDetails['title']?>">
                                <input type="hidden" id="location" value="<?=$imageDetails['location']?>">
                                <input type="hidden" id="id" value="<?=$imageDetails['id']?>">
                            </div>
                            <p>
                                <button type="submit" id="formSubmit" class="btn btn-primary">
                                    Apply Changes
                                </button>
                                
                                <!-- <img src="images/spin.gif" alt="" style="width: 40px;" class="spin hide"> -->
                            </p>
                        </form>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){

            /* AJAX call to load images after page has finished loading */

            $.ajax('editcode.php?id=<?=$id?>',
            {
                type: 'POST',
                data: {image: 'image'},
                beforeSend: function(){
                    $('.image-preview').html('<img src="images/loader.gif" class="p-3">');
                },
                success: function(data, status, xhr){
                    $('.image-preview').html(data);
                }
            }
            );

            /* Edit Buttons events */

            $('input.edit').on('change', function(){
                event.preventDefault();
                var blur = $('#blur').val();
                if($('#grayscale').prop("checked")){
                    var grayscale = $('#grayscale').val();
                    // alert('yes');
                }
                else{
                    var grayscale = 0;
                }
                if($('#invert').prop("checked")){
                    var invert = $('#invert').val();
                    // alert('yes');
                }
                else{
                    var invert = 0;
                }
                var brightness = $('#brightness').val();
                $('#bVal').text(brightness);
                var opacity = $('#opacity').val();
                $(".image-preview img").css('-webkit-filter', 'blur('+ blur + 'px) grayscale(' + grayscale +'%) brightness(' + brightness +'%) invert(' + invert +'%) opacity(' + opacity +'%)');
            });

            /* Form Submit event listener.
            This grabs the values from the input fields and passes them as AJAX POST variables. 
            This allows the edits to be done without the page reloading. 
            
            Note: The #grayscale and #invert fields are radio buttons, so they require a different type of value handling (binary, clicked or not, 0 or 100) */

            $("#formSubmit").on('click', function(){
                event.preventDefault();

                var blur = $('#blur').val();

                if($('#grayscale').prop("checked")){
                    var grayscale = $('#grayscale').val();
                }
                else{
                    var grayscale = 0;
                }
                if($('#invert').prop("checked")){
                    var invert = $('#invert').val();
                }
                else{
                    var invert = 0;
                }
                var brightness = $('#brightness').val();
                var opacity = $('#opacity').val();
                var location = $('#location').val();
                var id = $('#id').val();
                var title = $('#title').val();

                // ajax call to newImage.php

                $.ajax('newImage.php',{
                    type: "POST",
                    data: {edit:'valid', blur:blur, grayscale:grayscale, brightness:brightness, invert:invert, opacity:opacity, location:location, title:title, id:id},
                    beforeSend: function(){
                        $("#formSubmit").html('<img src="images/spin.gif" alt="" style="width: 20px;" class="spin hide"> Applying Changes ...');
                    },
                    success: function(data, status){
                        $("#result").html(data);
                        $("#formSubmit").html('Apply Changes');
                    }
                });
            });
            
        })
    </script>
</body>
</html>