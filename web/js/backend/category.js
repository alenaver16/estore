$('#deleteSelectedButton').on('click', deleteSelectedItems);
$('.js-delete-img').on('click', deleteImage);

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

function deleteImage() {
    self = $(this);
    $.ajax({
        type: 'POST',
        url: '/category/delete-image',
        data: {categoryId: $(this).data('img')},
        success: function () {
            self.parent().parent().parent().remove();
        }
    });
}