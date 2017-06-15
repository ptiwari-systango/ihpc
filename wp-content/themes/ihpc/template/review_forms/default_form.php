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