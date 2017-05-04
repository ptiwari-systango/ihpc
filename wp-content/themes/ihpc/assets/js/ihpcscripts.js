/**
 * All Scripts and functions
 */

$(document).ready(function(){
    //console.log(ihcpvars.ihcp_ajax_url);
    //console.log(ihcpvars.ihcp_nonce);
    var ajaxurl = ihcpvars.ihcp_ajax_url;
    var ajaxurlnonce = ihcpvars.ihcp_nonce;
    //Adding class on body
    if ($("body").hasClass("page")) {
        $(".top_header").addClass("fixed")
    }

    //Home page search ajax company list
    //$("#company_name").bind("keyup change", function(e) {
    $("#company_name").bind("keyup", function(e) {
        var s_companyname = $(this).val();
        $.post(
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