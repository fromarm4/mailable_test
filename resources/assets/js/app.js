
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
   $(document).on('click', '.js-send-stamp', (e)=> {
        const $this = $(e.target);
        const type = $this.data('type');
        const post_id = $this.closest('.js-post').data('post_id');

        var data = {
            type,
        };

        $.ajax({
            url: '/send-' + type + '/' + post_id,
            type: 'POST',
            dataType: 'json',
            data: data,
        })
        .done(function(result) {
            $('.alert').removeClass('hidden');
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
   })
});