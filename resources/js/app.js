/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
function trans(key, replace = {}) {
    var translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);

    for (var placeholder in replace) {
        translation = translation.replace(`:${placeholder}`, replace[placeholder]);
    }
    return translation;
}
window.axios = require('axios');
$('button[data-bs-target="#add-to-cart"]').click(function(e) {
    let productId = $(this).attr('data-product-id');
    let path = '/basket/modal/' + productId;
    const skuGetFormInputs = $('#set-sku-values select');
    let inputQuantity = $('#set-quantity').val();
    if(inputQuantity === undefined) {
        inputQuantity = 1;
    }
    path += '/' + inputQuantity;
    if($(this).hasClass('detail-add-to-cart') && skuGetFormInputs.length != 0) {
        let selectData = [];
        skuGetFormInputs.each(function(){
            const _this = $(this);
            $(this).find('option').each(function() {
                if($(this).prop('selected') === true) {
                    selectData.push({"name":_this.attr('name'),'value':$(this).val()})
                }
            })
        });
        path += '/' + JSON.stringify(selectData);
    }
    axios.get(path)
        .then((response) => {
            $('.modal-basket').html(response.data);
            $('#set-quantity-modal').change(checkMaxQuantity);
        })
        .catch((error) => {
            if(error.response.status == 401) {
                axios.get('/basket/modal/unauthorized')
                    .then((response) => {
                        $('.modal-basket').html(response.data);
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        })
});
function resize_product_elements(element,element_item_class) {
    element.each(function() {
        let max_height = 0;
        const items = $(this).find(element_item_class);
        $(items).each(function() {
            const this_height = $(this).find('.first-img').height();
            max_height = this_height > max_height ? this_height : max_height;
        });
        $(items).each(function () {
            // $(this).find('.first-img').height(max_height);
        });
    })
}
function setAxiosPreloader() {
    axios.interceptors.request.use((config) => {
        $('#preloader').show();
        $('#status').show();
        return config;
    });
}
function detailSkuChanged() {
    let data = [];
    data.length = 0;
    $('.detail-set-sku').each(function(index) {
        const _this = $(this);
        $(this).find('option').each(function() {
            if($(this).prop('selected') === true) {
                data[_this.attr('name')] = $(this).val();
            }
        });
    });
    const productId = $("#cart-button-block button").attr('data-product-id');
    // axios.interceptors.request.use((config) => {
    //     $('#preloader').show();
    //     $('#status').show();
    //     // $('body').delay(550).css({'overflow':'visible'});
    //     return config;
    // });
    setAxiosPreloader();
    axios.get('/get-sku/' + productId + '/' + JSON.stringify(data))
        .then((response) => {
            $('.product-prices .current-price span.value').html(response.data.price);
            $('#product-footer').html(response.data.htmlProductFooter);
        })
        .finally(() => {
            // $('#preloader').hide();
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
        });
}
function addQuantityInput() {
    $('.product-count .button-group .count-btn.increment').click(function () {
        const inputQuantity = $('#set-quantity');
        const quantityVal = parseInt(inputQuantity.val());

        const maxQuantity = parseInt(inputQuantity.attr('max'));
        if (quantityVal < maxQuantity) {
            inputQuantity.val(quantityVal + 1);
        }
    });
}

function removeQuantityInput() {
    $('.product-count .button-group .count-btn.decrement').click(function () {
        const inputQuantity = $('#set-quantity');

        const quantityVal = parseInt(inputQuantity.val());
        const minQuantity = parseInt(inputQuantity.attr('min'));
        if (quantityVal > minQuantity) {
            inputQuantity.val(quantityVal - 1);
        }
    });
}
$(function() {
    resize_product_elements($('.slick-slider.products-slider'),'.slider-item');
    resize_product_elements($('.product-tab .grid-view-list'),'.card.product-card');
    $('.detail-set-sku').change(detailSkuChanged);
    addQuantityInput();
    removeQuantityInput();

});
$('.set-quantity').change(checkMaxQuantity);
$('.basket-block .set-quantity').on('change',function() {
    setAxiosPreloader();
    const skuId = $(this).attr('sku-id');
    const quantityVal = $(this).val();
    axios.get('/basket/setQuantity/' + skuId + '/' + quantityVal)
        .then((response) => {
            if(response.data.success === true) {
                $('.basket-block').html(response.data.html)
            }
        })
        .finally(() => {
            // $('#preloader').hide();
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
        });
});
$('.delete-from-basket').on('click',function(e) {
    e.preventDefault();
    setAxiosPreloader();
    const href = $(this).prop('href');
    axios.get(href)
        .then((response) => {
            if(response.data.success === true) {
                $('.basket-block').html(response.data.html)
            }
        })
        .finally(() => {
            // $('#preloader').hide();
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
        });
});
function addToBasketChangeQuantity(value) {
    const addToBasketButton = $('.add-to-basket');
    const addToBasketHref = addToBasketButton.prop('action');
    const newHref = addToBasketHref.replace(/\d+$/,value);
    addToBasketButton.prop('action',newHref);
}
function checkMaxQuantity() {
    if(parseInt($(this).val()) > parseInt($(this).attr('max'))) {
        $(this).val($(this).attr('max'));
    }
    if($(this).attr('id') === 'set-quantity-modal') {
        addToBasketChangeQuantity($(this).val());
    }
}
$('#set-quantity').change(checkMaxQuantity);
$(window).resize(function() {
    resize_product_elements($('.slick-slider.products-slider'),'.slider-item');
    resize_product_elements($('.product-tab .grid-view-list'),'.card.product-card');
});
$('.change-password-visibility-state').click(function() {
    if($("#inputPassword").attr("type") == "password") {
        $('.show-password').hide();
        $('.hide-password').show();
        $('#inputPassword').attr('type', 'text');
        $('#inputPasswordConfirmation').attr('type', 'text');
    }
    else {
        $('.show-password').show();
        $('.hide-password').hide();
        $('#inputPassword').attr('type', 'password');
        $('#inputPasswordConfirmation').attr('type', 'password');
    }
})
function setValuesMultipleInput(checkbox) {
    const propertyCode = checkbox.attr('filter-name');
    let namesProp = [];
    $('#product-filter input[filter-name=' + propertyCode +']').each(function() {
        if($(this).prop('checked') == true) {
            namesProp.push($(this).attr('filter-value'));
        }
    });
    const inputProperty = $("#product-filter input[name^=" + propertyCode + "]");
    if((namesProp.length == 0 && inputProperty.val() != '') || namesProp.length != 0) {
        inputProperty.val(namesProp)
    }
}
$('#product-filter input[type=checkbox][filter-name]').change(function() {
    setValuesMultipleInput($(this));
});
$('#product-filter').submit(function() {
    $('#product-filter input[type=checkbox][filter-name]').each(function() {
        setValuesMultipleInput($(this));
    });
})

