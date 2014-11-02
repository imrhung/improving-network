$(function() {
    drawCategorySelect();
});

$(function() {
    // Variable to store your files
    var files;
    var baseUrl = $("#base-url").attr("href");

    // Add events
    $('input[type=file]').on('change', prepareUpload);
    $('form').on('submit', uploadFiles);

    // Grab the files and set them to our variable
    function prepareUpload(event) {
        files = event.target.files;
    }
    
    function uploadFiles(event){
        // Stop stuff happening.
        event.stopPropagation();
        event.preventDefault();
        
        // START A LOADING SPINNER HERE
        
    if($("#userfile").val() == ''){
        // Call function to create packet.
        createMember(event, null);
        return;
    }
        // Create a formdata object and add the files.
        var data = new FormData();
        $.each(files, function(key, value){
            data.append('userfile', value);
        });
        
        $.ajax({
            url: baseUrl + "api/file/upload",
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Do not process the file.
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data){
                if (data.code === 1){
                    console.log(data);
                    // SUCCESS.
                    // Call function to create packet.
                    createMember(event, data);
                } else {
                    // Error
                    console.log('ERRORS: '+ data.error);
                    showAlert('danger', "Error on uploading file!");
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log("ERRORS: " + textStatus);
                
                showAlert('danger', "Error on uploading file!");
            }
        });
    }
});

function drawCategorySelect() {
    var baseUrl = $("#base-url").attr("href");

    // Get category list
    $.ajax({
        type: 'GET',
        url: baseUrl + "api/service/category",
        dataType: "json",
        success: function(data) {
            console.log(data);
            var select = $('<select id="select-category" name="cateogry" class="form-control">').appendTo('#category');
            for (var i=0; i<data.length; i++){
                select.append($("<option>").attr('value', data[i].id).text(data[i].category_name));
            }
            $('#select-category').val(1);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on getting data!");
        }
    });
}

function createMember(event, data) {
    var baseUrl = $("#base-url").attr("href");
    
    var button = $('#submit');
    button.button('loading');
    
    // Bind data
    var business_name = $('#business_name').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var mail_address = $('#mail_address').val();
    var city = $('#city').val();
    var state = $('#state').val();
    var email = $('#email').val();
    var phone_number = $('#phone').val();
    var website = $('#website').val();
    var renew = $("input[name='new']:checked", '#member_form').val();
    var yearly_membership = $('#membership').val();
    var mem_to_mem_description = $('#mem2mem').val();
    
    var mem_to_mem_image_url = null;
    if (data !== null){
        mem_to_mem_image_url = baseUrl + "assets/upload/" +data.info.file_name;
    } else {
        
    }
    
    var prepay_meal = ($('#prepay').is(':checked'))? 1 : 0;
    var business_description = $('#description').val();
    var category_id = $('#select-category').val();
    
    // Post to api
    $.ajax({
        type: 'POST',
        //contentType: 'application/json',
        url: baseUrl + "api/service/member",
        dataType: "json",
        data: {
            business_name: business_name,
            first_name: first_name,
            last_name : last_name,
            mail_address : mail_address,
            city : city,
            state : state,
            email: email,
            phone_number : phone_number,
            website: website,
            renew : renew,
            yearly_membership : yearly_membership,
            mem_to_mem_description: mem_to_mem_description,
            mem_to_mem_image_url : mem_to_mem_image_url,
            prepay_meal : prepay_meal,
            business_description: business_description,
            category_id : category_id
        },
        success: function(data, textStatus, jqXHR) {
            console.log(data);
            // Show success
            showAlert('success', "Create member successful!");

            // Clear the form
            //resetForm($('#member_form'));
            
            // Reset button
            // Keep button disable: avoid user hit it and create a duplicate member.
            // button.button('reset');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on saving data!");
            // Reset button
            button.button('reset');
        }
    });
}
function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}
