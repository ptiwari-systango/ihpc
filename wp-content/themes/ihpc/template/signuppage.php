<?php
ob_start();
/**
 * Template Name: Sign Up Page
 */
get_header('fullwidth');

/*
* If user is logged in then redirect it to home page.
*/
if ( is_user_logged_in() ) {
    wp_redirect( home_url() );
}

?>
<div class="sub-header text-center">
	<h1>Sign Up</h1>
	<p>Lorem Ipsum is simply dummy text of the printing <br>and typesetting industry.</p>
</div>
<!-- main-content -->
<div class="container pt-40">
	<div class="col-md-offset-3 col-md-6">
		<div class="connect_with_social text-uppercase text-center">
			<span>Connect with</span>
		</div>
		 <?php do_action( 'wordpress_social_login' ); ?> 
		<ul class="social_button">
			<li class="facebook"><a href="#x"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
			<li class="twitter"><a href="#x"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
			<li class="google_plus"><a href="#x"><i class="fa fa-google-plus" aria-hidden="true"></i>Google</a></li>
		</ul>
		<div class="connect_with_social text-uppercase text-center">
			<span>OR</span>
		</div>
		
		<div class="register_in">
			<div class="form-group">
				<label>Username<span class="mandatory">*</span></label>
				<input type="text" name="input1" class="form-control">
			</div>
			
			<div class="form-group mt-20">
				<label>Email<span class="mandatory">*</span></label>
				<input type="email" name="email1" class="form-control">
			</div>
			
			<div class="form-group mt-20">
				<label>Password<span class="mandatory">*</span></label>
				<input type="password" name="password1" class="form-control">
			</div>
			
			<div class="form-group mt-20">
				<label>Re-enter password<span class="mandatory">*</span></label>
				<input type="password" name="password2" class="form-control">
			</div>
			
			<div class="form-group mt-20">
				<label class="mb-0">Phone</label>
				<small class="grey mb-10">Please use international format for Phone entry.</small>
				<div class="input-group">
				  <div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">+1<span class="caret"></span></button>
					<ul class="dropdown-menu">
					  <li><a href="#">Action</a></li>
					  <li><a href="#">Another action</a></li>
					  <li><a href="#">Something else here</a></li>
					  <li role="separator" class="divider"></li>
					  <li><a href="#">Separated link</a></li>
					</ul>
				  </div><!-- /btn-group -->
				  <input type="text" class="form-control" aria-label="...">
				</div><!-- /input-group -->
			</div>
			
			<div class="check_mark mt-30">
				<input type="checkbox" name="remember" id="option1">
				<label for="option1"><small>I have read and agree to the I Hate Power Companies <a href="#x" class="red_link font-14">Terms of Service</a></small></label>				
			</div>
			
			<div class="form-group clearfix mt-15 captcha">
				<label>Code<span class="mandatory">*</span></label>
				<div class="clearfix"></div>
				<input type="text" name="password2" class="form-control">
				<a href="#x"><img src="images/reload.png"></a>
			</div>
			
			<div class="form-group mt-70">
				<a href="signup.html" class="text-uppercase site_btn">Sign Up</a>
				<a href="#x" class="btn btn-link text-uppercase">Cancel</a>
			</div>
		</div>
	</div>
</div>

<div class="signup_block text-right">
	<div class="container">
		<div class="col-md-offset-3 col-md-6">
			Already have an account? <a href="login.html" class="text-uppercase site_btn">Login</a>
		</div>
	</div>
</div>
<!-- main-content -->
<?php get_footer('fullwidth');?>