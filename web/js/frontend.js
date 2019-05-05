$('.add_to_cart_button').on('click', addToCart);
$('.plus').on('click', updateQtiCounterPlus);

function addToCart() {
    $.ajax({
        type: 'POST',
        url: '../cart/add',
        data: {id: $(this).data('id')},
        success: function () {
            console.log(3);
        }
    });
}

function updateQtiCounterPlus(e) {
    var qty = $('.' + $(this).attr('class')).siblings('.qty');
    console.log(qty);
    // $('.qty').val(+$('.qty').val() +1);
}