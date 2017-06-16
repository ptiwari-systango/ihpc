<?php
/*
* $reviewId is populating from submitreview.php
* $screen_no is populating from submitreview.php
*/
?>
<form id="step3" method="post">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Where It Happened?</h1>
			</div>
			<div class="col-md-12">
				<label for="offline-business"><input name="business-type" value="offline-bussiness" checked="checked" type="radio">Offline business</label>
				<label for="offline-business"><input name="business-type" value="online-bussiness" type="radio">Online business</label>
			</div>
			<div class="col-md-12">
				<p class="hint">Choose company's location from the list or click on a marker.</p>
			</div>
			<div class="col-md-12">
				<label for="ComplaintForm_online_business_location">Company Website</label>
				<input name="ComplaintForm[online_business_location]" id="ComplaintForm_online_business_location" type="text">
			</div>
			<div class="col-md-12">
				<input type="submit" value="Proceed">
				<a href="<?php echo site_url()."/submit-review?screen_no=4&reviewId=$reviewId" ?>">Didn't find on the map</a>
            	<a href="<?php echo site_url()."/submit-review?screen_no=4&reviewId=$reviewId" ?>">Skip</a>
			</div>
		</div>
	</div>
</form>


<script type="text/javascript">
jQuery(document).on('submit', '#step3', function(e){
    e.preventDefault();
    var fd      = new FormData();    
    var data    = jQuery(this).serialize();    
    fd.append("form_json", data);
    fd.append("reviewId", <?php echo $reviewId ?>);  
    fd.append('action', 'review_additional_form');
    jQuery.ajax({
        type: 'POST',
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            //window.location.href="response";
            console.log(response);
        }
    });
});
</script>