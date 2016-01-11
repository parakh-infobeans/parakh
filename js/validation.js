$(document).ready(function() {
    $("#edit_profile").validate({
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
            "google_email": {
                required: true,
                email: true
            },
            "mobile_number": {
                required: true,
                numeric_only: true,
                minlength: 10
            },
             "google_name": {
                required: true//,
                //alpha_only: true
            }
        },
        messages: {
            "google_email": {
                required: "Please enter the email.",
                email: "Please enter valid email."
            },
            "mobile_number": {
                required: "Please enter mobile number.",
                minlength: "Please enter mobile number."
               
            },
            "google_name": {
                required: "Please enter the name."/*,
                alpha_only : "Please enter only alphabets."*/
            }
        }
    });
    
    $("#manager_work").validate({
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
            "work_title": {
                required: true/*,
                alpha_only: true*/
            },
            "work_desc": {
                required: true,
            }
        },
        messages: {
            "work_title": {
                required: "Please enter title."/*,
                alpha_only : "Please enter only alphabets."*/
            },
            "work_desc": {
                required: "Please enter reason."
            }
        }
    });
    
    $("#manager_rating").validate({
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
            "work_title": {
                required: true/*,
                alpha_only: true*/
            },
            "work_desc": {
                required: true,
            },
            "team_member": {
                required: true,
                
            },
//            "rating": {
//                required: true,
//            }
        },
        messages: {
            "work_title": {
                required: "Please enter title."/*,
                alpha_only : "Please enter only alphabets."*/
            },
            "work_desc": {
                required: "Please enter reason."
            },
            "team_member": {
                required: "Please select a team member",
                ctype_digit: "Please select a team member"
            },
//            "rating": {
//                required: "Please give rating to team member."
//            }
        }
        
        
    });
    
    $("#manager_work_edit").validate({
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
            "work_title": {
                required: true/*,
                alpha_only: true*/
            },
            "work_desc": {
                required: true,
            }
        },
        messages: {
            "work_title": {
                required: "Please enter title."/*,
                alpha_only : "Please enter only alphabets."*/
            },
            "work_desc": {
                required: "Please enter reason."
            }
        }
    });
    
    $("#send_request").validate({
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
            "request_to": {
                required: true,
            }
        },
        messages: {
            "request_to": {
                required: "Please select value from dropdown.",
            }
        }
    });
});
    
