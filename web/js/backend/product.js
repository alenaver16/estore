$('#deleteSelectedButton').on('click', deleteSelectedItems);
function deleteSelectedItems() {
    var selectedGridItems = $('#productGrid').yiiGridView('getSelectedRows');
    $.ajax({
        type: 'POST',
        url: '/product/delete-selected-items',
        data: {items: selectedGridItems},
        success: function () {
            $('#productGrid').yiiGridView('applyFilter');
        }
    });
}
