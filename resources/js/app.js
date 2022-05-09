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
window.axios = require('axios');
$('button[data-bs-target="#add-to-cart"]').click(function(e) {
    let productId = $(this).attr('data-product-id');
    axios.get('/basket/modal/' + productId)
        .then((response) => {
            $('.modal-basket').html(response.data);

        })
        .catch((error) => {
            console.log(error);
        })
});
function resize_product_sliders() {
    $('.slick-slider.products-slider').each(function(slider) {
        let max_height = 0;
        const slider_items = $(this).find('.slider-item');
        $(slider_items).each(function() {
            const this_height = $(this).find('.first-img').height();
            max_height = this_height > max_height ? this_height : max_height;
        });
        $(slider_items).each(function () {
            $(this).find('.first-img').height(max_height);
        });
    })
}
$(function() {
    resize_product_sliders();
});
$(window).resize(resize_product_sliders);
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

