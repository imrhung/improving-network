/* Draw table of members*/
var memberTable;
$(document).ready(function() {
    $('#member').html('<table cellpadding="0" cellspacing="0" border="0" class="display table table-striped table-bordered" id="member-table"></table>');
    memberTable = $('#member-table').dataTable({
        "aoColumns": [
            {"sTitle": "Business Name"},
            {"sTitle": "Email"},
            {"sTitle": "Category"},
            {"sTitle": "Published"},
            {"sTitle": "Action", "sClass": "center"}
        ],
        "bSort": false
    });
    loadMemberTable();
});


function loadMemberTable() {
    var baseUrl = $("#base-url").attr("href");

    // Get category list
    $.ajax({
        type: 'GET',
        url: baseUrl + "api/service/member",
        dataType: "json",
        success: function(data) {
            console.log(data);
            var tableData = new Array();
            for (var i=0; i<data.length; i++){
                var t = (data[i].register_date)? data[i].register_date.split(/[- :]/) : '0';
                var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                action = '<div style="float: left;"><a href="' + baseUrl + 'chamber/edit_member/' + data[i].id + '">View</a></div>  <div style="float: right; font-size:11px"><a style="color: red;" onclick="callDelete(' + data[i].id + ', this)" href="javacript:void(0);">Delete</a></div>';
                tableData.push([
                    data[i].business_name,
                    data[i].email,
                    data[i].category_name,
                    d.toDateString(),
                    action
                ]);
            }
            memberTable.fnClearTable();
            memberTable.fnAddData(tableData);
            
            // Remove loading animate
            $('#loading').html('');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on getting data!");
        }
    });

}

//Open a dialog to confirm delete the member.
function callDelete(memberId, element) {
    bootbox.confirm(
            "Are you sure you want to delete this Category. The action cannot be undone!",
            function(result) {
                if (result) {
                    deleteMember(memberId, element);
                }
            }
    );
}

// And here we actually delete the member. :)
function deleteMember(memberId, element) {
    var baseUrl = $("#base-url").attr("href");
    console.log("Deleting Member");

    // Delete process
    $.ajax({
        type: 'DELETE',
        url: baseUrl + "api/service/member/id/" + memberId,
        success: function(data, textStatus, jqXHR) {
            // Refresh table
            console.log(data);
            var tr = $(element).closest('tr');
            tr.css("background-color", "#FF3700");
            tr.fadeOut(400, function() {
                tr.remove();
            });
            return false;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            showAlert('danger', "Error on deleting data!");
        }
    });
}