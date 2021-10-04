
// Validate Demo Request Form
$("#DemoRequestForm").validate({
    rules: {
        full_name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            minlength: 4
        }
        ,
        mobile: {
            required: true
        },
        designation: {
            required: true
        },
        company: {
            required: true
        },
        industry: {
            required: true
        }
    },
    messages: {
        full_name: {
            required: "Please Enter Name",
            minlength: "Name must consist of at least 3 characters"
        },
        email: {
            required: "Please provide a Email",
            minlength: "Email must be at least 4 characters long"
        },
        mobile: {
            required: "Please provide Mobile Number"
        },
        designation: {
            required: "Please Enter Designation"
        },
        company: {
            required: "Please Enter Company Name"
        },
        industry: {
            required: "Please Select Industry"
        }
    },

    submitHandler: function(form) {
        //Send Booking Mail AJAX
        var formdata = jQuery("#DemoRequestForm").serialize();
        jQuery.ajax({
            type:"POST",
            url:"contact_form/demo-request.php",
            data:formdata,
            dataType:'json',
            async: false,
            success:function(data){
                if(data.success){
                    swal("Thankyou!", "Your Request has been Sent!", "success");
                }else{
                    swal("Error!", "Error On Sending Request!", "error");
                }

            },
            error:function(error){
                swal("Error!", "Something Went Wrong!", "error");
            }

        });
    }
});

// Validate Contact Form
$("#ContactForm").validate({
    rules: {
        full_name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            minlength: 4
        }
        ,
        subject: {
            required: true
        },
        message: {
            required: true
        }
    },
    messages: {
        full_name: {
            required: "Please Enter Name",
            minlength: "Name must consist of at least 3 characters"
        },
        email: {
            required: "Please provide a Email",
            minlength: "Email must be at least 4 characters long"
        },
        subject: {
            required: "Please Enter Subject"
        },
        message: {
            required: "Please Enter Message"
        }
    },

    submitHandler: function(form) {
        //Send Booking Mail AJAX
        var formdata = jQuery("#ContactForm").serialize();
        jQuery.ajax({
            type:"POST",
            url:"contact_form/contact.php",
            data:formdata,
            dataType:'json',
            async: false,
            success:function(data){
                if(data.success){
                    swal("Thankyou!", "Your Message has been Sent!", "success");
                }else{
                    swal("Error!", "Error On Sending Message!", "error");
                }

            },
            error:function(error){
                swal("Error!", "Something Went Wrong!", "error");
            }

        });
    }
});

