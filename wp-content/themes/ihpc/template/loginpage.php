<?php
ob_start();
/**
 * Template Name: Login Page
 */
?>
<?php 
get_header('fullwidth');

/*
* If user is logged in then redirect it to home page.
*/
if ( is_user_logged_in() ) {
    wp_redirect( home_url() );
}

/*
* User is trying to login into system.
*/
if( isset($_POST['submit_type']) && ($_POST['submit_type'] == 'login') ){
	$credentials['user_login'] 		= $_POST['user_login'];
	$credentials['user_password'] 	= $_POST['user_password'];
	if( !empty($_POST['remember'])	){
		$credentials['remember'] = $_POST['remember'];
	}	
	$response = wp_signon($credentials);	
	if( is_object($response) ){
		if(!empty($response->errors)){
			echo "<div style='margin-bottom:0' class='alert alert-danger text-center'>Invalid Login Credentials</div>";
		}
		else{
			wp_redirect( home_url() );
		}
	}	
}

?>

<div class="sub-header text-center">
	<h1>Login</h1>
	<p>Lorem Ipsum is simply dummy text of the printing <br>and typesetting industry.</p>
</div>
<!-- main-content -->
<div class="container pt-40">
	<div class="col-md-offset-3 col-md-6 col-xs-12 login_signup">
		<div class="connect_with_social text-uppercase text-center">
			<span>Connect with</span>
		</div>
		<ul class="social_button">
			<li class="facebook"><a href="#x"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
			<li class="twitter"><a href="#x"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
			<li class="google_plus"><a href="#x"><i class="fa fa-google-plus" aria-hidden="true"></i>Google</a></li>
		</ul>
		<div class="connect_with_social text-uppercase text-center">
			<span>OR</span>
		</div>	

		<form action="" method="post">
			<div class="register_in">
				<div class="form-group">
					<label>Email Address or Username<span class="mandatory">*</span></label>
					<input type="text" name="user_login" class="form-control">
				</div>
				<div class="form-group mt-20">
					<label>Your Password<span class="mandatory">*</span></label>
					<input type="password" name="user_password" class="form-control">
				</div>
				
				<div class="check_mark pull-left mt-20">
					<input type="checkbox" name="remember" value="1" id="option1">
					<label for="option1">Remember me</label>				
				</div>
				<a href="<?php echo wp_lostpassword_url() ?>" class="red_link pull-right mt-20">Forgot Password?</a>
				<div class="clearfix"></div>
				
				<div class="form-group mt-40">
					<input type="submit" name="submit_type" value="login" class="text-uppercase site_btn">
					<a href="#x" class="btn btn-link text-uppercase">Cancel</a>
				</div>
			</div>
		</form>

	</div>
</div>

<div class="signup_block text-right">
	<div class="container">
		<div class="col-md-offset-3 col-md-6">
			Not registered yet? <a href="<?php echo wp_registration_url(); ?>" class="text-uppercase site_btn">Sign Up</a>
		</div>
	</div>
</div>

<?php get_footer('fullwidth');?>
