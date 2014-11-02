/* 
 * Code written by Nguyen Van Hung at @imrhung
 * Feel free to re-use or share it.
 * Happy code!!!
 */

/* Draw table of members*/
var dictionaryTable;
$(document).ready(function () {

//    Initialize table
    $('#dictionary').html('<table cellpadding="0" cellspacing="0" border="0" class="display table table-striped table-bordered table-hover" id="dictionary-table"></table>');
    dictionaryTable = $('#dictionary-table').dataTable({
        "aoColumns": [
            {"sTitle": "IMAGE", "sClass": "text-center image-word"},
            {"sTitle": "WORD", "width": "20%"},
            {"sTitle": "SENTENCE", "width": "15%"},
            {"sTitle": "SOUND", "sClass": "text-center"},
            {"sTitle": "SOUND EX", "sClass": "text-center"},
            {"sTitle": "DEFINITION"},
            {"sTitle": "PT SPEECH", "sClass": "text-center"},
            {"sTitle": "DIFFICULTY", "sClass": "text-center"}
        ],
        "bSort": true,
        "aaSorting": [],
        "iDisplayLength": 25
    });
    loadDictionaryTable();

    // Reset button
    $("#reset").click(function () {
        $('#image-word').attr('src', '');
        $('#sound-word').text('');
        $('#sound-example').text('');
        $('#sound-word').parent().children('span.fa').removeClass('fa-volume-up');
        $('#sound-example').parent().children('span.fa').removeClass('fa-volume-up');

        // Change the submit button to "Add new word"
        $('#submit').html("Add a new word");
    });

    // Submit form
    $('#word-form').submit(function () {
        if ($('#word-id').val()) {
            // Edit word
            updateWord();
        } else {
            // Create a new word
            addWord();
        }
    });

    // Init upload file:
    // First file: word's image
    // Set the button
    $('#drop-image a').click(function () {
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });
    $('#drop-image').fileupload({
        // This element will accept file drag/drop uploading
        dropZone: $('#drop-image'),
        url: 'api/file/do_upload',
        dataType: 'json',
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            // Show upload started (spinning or progressbar)

            // Automatically upload the file once it is added to the queue
            data.submit();
        },
        done: function (e, data) {
            $('#image-word').attr('src', data.result.files[0].thumbnailUrl);
            showNotification('success', "Image uploaded!");
        },
        fail: function (e, data) {
            showNotification('warning', "Upload failed!");
        }
    });

    // Sound of the word
    // Set the button
    $('#drop-sound a').click(function () {
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });
    $('#drop-sound').fileupload({
        // This element will accept file drag/drop uploading
        dropZone: $('#drop-sound'),
        url: 'api/file/do_upload_sound',
        dataType: 'json',
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            // Show upload started (spinning or progressbar)

            // Automatically upload the file once it is added to the queue
            data.submit();
        },
        done: function (e, data) {
            console.log(data);
            $('#sound-word').parent().children('span.fa').addClass('fa-volume-up');
            $('#sound-word').text(data.result.files[0].url);

            showNotification('success', "Sound uploaded!");
        },
        fail: function (e, data) {
            showNotification('warning', "Upload failed!");
        }
    });

    // Sound of the example sentence
    // Set the button
    $('#drop-example a').click(function () {
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });
    $('#drop-example').fileupload({
        // This element will accept file drag/drop uploading
        dropZone: $('#drop-example'),
        url: 'api/file/do_upload_sound',
        dataType: 'json',
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            // Show upload started (spinning or progressbar)

            // Automatically upload the file once it is added to the queue
            data.submit();
        },
        done: function (e, data) {
            $('#sound-example').parent().children('span.fa').addClass('fa-volume-up');
            $('#sound-example').text(data.result.files[0].url);
            showNotification('success', "Sound uploaded!");
        },
        fail: function (e, data) {
            showNotification('warning', "Upload failed!");
        }
    });

    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });
});

function loadWord(id) {
    var baseUrl = $("#base-url").attr("href");

    // Get word
    $.ajax({
        type: 'GET',
        url: baseUrl + "api/word/id/" + id,
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#word-id').val(data.id);
            $('#image-word').attr('src', data.picture_url);
            $('#word').val(data.word);
            $('#sentence').val(data.example);

            if (data.sound_url) {
                $('#sound-word').parent().children('span.fa').addClass('fa-volume-up');
            } else {
                $('#sound-word').parent().children('span.fa').removeClass('fa-volume-up');
            }
            $('#sound-word').text(data.sound_url);

            if (data.sound_url) {
                $('#sound-example').parent().children('span.fa').addClass('fa-volume-up');
            } else {
                $('#sound-example').parent().children('span.fa').removeClass('fa-volume-up');
            }
            $('#sound-example').text(data.sound_example_url);

            $('#definition').val(data.definition);
            $('#part-of-speech').val(data.part_of_speech);
            $('#difficulty').val(data.difficulty);

            // Change the submit button to "Edit word"
            $('#submit').html("Update this word");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on getting data!");
        }
    });
}

