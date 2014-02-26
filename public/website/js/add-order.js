//ADD TO CART
base_url = $('base').attr('href');
jQuery(document).on('mousedown', '.add2cart-btn', function(e) {
    if (jQuery(this).hasClass('exclude-new-checkout')) return true;
    if (jQuery(this).children('a').text().toLowerCase() == "coming soon") return false;
    url = base_url + '/add-to-cart';
    productId = $(this).data('productId');
    productName = $(this).data('productName');
    productPrice = $(this).data('productPrice');
    var cart = jQuery('.bg-cart');
    var obj = jQuery(this);
    if (obj) {
        var objClone = obj.clone();
        objClone.text('$' + productPrice);
        objClone.offset({
            top: obj.offset().top,
            left: obj.offset().left
        }).
        addClass(
          $(this).attr('class')
        ).
        css({
            'opacity': '1', 
            'position': 'absolute',
            'width': $(this).width() + 51 * 1+'px',
            'height': $(this).height() + 16 * 1+'px',
            'padding-top': '4px',
            'z-index': '100000',
            'text-align': 'center',
            'vertical-align': 'middle',
        }).appendTo(
          jQuery('body')
        ).
        animate({
            'top': cart.offset().top,
            'left': cart.offset().left-1,
            'width': cart.width() + 22 * 1+'px',
            'height': cart.height() + 11 * 1+'px',
            'padding':'5px 10px 5px 10px',
            'border-bottom': '1px solid #53951D',
            'border-left': 'none !important',
            'border-right': 'none !important',
            'border-radius': '2px',
            'font-size': '14px'
        }, 1500, 'easeInOutExpo');
        setTimeout(function() {
            jQuery('.order-con').css('font-size', '14px');
            objClone.html('');
            cart.effect("pulsate", {
                times: 2
            }, 200);
        }, 1500);
        objClone.animate({
            'opacity': 0
        }, function() {
            jQuery(this).detach();
            var currentPrice = jQuery('.totalPrice:first').text();
            var currentItem = jQuery('.totalItem:first').text();
            jQuery('.totalItem').text(1 * (currentItem) + 1);
            jQuery('.totalPrice').text(1 * currentPrice + (productPrice) * 1);
            var latest_price = parseInt(jQuery('.totalPrice').html());
            //
        });
    }

    jQuery.post(base_url + '/cart/add', {
        product_id: productId,
        product_price: productPrice, 
        product_name: productName,
        quantity: 1
    }, function(res) {
        res = jQuery.parseJSON(res);
        console.log(res);
        //if (typeof res.id != 'undefined') return true;
    });
    return false;
});
//ADD TO CART
/*** Coded by: Arnel T. Lenteria ***/