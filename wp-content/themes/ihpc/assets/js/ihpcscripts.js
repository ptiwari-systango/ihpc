/**
 * All Scripts and functions
 */

jQuery(document).ready(function(){
    //console.log(ihcpvars.ihcp_ajax_url);
    //console.log(ihcpvars.ihcp_nonce);
    var ajaxurl = ihcpvars.ihcp_ajax_url;
    var ajaxurlnonce = ihcpvars.ihcp_nonce;
    //Adding class on body
    if (jQuery("body").hasClass("page")) {
        jQuery(".top_header").addClass("fixed")
    }

    //Home page search ajax company list
    //jQuery("#company_name").bind("keyup change", function(e) {
    jQuery("#company_name").bind("keyup", function(e) {
        var s_companyname = jQuery(this).val();
        jQuery.post(
            ajaxurl,
            {
                'action': 'home_search_title',
                'data':   s_companyname
            },
            function(response){
                //alert('The server responded: ' + response);
            }
        );
        console.log(s_companyname);
    });


});

// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        //testAPI();
    } else {
        // The person is not logged into your app or we are unable to tell.
       // document.getElementById('status').innerHTML = 'Please log ' +
                //'into this app.';
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '192419861278690',
        cookie     : true,  // enable cookies to allow the server to access
        oauth      : true,  // the oauth
        status     : true,
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.8' // use graph api version 2.8
    });


    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};



function fb_login(){
    FB.login(function(response) {
        if (response.authResponse) {
            //console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me',{fields: 'id,name,email,first_name,last_name,picture.type(large)'}, function(response) {
                user_fbid = response.id; //get user email
                user_email = response.email; //get user email
                user_fullname = response.name;
                user_fname = response.first_name; //get user first_name
                user_lname = response.last_name; //get user first_name
                user_picture = response.picture.data.url; //get user imagesrc
                //console.log(response);
                //console.log(response.picture.data.url);
                jQuery.ajax({
                    url : ajaxurl,
                    type : 'post',
                    data : {
                        action : 'ihpc_social_login',
                        'user_fbid'  : user_fbid,
                        'user_email' : user_email,
                        'user_fname' : user_fname,
                        'user_lname' : user_lname,
                        'user_fullname' : user_fullname,
                        'user_picture' : user_picture
                    },
                    success : function( response ) {
                        console.log(response);
                    },
                    error: function(xhr, ajaxOptions, thrownError)
                    {
                        //console.log(xhr.responseText);
                        //console.log(thrownError);
                    }
                });
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'email,public_profile,user_about_me',
        return_scopes:true
    });
}
/*(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());*/

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name);
       //document.getElementById('status').innerHTML =
        // 'Thanks for logging in, ' + response.name + '!';
    });
}