function addWord() {
    var baseUrl = $("#base-url").attr("href");

    var button = $('#submit');
    button.button('loading');

    // Bind data
    var word = $('#word').val();
    var definition = $('#definition').val();
    var example = $('#sentence').val();
    var picture_url = $('#image-word').attr('src');
    var sound_url = $('#sound-word').text();
    var sound_example_url = $('#sound-example').text();
    var part_of_speech = $('#part-of-speech').val();
    var difficulty = $('#difficulty').val();

    // Post to api
    $.ajax({
        type: 'POST',
        url: baseUrl + "api/word",
        dataType: "json",
        data: {
            word: word,
            definition: definition,
            example: example,
            picture_url: picture_url,
            sound_url: sound_url,
            sound_example_url: sound_example_url,
            part_of_speech: part_of_speech,
            difficulty: difficulty
        },
        success: function (data, textStatus, jqXHR) {
            console.log(data);
            $('#word-id').val(data.id);
            
            // Add word to table
            var word = [data];
            addWordsToTable(word);

            // Show success
            showAlert('success', "Create member successful!");

            button.button('reset');
            // Change the submit button to "Edit word"
            $('#submit').html("Update this word");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on saving data!");
            // Reset button
            button.button('reset');
        }
    });
}

function updateWord() {
    var baseUrl = $("#base-url").attr("href");
    var wordId = $('#word-id').val();

    var button = $('#submit');
    button.button('loading');

    // Bind data
    var word = $('#word').val();
    var definition = $('#definition').val();
    var example = $('#sentence').val();
    var picture_url = $('#image-word').attr('src');
    var sound_url = $('#sound-word').text();
    var sound_example_url = $('#sound-example').text();
    var part_of_speech = $('#part-of-speech').val();
    var difficulty = $('#difficulty').val();

    // PUT to api
    $.ajax({
        type: 'PUT',
        url: baseUrl + "api/word/id/" + wordId,
        dataType: "json",
        data: {
            word: word,
            definition: definition,
            example: example,
            picture_url: picture_url,
            sound_url: sound_url,
            sound_example_url: sound_example_url,
            part_of_speech: part_of_speech,
            difficulty: difficulty
        },
        success: function (data, textStatus, jqXHR) {
            console.log(data);
            // TODO : Update in the dataTable object also.
            // Show success
            showAlert('success', "Update member successful!");

            // Clear the form
            //resetForm($('#member_form'));

            // Reset button
            button.button('reset');
            // Change the submit button to "Edit word"
            $('#submit').html("Update this word");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on saving data!");
            // Reset button
            button.button('reset');
        }
    });
}

// TODO : load page by page, not all at once.
function loadDictionaryTable() {
    var baseUrl = $("#base-url").attr("href");

    // Get dictionary list
    $.ajax({
        type: 'GET',
        url: baseUrl + "api/word",
        dataType: "json",
        success: function (data) {
            addWordsToTable(data);

            // Remove loading animate
            $('#loading').html('');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on getting data!");
        }
    });

}

