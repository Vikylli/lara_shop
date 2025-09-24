function showCart(cart) {
    $('#cart-modal .modal-body').html(cart);
    $('#cart-modal').modal();
    let cartOty = $('#modal-cart-qty').text()?$('#modal-cart-qty').text() :0;
    $('.mini-cart-qty').text(cartOty);

    if (cartQty) {
    $('#cart-modal .modal-footer button.btn-cart').removeClass('d-none');
} else {
    $('#cart-modal .modal-footer button.btn-cart').addClass('d-none');
}
}



function clearCart(action) {
    $.ajax({
        url: action,
        type: 'get',
        success: function (result) {
            let now_location = document.location.pathname;
            if(now_location == '/cart/checkout'){
                location = '/cart/checkout';
            }else{
                showCart(result);
            }
        },
        error: function () {
            alert('Error');
        }
    });
}
function checkoutCart(url) {
    if (url) {
        window.location.href = url; // Это переадресует браузер на указанный URL
    } else {
        console.error('URL для оформления заказа не предоставлен!');
        // Можно также показать сообщение пользователю
        alert('Невозможно перейти к оформлению заказа. Попробуйте позже.');
    }
}

function getCart(action) {
    $.ajax({
        url: action,
        type: 'get',
        success: function (result) {
            showCart(result);
        },
        error: function () {
            alert('Error');
        }
    });
}

$(function() {
    // Cart
    $('.addtocart').on('submit', function () {

        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: 'post',
            success: function (result) {
                console.log(result); 
                $('#cart-modal .modal-body').html(result.html);
           
             $('.mini-cart-qty').text(result.cart_qty);
            },
            error: function (msg) {
                alert('Error!2');
                console.log(msg.responseJSON);
                form[0].reset();
            }
        });
        return false;
    });

    $('#cart-modal .modal-body').on('click', '.del-item', function () {
    $.ajax({
        url: $(this).data('action'),
        type: 'get',
        success: function (result) {
             let now_location = document.location.pathname;
            if(now_location == '/cart/checkout'){
                location = '/cart/checkout';
            }else{
                showCart(result);
            }
        },
        error: function (msg) {
            alert('Error!');
        }
    });
});

});
