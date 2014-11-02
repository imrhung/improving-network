/* 
 * Code written by Nguyen Van Hung
 * Feel free to re-use or share it.
 * Happy code!!!
 */

$(document).ready(function() {
    getInfo();
});

function getInfo(){
    var baseUrl = $("#base-url").attr("href");
    
    // Get info list
    $.ajax({
        type: 'GET',
        url: baseUrl + "api/service/info",
        dataType: "json",
        success: function(data) {
            console.log(data);
            $('#phone').val(data.phone_number);
            $('#description').val(data.description);
            $('#header-photo').attr('src',data.header_photo_url);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on getting data!");
        }
    });
}

function updateInfo(event, data) {
    var baseUrl = $("#base-url").attr("href");
    var phone_number = $('#phone').val();
    var description = $('#description').val();
    // Get Image URL from uploading service.
    var image_url = null;
    if (data !== null){
        image_url = baseUrl + "assets/upload/" +data.info.file_name;
    } else {
    }
    
    // Set waiting state to button.
    var button = $('#update');
    button.button('loading');
    
    // PUT method.
    $.ajax({
        type: 'PUT',
        //contentType: 'application/json',
        url: baseUrl + "api/service/info",
        dataType: "json",
        data: {
            phone_number: phone_number,
            header_photo_url: image_url,
            description: description
        },
        success: function(data, textStatus, jqXHR){
            console.log(data);
            showAlert('success', "Update successful!");
            if (data.header_photo_url){
                $('#header-photo').attr('src',data.header_photo_url);
            }
            
            button.button('reset');
            
            // Clear input file to avoid multiple upload file.
            $('#userfile').wrap('<form>').closest('form').get(0).reset();
        },
        error: function(jqXHR, textStatus, errorThrown){
            showAlert('danger', "Error on saving data!");
            button.button('reset');
        }
    });
}

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
    
    function clearFile(){
        // Clear input file to avoid multiple upload file.
        $('#userfile').wrap('<form>').closest('form').get(0).reset();
    }
    
    function uploadFiles(event){
        // Stop stuff happening.
        event.stopPropagation();
        event.preventDefault();
        
        // START A LOADING SPINNER HERE
        
    if($("#userfile").val() == ''){
        // Call function to create packet.
        updateInfo(event, null);
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
                    updateInfo(event, data);
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
