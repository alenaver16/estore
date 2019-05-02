$('#deleteSelectedButton').on('click', deleteSelectedItems);
function deleteSelectedItems() {
    var selectedGridItems = $('#groupGrid').yiiGridView('getSelectedRows');
    $.ajax({
        type: 'POST',
        url: '/group/delete-selected-items',
        data: {items: selectedGridItems},
        success: function () {
            $('#groupGrid').yiiGridView('applyFilter');
        }
    });
}
