$(document).ready(function() {
    $("#registerclient").validate({
        errorElement: "div",
        errorPlacement: function(e, t) {
            /*if (t.attr("name") == "data[User][contact1]" || t.attr("name") == "data[User][contact2]") {
                e.insertAfter("#error-note1")
            } else */if (t.attr("name") == "data[User][termandconditions]") {
                e.insertAfter("#error-note")
            } else {
                e.insertAfter(t)
            }
        },
        rules: {
            "data[User][email]": {
                required: true,
                email: true
            },
            "data[User][password]": {
                required: true,
                NoWhiteSpace: true,
                minlength: 6,
                maxlength: 12
            },
            "data[User][confirmpassword]": {
                required: true,
                NoWhiteSpace: true,
                minlength: 6,
                maxlength: 12,
                equalTo: "#UserPassword"
            },
            "data[User][firstname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][lastname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][address1]": {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            "data[User][country_id]": {
                required: true
            },
            "data[User][state_id]": {
                required: true
            },
            "data[User][city_id]": {
                required: true
            },
            "data[User][zip_code]": {
                required: true,
                numeric_only: true,
                minlength: 3,
                maxlength: 5
            },
            "data[User][contact1]": {
                required: true,
                minlength: 11,
            }/*,
            "data[User][contact2]": {
                required: true,
                minlength: 5,
                numeric_only: true
            }*/,
            "data[User][termandconditions]": {
                required: true
            },
            "data[User][captcha]": {
                required: true,
                equalTo: "#UserConfirmcaptcha"
            }
        },
        messages: {
            "data[User][email]": {
                required: "Please enter the email address",
                email: "Please enter proper email address"
            },
            "data[User][password]": {
                required: "Please enter the password"
            },
            "data[User][confirmpassword]": {
                required: "Please enter the confirm password",
                equalTo: "Password and confirm password are not same"
            },
            "data[User][firstname]": {
                required: "Please enter firstname",
                minlength: "Firstname must be at least 2 character long",
                maxlength: "Entered Firstname should not be more than 25 characters"
            },
            "data[User][lastname]": {
                required: "Please enter lastname",
                minlength: "Lastname must be at least 2 character long",
                maxlength: "Entered Lastname should not be more than 25 characters"
            },
            "data[User][address1]": {
                required: "Please enter the address",
                minlength: "Address must be at least 3 character long",
                maxlength: "Entered address should not be more than 50 characters"
            },
            "data[User][country_id]": {
                required: ""
            },
            "data[User][state_id]": {
                required: ""
            },
            "data[User][city_id]": {
                required: ""
            },
            "data[User][zip_code]": {
                required: "Please enter the zip code",
                minlength: "Zip code must be at least 3 digit long",
                maxlength: "Zip code must be not more than 5 digit long"
            },
            "data[User][contact1]": {
                required: "Please enter contact number in format xxxx-xxx-xxx",
                minlength: "Contact number must be in proper format xxxx-xxx-xxx"
            }/*,
            "data[User][contact2]": {
                required: "Please enter second contact number",
                minlength: "Second contact number must be at least 5 digit long"
            }*/,
            "data[User][termandconditions]": {
                required: "Please select the terms and conditions"
            },
            "data[User][captcha]": {
                required: "Please enter the above captcha",
                equalTo: "Entered captcha must be same as above"
            }
        }
    });
    $("#UserEditProfileForm").validate({
        errorElement: "div",
        /*errorPlacement: function(e, t) {
            if (t.attr("name") == "data[User][contact1]" || t.attr("name") == "data[User][contact2]") {
                e.insertAfter("#displayerror")
            } else {
                e.insertAfter(t)
            }
        },*/
        rules: {
            "data[User][firstname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][lastname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][address1]": {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            "data[User][country_id]": {
                required: true
            },
            "data[User][state_id]": {
                required: true
            },
            "data[User][city_id]": {
                required: true
            },
            "data[User][zip_code]": {
                required: true,
                numeric_only: true,
                minlength: 3,
                maxlength: 5
            },
            "data[User][contact1]": {
                required: true,
                minlength: 11
            }/*,
            "data[User][contact2]": {
                required: true,
                minlength: 5,
                numeric_only: true
            }*/
        },
        messages: {
            "data[User][firstname]": {
                required: "Please enter firstname",
                minlength: "Firstname must be at least 2 character long",
                maxlength: "Entered Firstname should not be more than 25 characters"
            },
            "data[User][lastname]": {
                required: "Please enter lastname",
                minlength: "Lastname must be at least 2 character long",
                maxlength: "Entered Lastname should not be more than 25 characters"
            },
            "data[User][address1]": {
                required: "Please enter the address",
                minlength: "Address must be at least 3 character long",
                maxlength: "Entered address should not be more than 50 characters"
            },
            "data[User][country_id]": {
                required: "Please select country"
            },
            "data[User][state_id]": {
                required: "Please select state"
            },
            "data[User][city_id]": {
                required: "Please select city"
            },
            "data[User][zip_code]": {
                required: "Please enter the zip code",
                minlength: "Zip code must be at least 3 digit long",
                maxlength: "Zip code must be not more than 5 digit long"
            },
            "data[User][contact1]": {
                required: "Please enter contact number in format xxxx-xxx-xxx",
                minlength: "Contact number must be in proper format xxxx-xxx-xxx"
            }/*,
            "data[User][contact2]": {
                required: "Please enter second contact number",
                minlength: "Second contact number must be at least 5 digit long"
            }*/
        }
    });
    
    $("#ContractorEditProfile").validate({
        errorElement: "div",
        /*errorPlacement: function(e, t) {
            if (t.attr("name") == "data[User][contact1]" || t.attr("name") == "data[User][contact2]") {
                e.insertAfter("#displayerror")
            } else {
                e.insertAfter(t)
            }
        },*/
        rules: {
            "data[User][firstname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][lastname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][address1]": {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            "data[User][country_id]": {
                required: true
            },
            "data[User][state_id]": {
                required: true
            },
            "data[User][city_id]": {
                required: true
            },
            "data[User][zip_code]": {
                required: true,
                numeric_only: true,
                minlength: 3,
                maxlength: 5
            },
            "data[User][contact1]": {
                required: true,
                minlength: 11
            }/*,
            "data[User][contact2]": {
                required: true,
                minlength: 5,
                numeric_only: true
            }*/
        },
        messages: {
            "data[User][firstname]": {
                required: "Please enter firstname",
                minlength: "Firstname must be at least 2 character long",
                maxlength: "Entered Firstname should not be more than 25 characters"
            },
            "data[User][lastname]": {
                required: "Please enter lastname",
                minlength: "Lastname must be at least 2 character long",
                maxlength: "Entered Lastname should not be more than 25 characters"
            },
            "data[User][address1]": {
                required: "Please enter the address",
                minlength: "Address must be at least 3 character long",
                maxlength: "Entered address should not be more than 50 characters"
            },
            "data[User][country_id]": {
                required: "Please select country"
            },
            "data[User][state_id]": {
                required: "Please select state"
            },
            "data[User][city_id]": {
                required: "Please select city"
            },
            "data[User][zip_code]": {
                required: "Please enter the zip code",
                minlength: "Zip code must be at least 3 digit long",
                maxlength: "Zip code must be not more than 5 digit long"
            },
            "data[User][contact1]": {
                required: "Please enter contact number in format xxxx-xxx-xxx",
                minlength: "Contact number must be in proper format xxxx-xxx-xxx"
            }/*,
            "data[User][contact2]": {
                required: "Please enter second contact number",
                minlength: "Second contact number must be at least 5 digit long"
            }*/
        }
    });
    
    $("#ProjectAddForm").validate({
        errorElement: "div",
        rules: {
            "data[Project][name]": {
                required: true
            },
            "data[Project][description]": {
                required: true,
                minlength: 25
            },
            "data[Project][budget]": {
                required: true
            },
            "data[Project][start_date]": {
                required: true
            },
            "data[Project][knowledge]": {
                required: true
            },
            "data[Project][to_service_category_id][]": {
                required: true
            },
            "data[Project][country_id]": {
                required: true
            },
            "data[Project][state_id]": {
                required: true
            },
            "data[Project][city_id]": {
                required: true
            },
            "data[Project][status]": {
                required: true
            }
        },
        messages: {
            "data[Project][name]": {
                required: "Please enter Project Title"
            },
            "data[Project][description]": {
                required: "Please enter Description",
                minlength: "Description must be at least 25 character long"
            },
            "data[Project][budget]": {
                required: "Please enter the project budget"
            },
            "data[Project][country_id]": {
                required: "Please select country"
            },
            "data[Project][state_id]": {
                required: "Please select state"
            },
            "data[Project][city_id]": {
                required: "Please select city"
            },
            "data[Project][start_date]": {
                required: "Please choose start date"
            },
            "data[Project][knowledge]": {
                required: "Please choose Project Knowledge"
            },
            "data[Project][to_service_category_id][]": {
                required: "Please select services"
            },
            "data[Project][status][]": {
                required: "Please select status"
            }
        }
    });
    $("#ProjectEditForm").validate({
        errorElement: "div",
        rules: {
            "data[Project][name]": {
                required: true
            },
            "data[Project][description]": {
                required: true,
                minlength: 25
            },
            "data[Project][budget]": {
                required: true
            },
            "data[Project][start_date]": {
                required: true
            },
            "data[Project][knowledge]": {
                required: true
            },
            "data[Project][to_service_category_id][]": {
                required: true
            },
            "data[Project][country_id]": {
                required: true
            },
            "data[Project][state_id]": {
                required: true
            },
            "data[Project][city_id]": {
                required: true
            },
            "data[Project][status]": {
                required: true
            }
        },
        messages: {
            "data[Project][name]": {
                required: "Please enter Project Title"
            },
            "data[Project][description]": {
                required: "Please enter Description",
                minlength: "Description must be at least 25 character long"
            },
            "data[Project][budget]": {
                required: "Please enter the project budget"
            },
            "data[Project][country_id]": {
                required: "Please select country"
            },
            "data[Project][state_id]": {
                required: "Please select state"
            },
            "data[Project][city_id]": {
                required: "Please select city"
            },
            "data[Project][start_date]": {
                required: "Please choose start date"
            },
            "data[Project][knowledge]": {
                required: "Please choose Project Knowledge"
            },
            "data[Project][to_service_category_id][]": {
                required: "Please select services"
            },
            "data[Project][status][]": {
                required: "Please select status"
            }
        }
    });
    $("#UserChangepasswordForm").validate({
        errorElement: "div",
        rules: {
            "data[User][old_password]": {
                required: true
            },
            "data[User][password]": {
                required: true,
                NoWhiteSpace: true,
                minlength: 6,
                maxlength: 12
            },
            "data[User][confirmpassword]": {
                required: true,
                NoWhiteSpace: true,
                minlength: 6,
                maxlength: 12,
                equalTo: "#UserPassword"
            }
        },
        messages: {
            "data[User][old_password]": {
                required: "Please enter Old Password"
            },
            "data[User][password]": {
                required: "Please enter the password"
            },
            "data[User][confirmpassword]": {
                required: "Please enter the confirm password",
                equalTo: "Password and confirm password are not same"
            }
        }
    });
    $("#UserChangeEmailForm").validate({
        errorElement: "div",
        rules: {
            "data[User][old_email]": {
                required: true,
                NoWhiteSpace: true,
                email: true,
                maxlength: 50
            },
            "data[User][email]": {
                required: true,
                NoWhiteSpace: true,
                email: true,
                maxlength: 50
            }
        },
        messages: {
            "data[User][old_email]": {
                required: "Please enter the old email address",
                email: "Please enter proper email address",
                maxlength: "Entered email address should not be more than 50 characters"
            },
            "data[User][email]": {
                required: "Please enter the New email address",
                email: "Please enter proper email address",
                maxlength: "Entered email address should not be more than 50 characters"
            }
        }
    });
    $("#composemessage").validate({
        errorElement: "div",
        rules: {
            "data[Message][to_id]": {
                required: true
            },
            "data[Message][messages]": {
                required: true,
                minlength: 3,
                maxlength: 255
            }
        },
        messages: {
            "data[Message][to_id]": {
                required: "Please select the user to whom you want to send the message"
            },
            "data[Message][messages]": {
                required: "Please enter the message",
                minlength: "Please enter atleast 3 characters in the message",
                maxlength: "Entered message should not be more than 255 characters in length"
            }
        }
    });
    $("#forwardmessage1").validate({
        errorElement: "div",
        rules: {
            "data[Message][to_id]": {
                required: true
            },
            "data[Message][messages]": {
                required: true,
                minlength: 3,
                maxlength: 255
            }
        },
        messages: {
            "data[Message][to_id]": {
                required: "Please select the user to whom you want to send the message"
            },
            "data[Message][messages]": {
                required: "Please enter the message",
                minlength: "Please enter atleast 3 characters in the message",
                maxlength: "Entered message should not be more than 255 characters in length"
            }
        }
    });
    $("#replymessage1").validate({
        errorElement: "div",
        rules: {
            "data[Message][reply_messages]": {
                required: true,
                minlength: 3,
                maxlength: 255
            }
        },
        messages: {
            "data[Message][reply_messages]": {
                required: "Please enter the message",
                minlength: "Please enter at least 3 characters in the message",
                maxlength: "Entered message should not be more than 255 characters in length"
            }
        }
    });
    $("#frontendlogin").validate({
        errorElement: "div",
        rules: {
            "data[User][email]": {
                required: true,
                NoWhiteSpace: true,
                email: true,
                maxlength: 50
            },
            "data[User][password]": {
                required: true,
                NoWhiteSpace: true,
                minlength: 6,
                maxlength: 12
            }
        },
        messages: {
            "data[User][email]": {
                required: "Please enter the email address",
                email: "Please enter proper email address",
                maxlength: "Entered email address should not be more than 50 characters"
            },
            "data[User][password]": {
                required: "Please enter the password",
                minlength: "Entered password should be atleast 6 characters",
                maxlength: "Entered password should not be more than 12 characters"
            }
        }
    });
    $("#frontendforgotemail").validate({
        errorElement: "div",
        rules: {
            "data[User][email]": {
                required: true,
                NoWhiteSpace: true,
                email: true,
                maxlength: 50
            }
        },
        messages: {
            "data[User][email]": {
                required: "Please enter the email address",
                email: "Please enter proper email address",
                maxlength: "Entered email address should not be more than 50 characters"
            }
        }
    });
    $("#MessageComposeForm").validate({
        errorElement: "div",
        rules: {
            "data[Message][messages]": {
                required: true,
                minlength: 3,
                maxlength: 255
            }
        },
        messages: {
            "data[Message][messages]": {
                required: "Please enter the message",
                minlength: "Please enter atleast 3 characters in the message",
                maxlength: "Entered message should not be more than 255 characters in length"
            }
        }
    });
    $("#SocialMediaLinkMySocialLinkForm").validate({
        errorElement: "div",
        rules: {
            "data[SocialMediaLink][link_name][]": {
                required: true
            },
            "data[SocialMediaLink][link_url][]": {
                required: true,
                url: true
            }
        },
        messages: {
            "data[SocialMediaLink][link_name][]": {
                required: "Please enter the link name"
            },
            "data[SocialMediaLink][link_url][]": {
                required: "Please enter the link url"
            }
        }
    });
    
    $("#UserRegisterStep1Form").validate({
        errorElement: "div",
        rules: {
            "data[User][email]": {
                required: true,
                email: true
            },
            "data[User][password]": {
                required: true,
                NoWhiteSpace: true,
                minlength: 6,
                maxlength: 12
            },
            "data[User][confirmpassword]": {
                required: true,
                NoWhiteSpace: true,
                minlength: 6,
                maxlength: 12,
                equalTo: "#UserPassword"
            }
        },
        messages: {
            "data[User][email]": {
                required: "Please enter the email address",
                email: "Please enter proper email address"
            },
            "data[User][password]": {
                required: "Please enter the password"
            },
            "data[User][confirmpassword]": {
                required: "Please enter the confirm password",
                equalTo: "Password and confirm password are not same"
            }
        }
    });
    $("#UserRegisterStep2Form").validate({
        errorElement: "div",
		/*errorPlacement: function(e, t) {
            if (t.attr("name") == "data[User][contact1]" || t.attr("name") == "data[User][contact2]") {
                e.insertAfter("#displayerror")
            } else if (t.attr("name") == "data[User][mailing_contact1]" || t.attr("name") == "data[User][mailing_contact2]") {
                e.insertAfter("#displayerror1")
            } else {
                e.insertAfter(t)
            }
			
        },*/
        rules: {
            "data[User][company_name]": {
                required: true
            },
            "data[User][no_of_emp]": {
                required: true
            },
            "data[User][firstname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][lastname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][address1]": {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            "data[User][country_id]": {
                required: true
            },
            "data[User][state_id]": {
                required: true
            },
            "data[User][city_id]": {
                required: true
            },
            "data[User][zip_code]": {
                required: true,
                numeric_only: true,
                minlength: 3,
                maxlength: 5
            },
            "data[User][contact1]": {
                required: true,
                minlength: 11,
            },
            "data[User][fax]": {
                required: true,
                minlength: 10
            },
            "data[User][to_service_category_id][]": {
                required: true
            },
            "data[User][mailing_address1]": {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            "data[User][mailing_country_id]": {
                required: true
            },
            "data[User][mailing_state_id]": {
                required: true
            },
            "data[User][mailing_city_id]": {
                required: true
            },
            "data[User][mailing_zip_code]": {
                required: true,
                numeric_only: true,
                minlength: 3,
                maxlength: 5
            },
            "data[User][mailing_contact1]": {
                required: true,
                minlength: 11
            },
            "data[User][mailing_fax]": {
                required: true,
                minlength: 10
            },
            "data[User][captcha]": {
                required: true
            }
        },
        messages: {
            "data[User][company_name]": {
                required: "Please enter Company Name"
            },
            "data[User][firstname]": {
                required: "Please enter firstname",
                minlength: "Firstname must be at least 2 character long",
                maxlength: "Entered Firstname should not be more than 25 characters"
            },
            "data[User][lastname]": {
                required: "Please enter lastname",
                minlength: "Lastname must be at least 2 character long",
                maxlength: "Entered Lastname should not be more than 25 characters"
            },
            "data[User][address1]": {
                required: "Please enter the address",
                minlength: "Address must be at least 3 character long",
                maxlength: "Entered address should not be more than 50 characters"
            },
            "data[User][country_id]": {
                required: "Please select country"
            },
            "data[User][state_id]": {
                required: "Please select state"
            },
            "data[User][city_id]": {
                required: "Please select city"
            },
            "data[User][zip_code]": {
                required: "Please enter the zip code",
                minlength: "Zip code must be at least 3 digit long",
                maxlength: "Zip code must be not more than 5 digit long"
            },
            "data[User][contact1]": {
                required: "Please enter contact number in format xxxx-xxx-xxx"
            },
            "data[User][fax]": {
                required: "Please enter proper fax number"
            },
            "data[User][to_service_category_id]": {
                required: "Please select category"
            },
            "data[User][mailing_address1]": {
                required: "Please enter the address",
                minlength: "Address must be at least 3 character long",
                maxlength: "Entered address should not be more than 50 characters"
            },
            "data[User][mailing_country_id]": {
                required: "Please select country"
            },
            "data[User][mailing_state_id]": {
                required: "Please select state"
            },
            "data[User][mailing_city_id]": {
                required: "Please select city"
            },
            "data[User][mailing_zip_code]": {
                required: "Please enter the zip code",
                minlength: "Zip code must be at least 3 digit long",
                maxlength: "Zip code must be not more than 5 digit long"
            },
            "data[User][mailing_contact1]": {
                required: "Please enter contact number in format xxxx-xxx-xxx"
            },
            "data[User][mailing_fax]": {
                required: "Please enter proper mailing fax number"
            },
            
            "data[User][captcha]": {
                required: "Please enter captcha value"
            }
        }
    });
    $("#UserRegisterStep3Form").validate({
        errorElement: "div",
        rules: {
            "data[User][registration_type]": {
                required: true
            }
        },
        messages: {
            "data[User][registration_type]": {
                required: "Please Select Registration type"
            }
        }
    });
 /*   $("#UserRegisterStep4Form").validate({
        errorElement: "div",
        errorPlacement: function(e, t) {
            if (t.attr("name") == "data[User][payment_type]") {
                e.insertAfter("#error-note")
            } else if (t.attr("name") == "data[User][card_no1]" || t.attr("name") == "data[User][card_no2]" || t.attr("name") == "data[User][card_no3]" || t.attr("name") == "data[User][card_no4]") {
                e.insertAfter("#error-note1")
            } else if (t.attr("name") == "data[User][hear_about_us]") {
                e.insertAfter("#error-note2")
            } else if (t.attr("name") == "data[User][all_answer]") {
                e.insertAfter("#error-note3")
            } else if (t.attr("name") == "data[User][all_read]") {
                e.insertAfter("#error-note4")
            } else {
                e.insertAfter(t)
            }
        },
        rules: {
            "data[User][payment_type]": {
                required: true
            },
            "data[User][card_no1]": {
                required: true,
                minlength: 4,
                numeric_only: true
            },
            "data[User][card_no2]": {
                required: true,
                minlength: 4,
                numeric_only: true
            },
            "data[User][card_no3]": {
                required: true,
                minlength: 4,
                numeric_only: true
            },
            "data[User][card_no4]": {
                required: true,
                minlength: 3,
                numeric_only: true
            },
            "data[User][card_full_name]": {
                required: true
            },
            "data[User][card_expiry_date_month]": {
                required: true
            },
            "data[User][card_expiry_date_year]": {
                required: true
            },
            "data[User][cvv_no]": {
                required: true,
                minlength: 3,
                numeric_only: true
            },
            "data[User][hear_about_us]": {
                required: true
            },
            "data[User][all_answer]": {
                required: true
            },
            "data[User][all_read]": {
                required: true
            }
        },
        messages: {
            "data[User][payment_type]": {
                required: "Please Select Payment type"
            },
            "data[User][card_no1]": {
                required: "Please enter card1 value",
                minlength: "Atleast 4 digit",
                numeric_only: "Numbers Only"
            },
            "data[User][card_no2]": {
                required: "Please enter card2 value",
                minlength: "Atleast 4 digit",
                numeric_only: "Numbers Only"
            },
            "data[User][card_no3]": {
                required: "Please enter card3 value",
                minlength: "Atleast 4 digit",
                numeric_only: "Numbers Only"
            },
            "data[User][card_no4]": {
                required: "Please enter card4 value",
                minlength: "Atleast 3 digit",
                numeric_only: "Numbers Only"
            },
            "data[User][card_full_name]": {
                required: "Please enter card Full Name"
            },
            "data[User][card_expiry_date_month]": {
                required: "Please Select month"
            },
            "data[User][card_expiry_date_year]": {
                required: "Please Select Year"
            },
            "data[User][cvv_no]": {
                required: "Please Enter cvv no",
                minlength: "Atleast 3 digit",
                numeric_only: "Numbers Only"
            },
            "data[User][hear_about_us]": {
                required: "Please Select one of the above"
            },
            "data[User][all_answer]": {
                required: "confirm all answers"
            },
            "data[User][all_read]": {
                required: "confirm all read"
            }
        }
    }); */
    $("#add_contractor_user").validate({
        errorElement: "div",
        rules: {
            "data[User][firstname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][lastname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[User][address1]": {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            "data[User][country_id]": {
                required: true
            },
            "data[User][state_id]": {
                required: true
            },
            "data[User][city_id]": {
                required: true
            },
            "data[User][zip_code]": {
                required: true,
                numeric_only: true,
                minlength: 3,
                maxlength: 5
            },
            "data[User][contact1]": {
                required: true,
                minlength: 11
            },
            /*"data[User][contact2]": {
                required: true,
                minlength: 5,
                numeric_only: true
            },*/
            "data[User][email]": {
                required: true,
                email: true
            }
        },
        messages: {
            "data[User][firstname]": {
                required: "Please enter firstname",
                minlength: "Firstname must be at least 2 character long",
                maxlength: "Entered Firstname should not be more than 25 characters"
            },
            "data[User][lastname]": {
                required: "Please enter lastname",
                minlength: "Lastname must be at least 2 character long",
                maxlength: "Entered Lastname should not be more than 25 characters"
            },
            "data[User][address1]": {
                required: "Please enter the address",
                minlength: "Address must be at least 3 character long",
                maxlength: "Entered address should not be more than 50 characters"
            },
            "data[User][country_id]": {
                required: "Please select country"
            },
            "data[User][state_id]": {
                required: "Please select state"
            },
            "data[User][city_id]": {
                required: "Please select city"
            },
            "data[User][zip_code]": {
                required: "Please enter the zip code",
                minlength: "Zip code must be at least 3 digit long",
                maxlength: "Zip code must be not more than 5 digit long"
            },
            "data[User][contact1]": {
                required: "Enter Contact number in format xxxx-xxx-xxx",
                minlength: "Contact number must be in proper format xxxx-xxx-xxx"
            },
            /*"data[User][contact2]": {
                required: "Enter Contact Digits",
                minlength: "Second contact number must be at least 5 digit long"
            },*/
            
            "data[User][email]": {
                required: "Please enter the email address",
                email: "Please enter proper email address"
            }
        }
    });
    $("#ContractorUserEditUserForm").validate({
        errorElement: "div",
        rules: {
            "data[ContractorUser][firstname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[ContractorUser][lastname]": {
                required: true,
                minlength: 2,
                maxlength: 25,
                alpha_only: true
            },
            "data[ContractorUser][address1]": {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            "data[ContractorUser][country_id]": {
                required: true
            },
            "data[ContractorUser][state_id]": {
                required: true
            },
            "data[ContractorUser][city_id]": {
                required: true
            },
            "data[ContractorUser][zip_code]": {
                required: true,
                numeric_only: true,
                minlength: 3,
                maxlength: 5
            },
            "data[ContractorUser][contact1]": {
                required: true,
                minlength: 11
            },
            /*"data[ContractorUser][contact2]": {
                required: true,
                minlength: 5,
                numeric_only: true
            },*/
            
            "data[ContractorUser][email]": {
                required: true,
                email: true
            }
        },
        messages: {
            "data[ContractorUser][firstname]": {
                required: "Please enter firstname",
                minlength: "Firstname must be at least 2 character long",
                maxlength: "Entered Firstname should not be more than 25 characters"
            },
            "data[ContractorUser][lastname]": {
                required: "Please enter lastname",
                minlength: "Lastname must be at least 2 character long",
                maxlength: "Entered Lastname should not be more than 25 characters"
            },
            "data[ContractorUser][address1]": {
                required: "Please enter the address",
                minlength: "Address must be at least 3 character long",
                maxlength: "Entered address should not be more than 50 characters"
            },
            "data[ContractorUser][country_id]": {
                required: "Please select country"
            },
            "data[ContractorUser][state_id]": {
                required: "Please select state"
            },
            "data[ContractorUser][city_id]": {
                required: "Please select city"
            },
            "data[ContractorUser][zip_code]": {
                required: "Please enter the zip code",
                minlength: "Zip code must be at least 3 digit long",
                maxlength: "Zip code must be not more than 5 digit long"
            },
            "data[ContractorUser][contact1]": {
                required: "Enter proper contact number in format xxxx-xxx-xxx",
                minlength: "Contact number must be in proper format xxxx-xxx-xxx"
            },
            /*"data[ContractorUser][contact2]": {
                required: "Enter Contact Digits",
                minlength: "Second contact number must be at least 5 digit long"
            },*/
            "data[ContractorUser][email]": {
                required: "Please enter the email address",
                email: "Please enter proper email address"
            }
        }
    });
    $("#addinvoice,#InvoiceEditInvoiceForm").validate({
        errorElement: "div",
        rules: {
            "data[Invoice][client_id]": {
                required: true
            },
            "data[Invoice][inv_date]": {
                required: true
            },
            "data[Invoice][due]": {
                required: true
            },
            "data[Invoice][currency]": {
                required: true
            },
            "data[Invoice][currency_code]": {
                required: true
            },
            "data[Invoice][notes]": {
                required: true,
                minlength: 2,
                maxlength: 255
            }
        },
        messages: {
            "data[Invoice][client_id]": {
                required: "Please select the client"
            },
            "data[Invoice][inv_date]": {
                required: "Please select the invoice date"
            },
            "data[Invoice][due]": {
                required: "Please select the invoice due days"
            },
            "data[Invoice][currency]": {
                required: "Please select the currency symbol"
            },
            "data[Invoice][currency_code]": {
                required: "Please select the currency code"
            },
            "data[Message][notes]": {
                required: "Please enter the message note",
                minlength: "Please enter atleast 2 characters in the message note",
                maxlength: "Entered message note should not be more than 255 characters in length"
            }
        }
    });
    $("#FeedbackFeedbackForm").validate({
        errorElement: "div",
        rules: {
            "data[Feedback][review]": {
                required: true
            },
            "data[Feedback][reliability]": {
                required: true
            },
            "data[Feedback][communication]": {
                required: true
            },
            "data[Feedback][skills]": {
                required: true
            },
            "data[Feedback][value/cost]": {
                required: true
            },
            "data[Feedback][professionalism]": {
                required: true
            }
        },
        messages: {
            "data[Feedback][review]": {
                required: "Please Enter the review"
            },
            "data[Feedback][reliability]": {
                required: "Please rate for reliability"
            },
            "data[Feedback][communication]": {
                required: "Please select the invoice due days"
            },
            "data[Feedback][skills]": {
                required: "Please select the currency symbol"
            },
            "data[Feedback][value/cost]": {
                required: "Please select the currency code"
            },
            "data[Feedback][professionalism]": {
                required: "Please select the currency code"
            }
        }
    });
    $("#OwnerBuilderSendConnectionRequestForm").validate({
        errorElement: "div",
        rules: {
            "data[Ownerbuilder][id]": {
                required: true
            }
        },
        messages: {
            "data[Ownerbuilder][id]": {
                required: "Please Select the project First"
            }
        }
    });
    //update for strip payment
    //$("#UserUpgradePlanForm,#UserPayPerRequestForm").validate({
    $("#updateCardDetailForm,#UserUpgradePlanForm,#UserPayPerRequestForm").validate({
        errorElement: "div",
        errorPlacement: function(e, t) {
            if (t.attr("name") == "data[User][payment_type]") {
                e.insertAfter("#error-note")
            } else if (t.attr("name") == "data[User][card_no1]" || t.attr("name") == "data[User][card_no2]" || t.attr("name") == "data[User][card_no3]" || t.attr("name") == "data[User][card_no4]") {
                e.insertAfter("#error-note1")
            } else if (t.attr("name") == "data[User][all_read]") {
                e.insertAfter("#error-note2")
            } else {
                e.insertAfter(t)
            }
        },
        rules: {
            "data[User][payment_type]": {
                required: true
            },
            "data[User][card_no1]": {
                required: true,
                minlength: 4,
                numeric_only: true
            },
            "data[User][card_no2]": {
                required: true,
                minlength: 4,
                numeric_only: true
            },
            "data[User][card_no3]": {
                required: true,
                minlength: 4,
                numeric_only: true
            },
            "data[User][card_no4]": {
                required: true,
                minlength: 3,
                numeric_only: true
            },
            "data[User][card_full_name]": {
                required: true
            },
            "data[User][card_expiry_date_month]": {
                required: true
            },
            "data[User][card_expiry_date_year]": {
                required: true
            },
            "data[User][cvv_no]": {
                required: true,
                minlength: 3,
                numeric_only: true
            },
            "data[User][all_read]": {
                required: true
            }
        },
        messages: {
            "data[User][payment_type]": {
                required: "Please select your payment type"
            },
            "data[User][card_no1]": {
                required: "Please enter card1 value",
                minlength: "Atleast 4 digits required",
                numeric_only: "Numbers Only"
            },
            "data[User][card_no2]": {
                required: "Please enter card2 value",
                minlength: "Atleast 4 digits required",
                numeric_only: "Numbers Only"
            },
            "data[User][card_no3]": {
                required: "Please enter card3 value",
                minlength: "Atleast 4 digits required",
                numeric_only: "Numbers Only"
            },
            "data[User][card_no4]": {
                required: "Please enter card4 value",
                minlength: "Atleast 3 digits required",
                numeric_only: "Numbers Only"
            },
            "data[User][card_full_name]": {
                required: "Please enter card fullname"
            },
            "data[User][card_expiry_date_month]": {
                required: "Please Select month"
            },
            "data[User][card_expiry_date_year]": {
                required: "Please Select Year"
            },
            "data[User][cvv_no]": {
                required: "Please Enter cvv no",
                minlength: "Atleast 3 digits required",
                numeric_only: "Please enter numeric values only"
            },
            "data[User][all_read]": {
                required: "Please confirm that you have fully read, understood and agree to the owner-builder.com.au Terms & Condition."
            }
        }
    });
    
    $("#UserContactUsForm").validate({
        errorElement: "div",
		errorPlacement: function(e, t) {
            if (t.attr("name") == "data[User][email]") {
                e.insertAfter("#error-note1")
            } else {
                e.insertAfter(t)
            }
        },
        rules: {
		    "data[User][name]": {
                required: true
            },
			"data[User][email]": {
                required: true,
                email: true
            },
			"data[User][subject]": {
                required: true
            },
			"data[User][message]": {
                required: true,
                minlength: 10
			}
            
        },
        messages: {
		    "data[User][name]": {
                required: "Please enter the name"
            },
            "data[User][email]": {
                required: "Please enter the email address",
                email: "Please enter proper email address"
            },
            "data[User][subject]": {
                required: "Please Select the subject"
            },
            "data[User][message]": {
                required: "Please enter the message",
                minlength: "Please enter atleast 10 characters in the message note"
            }
        }
    });
	
	$("#UserPublicProfileForm").validate({
        errorElement: "div",
		
        rules: {
		    "data[Ownerbuilder][id]": {
                required: true
            }
			
            
        },
        messages: {
		    "data[Ownerbuilder][id]": {
                required: "Please Select Project First"
            }
            
        }
    });
})
