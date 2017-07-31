require('./bootstrap');
window.Vue = require('vue');
window.Turbolinks = require('turbolinks');
import VueTurbolinks from 'vue-turbolinks';
Vue.use(VueTurbolinks);

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': window.Laravel.csrfToken }});
Turbolinks.start();

/**
* Turbolinks onLoad listener
* @type
*/
document.addEventListener('turbolinks:load', () => {
    // Fix page layout on Turbolinks reload
    if("layout" in $.AdminLTE)
      $.AdminLTE.layout.fix();

    setup();

    Vue.component('purchase', require('./components/Purchase/Purchase.vue'));
    Vue.component('purchase-row', require('./components/Purchase/Purchase-Row.vue'));
    Vue.component('purchase-supplier', require('./components/Purchase/Purchase-Supplier.vue'));

    Vue.component('sale', require('./components/Sale/Sale.vue'));
    Vue.component('sale-row', require('./components/Sale/Sale-Row.vue'));
    Vue.component('sale-customer', require('./components/Sale/Sale-Customer.vue'));

    vm = new Vue({
        el: '#app'
    });
});

document.addEventListener("turbolinks:before-cache", function() {
    // Fix LaravelDataTables when going back and forward
    if(!window.LaravelDataTables) return;
    if(!window.LaravelDataTables.dataTableBuilder) return;
    window.LaravelDataTables.dataTableBuilder.destroy();
    window.LaravelDataTables.dataTableBuilder = null;
});

function setup()
{
    /**
    * Set toastr Options
    */
    toastr.options = {
        "closeButton":       true,
        "debug":             false,
        "newestOnTop":       true,
        "progressBar":       true,
        "positionClass":     "toast-top-right",
        "preventDuplicates": true,
        "onclick":           null,
        "showDuration":      "300",
        "hideDuration":      "1000",
        "timeOut":           "5000",
        "extendedTimeOut":   "1000",
        "showEasing":        "swing",
        "hideEasing":        "linear",
        "showMethod":        "fadeIn",
        "hideMethod":        "fadeOut"
    };

    /**
    * Add Confirmation To A Button
    */
    $('.confirmSubmit').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parent('form');
        swal({
            title: "Are you sure?",
            text: "You will not be able to reverse this action!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
        },
        function(isConfirm){
            if (isConfirm) form.submit();
        });
    });
}
