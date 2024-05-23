jQuery(document).ready(function ($) {
    $('#cart-button').on('click', function (e) {
        e.preventDefault()
        $('#cart-panel').toggleClass('open')
        loadCartSummary()
    })

    $('.close-cart-panel').on('click', function (e) {
        e.preventDefault()
        $('#cart-panel').removeClass('open')
    })

    function loadCartSummary() {
        $.ajax({
            url: cartPanelAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'update_cart_summary',
            },
            success: function (response) {
                $('#cart-panel-summary').html(response)
            },
        })
    }
})
