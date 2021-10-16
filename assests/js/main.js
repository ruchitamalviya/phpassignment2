jQuery(document).ready(function() {
    jQuery(document).on("click", ".btn_action", function() {
        var clickText = jQuery(this).data('search-word');  
        jQuery('#search').val(clickText);
        //console.log(clickText);
        jQuery("#result").hide();
    });
    jQuery(document).on("click", ".btn_del", function() {
        let rId = $(this).data("id");
        let element = this;
        if (confirm("Do you really want to delete this record")) {

            jQuery.ajax({
                url: "delete.php",
                type: "post",
                data: {
                    id: rId
                },
                success: function(data) {
                    if (data == 1) {
                        jQuery(element).closest("tr").fadeOut();
                    }
                }
            });
        }
    });
    jQuery(document).on("click", ".btn_edit", function() {
        let editId = $(this).data("edit-id");
        jQuery(this).parents('tr').find('td.edit_input').each(function() {
            let html = jQuery(this).text();
            let input = jQuery('<input type="text" class="update_word" name="updatevalue"  />');
            let saveBtn = jQuery('<button class="btn btn-success ml-2 save_btn" data-update-id=' + editId + '>Save</button>');
            input.val(html);
            jQuery(this).html(input).append(saveBtn);
        });
    });
    jQuery(document).on("click", ".save_btn", function(e) {
        e.preventDefault();
        let updateWord = jQuery(this).closest(".edit_input").find("input[name=updatevalue]").val();
        let editId = jQuery(this).data("update-id");
        let jqueyThis =  jQuery(this).closest('tr');
        //console.log(jQuery(this));
        jQuery.ajax({
            url: "update.php",
            type: "post",
            data: {
                'id': editId,
                'updatevalue': updateWord
            },
            success: function(data) {
                data = jQuery.parseJSON(data);
                if (data.success == 1) {
                    console.log(jQuery(jqueyThis).find('.btn_action'));
                    alert("Your data update successfully");
                    //jQuery(".btn_action").eq(0).data('search-word', updateWord);
                   
                    jQuery('.save_btn').remove();
                     //jQuery('.btn_action').find('.btn_action').eq(0).data('search-word', updateWord);
                    jQuery('.update_word').replaceWith(''+updateWord+'');
                   
                }
            }
        });
    });
});