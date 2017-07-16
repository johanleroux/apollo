/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

$(document).on('click', "#newCustomer", function () {
  var id_number = $('#id_number').val();
  var first_name = $('#first_name').val();
  var last_name = $('#last_name').val();
  var email = $('#email').val();
  var phone_number = $('#phone_number').val();
  var address = $('#address').val();

  $.ajax({
    type: "POST",
    url: config.url + "/app/customer",
    data: {
      id_number: id_number,
      first_name: first_name,
      last_name: last_name,
      email: email,
      phone_number: phone_number,
      address: address,
    },
    success: function(msg) {
      $('.alert').removeClass('hide alert-danger');
      $('.alert').addClass('alert-success');
      $('.alert').html(msg.success);

      $('#id_number').val('');
      $('#first_name').val('');
      $('#last_name').val('');
      $('#email').val('');
      $('#phone_number').val('');
      $('#address').val('');

      $('#newCustomer').prop('disabled', true);
      $('#newCustomerModal').modal('hide');

      $('#customer').val(first_name + ' ' + last_name);
      $('#customer_id_number').val(id_number);
    },
    error: function(data) {
      if (data.status == 422) // display validation error
      {
        var errors = data.responseJSON;
        var errorsHTML = '<b>An error has occured</b><br>';
        $.each(errors, function(key, value) {
          errorsHTML += value[0] + '<br/>';
        });
        $('.alert').removeClass('hide alert-success');
        $('.alert').addClass('alert-danger');
        $('.alert').html(errorsHTML);
      } else {
        toastr.warning('Error connecting to the server');
      }
    }
  });
});

/**
* Autocomplete Customer By ID Number
* @type void
*/
$(document).on('focus', '#customer_id_number', function() {
  var cache = {};
  $(this).autocomplete({
    source: function(request, response) {
      var term = request.term;
      if (term in cache) {
        response(cache[term]);
        return;
      }
      $.getJSON(config.url + "/app/customer/select/id", request, function(data, status, xhr) {
        cache[term] = data;
        response(data);
      });
    },
    minLength: 2,
    select: function(event, ui) {
      customerSelect(ui.item);
    }
  });
});

/**
* Autocomplete Customer By First or Last Name
* @type void
*/
$(document).on('focus', '#customer', function() {
  var cache = {};
  $(this).autocomplete({
    source: function(request, response) {
      var term = request.term;
      if (term in cache) {
        response(cache[term]);
        return;
      }
      $.getJSON(config.url + "/app/customer/select/name", request, function(data, status, xhr) {
        cache[term] = data;
        response(data);
      });
    },
    minLength: 2,
    select: function(event, ui) {
      customerSelect(ui.item);
    }
  });
});

/**
* Autocomplete Product Rental By SKU
* @type void
*/
$(document).on('focus', '.autocomplete_rental', function() {
  var cache = {};
  $(this).autocomplete({
    source: function(request, response) {
      var term = request.term;
      if (term in cache) {
        response(cache[term]);
        return;
      }
      var field = getSearchField(this.element.attr('name'));
      $.getJSON(config.url + "/app/product/select?type=rental&field="+field, request, function(data, status, xhr) {
        cache[term] = data;
        response(data);
      });
    },
    minLength: 1,
    select: function(event, ui) {
      var x = getElementNumber($(this).attr('name'));
      $('#rental_'+x+'_product_id').val(ui.item.product_id);
      $('#rental_'+x+'_sku').val(ui.item.sku);
      $('#rental_'+x+'_description').val(ui.item.description);
      $('#rental_'+x+'_unit_price').val(ui.item.price.toFixed(2));
      $('#rental_'+x+'_deposit').val(ui.item.deposit.toFixed(2));

      calculateRentalRow(x);
      addLine('rental', x);
    }
  });
});

/**
* Autocomplete Product Sales By SKU
* @type void
*/
$(document).on('focus', '.autocomplete_sale', function() {
  var cache = {};
  $(this).autocomplete({
    source: function(request, response) {
      var term = request.term;
      if (term in cache) {
        response(cache[term]);
        return;
      }
      var field = getSearchField(this.element.attr('name'));
      $.getJSON(config.url + "/app/product/select?type=sale&field="+field, request, function(data, status, xhr) {
        cache[term] = data;
        response(data);
      });
    },
    minLength: 1,
    select: function(event, ui) {
      var x = getElementNumber($(this).attr('name'));
      $('#sale_'+x+'_product_id').val(ui.item.product_id);
      $('#sale_'+x+'_sku').val(ui.item.sku);
      $('#sale_'+x+'_description').val(ui.item.description);
      $('#sale_'+x+'_quantity').val(1);
      $('#sale_'+x+'_unit_price').val(ui.item.price.toFixed(2));
      $('#sale_'+x+'_deposit').val(ui.item.deposit.toFixed(2));

      calculateSaleRow(x);
      addLine('sale', x);
    }
  });
});

