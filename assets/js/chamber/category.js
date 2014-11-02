$(function() {
    drawCategoryTable();
});

function drawCategoryTable() {
    var baseUrl = $("#base-url").attr("href");

    // Get category list
    $.ajax({
        type: 'GET',
        url: baseUrl + "api/service/category",
        dataType: "json",
        success: function(data) {
            console.log(data);
            var cateTable = $('#category-table');
            for (var i = 0; i < data.length; i++) {
                var row = $('<tr></tr>');
                var name = $('<td></td>').text(data[i].category_name);
                var action = '<td class="cell-center"><a style="color: red; font-size:11px;" onclick="callDelete(' + data[i].id + ', this)" href="javacript:void(0);">Delete</a></td>';
                row.append(name).append(action);
                cateTable.append(row);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on getting data!");
        }
    });

}

function createCategory() {
    var baseUrl = $("#base-url").attr("href");
    var category = $('#category').val();
    var button = $('#submit');
    button.button('loading');
    // Post to api
    $.ajax({
        type: 'POST',
        //contentType: 'application/json',
        url: baseUrl + "api/service/category",
        dataType: "json",
        data: {
            category: category
        },
        success: function(data, textStatus, jqXHR) {
            console.log(data);

            // Draw new line in table
            var cateTable = $('#category-table');
            var row = $('<tr></tr>');
            var name = $('<td></td>').text(data.category_name);
            var action = '<td class="cell-center"><a style="color: red; font-size:11px;" onclick="callDelete(' + data.id + ', this)" href="javacript:void(0);">Delete</a></td>';
            row.append(name).append(action);
            cateTable.append(row);

            // Clear the form
            $('#category').val("");
            button.button('reset');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            showAlert('danger', "Error on saving data!");
        }
    });
}

function callDelete(categoryId, element) {
    bootbox.confirm(
            "Are you sure you want to delete this Category. The action cannot be undone!",
            function(result) {
                if (result) {
                    deleteCategory(categoryId, element);
                }
            }
    );
}

function deleteCategory(categoryId, element) {
    var baseUrl = $("#base-url").attr("href");
    console.log("Deleting Category");

    // Delete process
    $.ajax({
        type: 'DELETE',
        url: baseUrl + "api/service/category/id/" + categoryId,
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
            showAlert('danger', "Error on deleting data!");
        }
    });
}
