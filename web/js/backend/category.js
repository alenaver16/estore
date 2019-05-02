$('#deleteSelectedButton').on('click', deleteSelectedItems);
function deleteSelectedItems() {
    var selectedGridItems = $('#categoryGrid').yiiGridView('getSelectedRows');
    $.ajax({
        type: 'POST',
        url: '/category/delete-selected-items',
        data: {items: selectedGridItems},
        success: function () {
            $('#categoryGrid').yiiGridView('applyFilter');
        }
    });
}
