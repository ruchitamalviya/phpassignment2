jQuery(document).ready(function() {
    jQuery(".btn_action").click(function() {
        var clickText = jQuery(this).data('search-word');
        jQuery('#search').val(clickText);
        jQuery("#result").hide();

    });
});