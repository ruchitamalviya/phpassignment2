jQuery(document).ready(function() {
    jQuery('#first_error').hide();
    jQuery('#last_error').hide();
    jQuery('#email_error').hide();
    jQuery('#phone_error').hide();
    jQuery('#pass_error').hide();
    jQuery('#cpass_error').hide();
    jQuery('#web_error').hide();
    jQuery('#address_error').hide();
    var first_error = true;
    var last_error = true;
    var email_error = true;
    var phone_error = true;
    var pass_error = true;
    var cpass_error = true;
    var web_error = true;
    var address_error = true;
    jQuery('#first_name').keyup(function() {
        fnameValidation();
    })

    function fnameValidation() {
        var fname = jQuery('#first_name').val();
        if (fname.length == '') {
            jQuery('#first_error').show();
            jQuery('#first_error').html(" First Name Required");
            jQuery('#first_error').css("color", "red");
            first_error = false;
            return false;
        } else {
            jQuery('#first_error').hide();
        }
    }
    jQuery('#last_name').keyup(function() {
        lnameValidation();
    })

    function lnameValidation() {
        var lname = jQuery('#last_name').val();
        if (lname.length == '') {
            jQuery('#last_error').show();
            jQuery('#last_error').html(" Last Name Required");
            jQuery('#last_error').css("color", "red");
            last_error = false;
            return false;
        } else {
            jQuery('#last_error').hide();
        }
    }
    jQuery('#email').keyup(function() {
        emailValidation();
    })

    function emailValidation() {
        var email = jQuery('#email').val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (email.length == '') {
            jQuery('#email_error').show();
            jQuery('#email_error').html("Email Required");
            jQuery('#email_error').css("color", "red");
            email_error = false;
            return false;
        } else if (!emailReg.test(email)) {
            jQuery('#email_error').show();
            jQuery('#email_error').html("Enter Valid Email");
            jQuery('#email_error').css("color", "red");
            email_error = false;
            return false;
        } else {
            jQuery('#email_error').hide();
        }
    }
    jQuery('#phone').keyup(function() {
        phoneValidation();
    })

    function phoneValidation() {
        var phone = jQuery('#phone').val();
        if (phone.length == '') {
            jQuery('#phone_error').show();
            jQuery('#phone_error').html("Phone Number Required");
            jQuery('#phone_error').css("color", "red");
            phone_error = false;
            return false;
        }else if (isNaN(phone)) {
            jQuery('#phone_error').show();
            jQuery('#phone_error').html("Phone Number Must Be Numeric Value");
            jQuery('#phone_error').css("color", "red");
            phone_error = false;
            return false;
        } 
        else if (phone.length != 10) {
            jQuery('#phone_error').show();
            jQuery('#phone_error').html("Phone Number Must Be 10 Digit");
            jQuery('#phone_error').css("color", "red");
            phone_error = false;
            return false;
        }  else {
            jQuery('#phone_error').hide();
        }
    }
    jQuery('#password').keyup(function() {
        passValidation();
    })

    function passValidation() {
        var pass = jQuery('#password').val();
        if (pass.length == '') {
            jQuery('#pass_error').show();
            jQuery('#pass_error').html("Password required");
            jQuery('#pass_error').css("color", "red");
            pass_error = false;
            return false;
        } else if ((pass.length < 3) || (pass.length > 8)) {
            jQuery('#pass_error').show();
            jQuery('#pass_error').html("Password Must Be 3 to 8 Charcter");
            jQuery('#pass_error').css("color", "red");
            pass_error = false;
            return false;
        } else {
            jQuery('#pass_error').hide();
        }
    }
    jQuery('#password_confirmation').keyup(function() {
        cpassValidation();
    })

    function cpassValidation() {
        var cpass = jQuery('#password_confirmation').val();
        var pass = jQuery('#password').val();
        if (cpass.length == '') {
            jQuery('#cpass_error').show();
            jQuery('#cpass_error').html(" Conform Password Required");
            jQuery('#cpass_error').css("color", "red");
            cpass_error = false;
            return false;
        } else if (pass != cpass) {
            jQuery('#cpass_error').show();
            jQuery('#cpass_error').html("Password Did Not Match");
            jQuery('#cpass_error').css("color", "red");
            cpass_error = false;
            return false;
        } else {
            jQuery('#cpass_error').hide();
        }
    }
    jQuery('#weburl').keyup(function() {
        webValidation();
    })

    function webValidation() {
        var weburl = jQuery('#weburl').val();
        if (weburl.length == '') {
            jQuery('#web_error').show();
            jQuery('#web_error').html("Url Required");
            jQuery('#web_error').css("color", "red");
            web_error = false;
            return false
        } else {
            jQuery('#web_error').hide();
        }
    }
    jQuery('#address').keyup(function() {
        addValidation();
    })

    function addValidation() {
        var address = jQuery('#address').val();
        if (address.length == '') {
            jQuery('#address_error').show();
            jQuery('#address_error').html("Address Required");
            jQuery('#address_error').css("color", "red");
            address_error = false;
            return false
        } else {
            jQuery('#address_error').hide();
        }
    }
    jQuery("#submit").click(function() {
        first_error = true;
        last_error = true;
        email_error = true;
        phone_error = true;
        pass_error = true;
        cpass_error = true;
        web_error = true;
        address_error = true;
        fnameValidation();
        lnameValidation();
        emailValidation();
        phoneValidation();
        passValidation();
        cpassValidation();
        webValidation();
        addValidation();
        if ((first_error == true) && (last_error == true) && (email_error == true) && (phone_errorr == true) && (pass_error == true) && (cpass_error == true) && (web_error == true) && (address_error == true))
         {
               return true;
        } else {
            return false;
        }

    });

});