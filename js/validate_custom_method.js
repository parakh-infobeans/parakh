jQuery.validator.addMethod("noSpecial", function(value, element)
{
    return this.optional(element) || /^[a-z0-9_\.\-\@\'\ ]+$/i.test(value);
}, "Username must contain only letters, numbers, or underscore.");

jQuery.validator.addMethod("alpha", function(value, element)
{
    return this.optional(element) || /[a-zA-Z]$/i.test(value);
}, "Alphabets only");

jQuery.validator.addMethod("NoWhiteSpace", function(value, element) {
    return this.optional(element) || /^[^\s]/.test(value);
}, "Must not begin with a whitespace");

jQuery.validator.addMethod("noSpace", function(value, element) {
    return value.indexOf(" ") < 0 && value != "";
}, "No space please and don't leave it empty"

        );

jQuery.validator.addMethod("atleastone_number", function(value, element) {
    return (this.optional(element) || /\d/.test(value));
}, "Field must have at least one number");

jQuery.validator.addMethod("city_text", function(value, element) {
    var isValid = true;
    if (value.match(/[^a-zA-Z ]/g)) {
        isValid = false;
    }
    return isValid;
}, "Must not contain numbers");
jQuery.validator.addMethod("alpha_with_space", function(value, element) {
    var isValid = true;
    if (value.match(/[^a-zA-Z\.\,\-\_\& ]/g)) {
        isValid = false;
    }
    return isValid;
});
jQuery.validator.addMethod("alph_with_space_only", function(value, element) {
    var isValid = true;
    if (value.match(/[^a-zA-Z ]/g)) {
        isValid = false;
    }
    return isValid;
}, "Please enter characters only");
jQuery.validator.addMethod("search_text", function(value, element) {
    var isValid = true;
    if (value.match(/[^a-zA-Z0-9\.\,\-\_\&\@\'\" ]/g)) {
        isValid = false;
    }
    return isValid;
}, "Only alphanumeric and some special characters(.,-_&(){}$%%*[]@#?) allowed");
jQuery.validator.addMethod("amount", function(value, element) {
    var isValid = true;
    if (value.match(/[^0-9. ]/g)) {
        isValid = false;
    }
    return isValid;
}, "Invalid amount value");
jQuery.validator.addMethod("alpha_only", function(value, element) {
    var isValid = true;
    if (value.match(/[^a-zA-Z ]/g)) {
        isValid = false;
    }
    return isValid;
}, "Please enter characters only");
jQuery.validator.addMethod("alphanumeric_with_special_char", function(value, element) {
    var isValid = true;
    if (value.match(/[^a-zA-Z0-9\.\,\-\_\&\(\)\{\}\$\%\%\*\[\]\@\#\?\'\" ]/g)) {
        isValid = false;
    }
    return isValid;
}, "Only alphanumeric and some special characters(.,-_&(){}$%%*[]@#?'\") allowed");

jQuery.validator.addMethod("numeric_only", function(value, element) {
    var isValid = true;
    if (value.match(/[^0-9 ]/g)) {
        isValid = false;
    }
    return isValid;
}, "Please enter numbers only");

jQuery.validator.addMethod("description_text", function(value, element) {
    var isValid = true;
    if (value.match(/[^a-zA-Z0-9\.\,\-\_\&\(\)\{\}\$\%\%\*\[\]\@\#\?\'\/\n" ]/g)) {
        isValid = false;
    }
    return isValid;
}, "Only alphanumeric and some special characters(.,-_&(){}$%%*[]@#?'\"/\n) allowed");

jQuery.validator.addMethod("allow_some_chars", function(value, element) {
    var isValid = true;
    var ck_name = /^\s*[a-zA-Z-& ,()'\s]+\s*$/;
    if (!ck_name.test(value)) {
        isValid = false;
    }
    return isValid;
}, "Only alphabets and some special characters(&-(),) are allowed");

jQuery.validator.addMethod("contactno_valid", function(value, element) {
    var isValid = true;
    var contact_no1 = $("#UserContact1").val().length;
    var contact_no2 = $("#UserContact2").val().length;
    var contact_no3 = $("#UserContact3").val().length;
    var total_len = contact_no1 + contact_no2 + contact_no3;
        if (total_len < 10){
            isValid = false;
        } else if(total_len > 11) {
            isValid = false;
        }
    return isValid;
}, "Contact number length must be between 10 and 11 digits");