function addWordsToTable(data) {
    var baseUrl = $("#base-url").attr("href");
    var tableData = new Array();
    var image = "";
    var word = "";
    var example, pos, definition;
    var sound;
    var sound_example;
    for (var i = 0; i < data.length; i++) {
        var t = (data[i].register_date) ? data[i].register_date.split(/[- :]/) : '0';
        var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
        action = '<div style="float: left;"><a href="'
                + baseUrl + 'chamber/edit_member/'
                + data[i].id + '">View</a></div>  <div style="float: right; font-size:11px"><a style="color: red;" onclick="callDelete('
                + data[i].id + ', this)" href="javacript:void(0);">Delete</a></div>';

        // Set the image: check if null or empty
        if (data[i].picture_url) {
            image = '<img class="img-responsive" src="' + data[i].picture_url + '">';
        } else {
            image = "";
        }

        // Set the word and its options.
        word = '<div class="row" onmouseover="mouseOverTable(this);" '
                + ' onmouseout="mouseOutOnTable(this);">'
                + '<div class="col-xs-7">' + data[i].word + '</div>'
                + '<div class="col-xs-5 utility hidden">'
                + '<span onclick="loadWord(' + data[i].id + ');" class="fa fa-pencil" style="color: #42B4C7; margin-right: 8px;"></span>'
                + '<span onclick="callDelete(' + data[i].id + ', this);" class="fa fa-trash-o" style="color: red;"></span>'
                + '</div></div>';

        // Set the example sentence.
        // If it too long, replace with ..., click it to open more.
        if (data[i].example){
            if (data[i].example.length < 25) {
                example = data[i].example;
            } else {
                example = data[i].example.slice(0, 22)
                        + '<span class="hidden">' + data[i].example + '</span>'
                        + '<a href="javascript:void(0)" onclick="expandText(this);"> ...</a>';
            }
        } else {
            example = '';
        }

        // Set the sound
        if (data[i].sound_url) {
            sound = '<a href="javascript:void(0)" onclick="playSound(\'' + data[i].sound_url + '\');"><span class="fa fa-volume-up"></spam></a>';
        } else {
            sound = "";
        }
        if (data[i].sound_example_url) {
            sound_example = '<a href="javascript:void(0)" onclick="playSound(\'' + data[i].sound_example_url + '\');"><span class="fa fa-volume-up"></spam></a>';
        } else {
            sound_example = "";
        }

        // Set the definition
        // If it too long, replace with ..., click it to open more.
        if (data[i].definition){
            if (data[i].definition.length < 20) {
                definition = data[i].definition;
            } else {
                definition = data[i].definition.slice(0, 18)
                        + '<span class="hidden">' + data[i].definition + '</span>'
                        + '<a href="javascript:void(0)" onclick="expandText(this);"> ...</a>';
            }
        } else {
            definition = '';
        }

        // Set the Part of speech
        if (data[i].part_of_speech) {
            switch (parseInt(data[i].part_of_speech)) {
                case 1:
                    pos = 'n';
                    break;
                case 2:
                    pos = 'pro';
                    break;
                case 3:
                    pos = 'adj';
                    break;
                case 4:
                    pos = 'det';
                    break;
                case 5:
                    pos = 'v';
                    break;
                case 6:
                    pos = 'adv';
                    break;
                case 7:
                    pos = 'pre';
                    break;
                case 8:
                    pos = 'con';
                    break;
                case 9:
                    pos = 'int';
                    break;
                case 10:
                    pos = 'expression';
                    break;
                case 11:
                    pos = 'proper noun';
                    break;
                default:
                    pos = '';
            }
        } else {
            pos = "";
        }

        tableData.push([
            image,
            word,
            example,
            sound,
            sound_example,
            definition,
            pos,
            data[i].difficulty
        ]);
    }
    //dictionaryTable.fnClearTable();
    dictionaryTable.fnAddData(tableData);
}

//Open a dialog to confirm delete the member.
function callDelete(wordId, element) {
    bootbox.confirm(
            "Are you sure you want to delete this Category. The action cannot be undone!",
            function (result) {
                if (result) {
                    deleteWord(wordId, element);
                }
            }
    );
}

// And here we actually delete the member. :)
function deleteWord(wordId, element) {
    var baseUrl = $("#base-url").attr("href");
    console.log("Deleting Member");

    // Delete process
    $.ajax({
        type: 'DELETE',
        url: baseUrl + "api/word/id/" + wordId,
        success: function (data, textStatus, jqXHR) {
            // Refresh table
            console.log(data);
            // TODO : delete row from dataTable object.
//            dictionaryTable
//                    .row($(element).parents('tr'))
//                    .remove().draw();
            
            var tr = $(element).closest('tr');
            tr.css("background-color", "#FF3700");
            tr.fadeOut(1000, function () {
                tr.remove();
            });
            return false;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            showAlert('danger', "Error on deleting data!");
        }
    });
}

function expandText(object) {

    var jObj = $(object);
    $(jObj).closest('td').text($(jObj).closest('td').children("span").text());
}

function playSound(soundfile) {
    var type_attr = '';
    if (navigator.userAgent.indexOf('Firefox') != -1) {
        type_attr = "type=\"application/x-mplayer2\"";
    }
    document.getElementById("sound-speak").innerHTML = "<embed src=\"" + soundfile + "\" height=\"0\" autostart=\"true\" loop=\"false\" " + type_attr + " />";
}

function playSoundForm(object) {
    var jObj = $(object);
    var url = $(jObj).find("span.sound-url").text();
    playSound(url);
}