/**
* Initialize Flatpickr
* @type {[type]}
*/
$('.flatpickr').flatpickr({
  "mode": "range",
  onChange: function(selectedDates, dateStr, instance) {
    var row = getElementNumber($(instance.input).attr('name'));
    calculateRentalRow(row);
  }
});

document.addEventListener("turbolinks:load", function() {
  calculateTotals();
});

/**
* Helper function for autocomplete of customer
* to set all fields
* @param  JSON item
* @return void
*/
function customerSelect(item) {
  console.log(item);
  $('#customer').val(item.full_name);
  $('#customer_id_number').val(item.id_number);
  $('#customer_status').val(item.status.message);

  $('#customer_status').removeClass('alert-info alert-warning alert-danger');

  $('#customer_status').addClass('alert-' + item.status.status);
}

/**
* Helper function for getting element Number
* @param  HTMLElement element
* @return string
*/
function getElementNumber(element)
{
  return element.match(/[0-9]/g).toString();
}

function getElementType(element)
{
  if(element.search(/rental/i) >= 0)
  return 'rental';
  if(element.search(/sale/i) >= 0)
  return 'sale';
  return 'nah';
}

function getSearchField(element)
{
  if(element.search(/product_id/i) >= 0)
  return 'product_id';
  if(element.search(/sku/i) >= 0)
  return 'sku';
  return 'nah';
}

/**
* Calculate row total of a rental product
* @param int row
* @return void
*/
function calculateRentalRow(x)
{
    var departure_date = parseDate($('#rental_'+x+'_departure_date').val());
    var return_date = parseDate($('#rental_'+x+'_return_date').val());

    var diffDays = Math.ceil(Math.abs(return_date.getTime() - departure_date.getTime()) / (1000 * 3600 * 24));
    if(diffDays == 0)
    diffDays++;

    $('#rental_'+x+'_total').val(($('#rental_'+x+'_unit_price').val() * diffDays).toFixed(2));

  calculateTotals();
}

function parseDate(str) {
  var m = str.match(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})$/);
  return (m) ? new Date(m[1], m[2]-1, m[3], m[4], m[5]) : null;
}

/**
* Calculate row total of a sales product
* @param int row
* @return void
*/
function calculateSaleRow(x)
{
  $('#sale_'+x+'_total').val(($('#sale_'+x+'_unit_price').val() * $('#sale_'+x+'_quantity').val()).toFixed(2));

  calculateTotals();
}

/**
* Calculate order total
* @return void
*/
function calculateTotals()
{
  var total = 0;
  var deposit = 0;

  $('.rowTotal').each(function() {
    total += ($(this).val() == '') ? 0 : parseFloat($(this).val());
  });

  $('.rowDeposit').each(function() {
    deposit += ($(this).val() == '') ? 0 : parseFloat($(this).val());
  });

  total += deposit;

  $('#payment_deposit_total').val(deposit.toFixed(2));
  $('#payment_total').val(total.toFixed(2));
}

/**
* Order listeners to recalculate costs
* @type {[type]}
*/
$(document).on('focusout', '.updateOrder', function() {
  var type = getElementType($(this).attr('name'));
  var row = getElementNumber($(this).attr('name'));

  if(type == 'rental')
  calculateRentalRow(row)
  if(type == 'sale')
  calculateSaleRow(row)
});

/**
* Add line
* @param string type
* @param string row
*/
function addLine(type, row)
{
  if(type == 'rental' && $('.autocomplete_rental').last().val() == "")
  {
    return null;
  }

  if(type == 'sale' && $('.autocomplete_sale').last().val() == "")
  {
    return null;
  }

  $.ajax({
    url: config.url + "/app/order/getProductLine/",
    type: "get",
    data: {
      id: parseInt(row) + 1,
      type: type
    },
    success: function(data) {
      if(type == "rental")
      $('table#rentals').append(data);
      if(type == "sale")
      $('table#sales').append(data);
    },
    error: function(data) {
      alert('Error connecting to the server');
    }
  });
}


$('body').on('focus',".datetimepicker", function(){
  var type = $(this).attr('id').split("_")[0];
  var id = $(this).attr('id').split("_")[2];

  $(this).datetimepicker({
    format: 'YYYY-MM-DD HH:mm',
    useCurrent: true,
  });
});


/***/ }
/******/ ]);