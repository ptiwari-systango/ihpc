<div class="container">
	<div class="row">
		<div class="col-md-12">		
			<form action="" id="step1" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Review Title*</label>
					<input type="text" class="form-control" name="review_title" required="required" >
				</div>
				<div class="form-group">
					<label for="formGroupExampleInput2">Review Text*</label>
					<textarea class="form-control" name="review_text" required="required"></textarea>
				</div>
				<div class="form-group">
					<label>Upload Photo</label>
					<input type="file" name="add_photo[]" />
					<input type="file" name="add_photo[]" />
					<input type="file" name="add_photo[]" />
				</div>
				<div class="form-group">
					<label>Upload Video</label>
					<input type="file" name="add_video[]" />
					<input type="file" name="add_video[]" />
					<input type="file" name="add_video[]" />
				</div>
				<div class="form-group">
					<label>Company*</label>
					<input type="text" class="form-control" name="company" required="required">
				</div>
				<div class="form-group">
					<label>Product or Service</label>
					<input type="text" class="form-control" name="product_or_service">
				</div>
				<div class="form-group">
					<label>Category</label>
					<select name="company_category">
						<?php 
						$categories = get_ihpc_categories('companiestax',0);						
						if( !empty($categories) ){
							foreach ($categories as $key => $category) {
								echo '<option value="'.$category['term_taxonomy_id'].'">'.$category['name'].'</option>';
							}
						}						
						?>
					</select>
				</div>
				<div class="form-group">
					<input type="checkbox" required="required" name="readed_term_of_services" value="1"> I have read and agree to the I Hate Power Companies Terms of Services
				</div>
				<div class="form-group">					
					<input type="submit" value="Proceed">					
				</div>
			</form>
		</div>
	</div>
</div>



<script type="text/javascript">
jQuery(document).on('submit', '#step1', function(e){
    e.preventDefault();
    var fd 		= new FormData();
    var images 	= jQuery(document).find('input[name="add_photo[]"]');
    var videos 	= jQuery(document).find('input[name="add_video[]"]');
    var data 	= jQuery(this).serialize();
    //Adding photos in data
    for (var i = 0; i < images.length; i++) {
    	var add_image = "add_photo"+"-"+i;
    	fd.append(add_image,images[i].files[0]);
    };
    //Adding videos in data
    for (var i = 0; i < videos.length; i++) {
    	var add_video = "add_video"+"-"+i;
    	fd.append(add_video,videos[i].files[0]);
    };
    fd.append("form_json", data);  
    fd.append('action', 'submit_reivew_form');

    jQuery.ajax({
        type: 'POST',
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            window.location.href="response";
        }
    });
});
</script>