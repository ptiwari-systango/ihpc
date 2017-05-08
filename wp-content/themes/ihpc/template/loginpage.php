<?php
/**
 * Template Name: Login Page
 */
?>
<?php get_header();?>
<br>
<br>

<script>

</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>-->
<a href="javascript:void(0);" onclick="fb_login();"><img src="http://localhost/ihpc/wp-content/uploads/2017/05/fb_icon_325x325.png" border="0" alt=""></a>

<!--<a href="javascript:void(0);" scope="public_profile,email" onclick="checkLoginState()">FACEBOOK</a>
<div id="status">
</div>
<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>-->
<?php get_footer();?>
