$('#deleteSelectedButton').on('click', deleteSelectedItems);
$('.js-delete-img').on('click', deleteImage);
$('.js-set-main-img').on('click', setMainImage);

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

function deleteImage() {
    self = $(this);
    $.ajax({
        type: 'POST',
        url: '/product/delete-image',
        data: {imgId: $(this).data('img')},
        success: function () {
            self.parent().parent().parent().remove();
        }
    });
}

function setMainImage() {
    self = $(this);
    $.ajax({
        type: 'POST',
        url: '/product/set-main-image',
        data: {imgId: $(this).data('img')},
        success: function () {
            $(".product-images-block").find(".js-set-main-img").css('opacity', 0.2);
            self.css('opacity', 1);
        }
    });
}
