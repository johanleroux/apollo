/**
* Initialize Flatpickr
* @type {[type]}
*/
$('.flatpickr').flatpickr({
  mode: "range",
  enableTie: false,

  onClose: function(selectedDates, dateStr, instance) {
    console.log("Update");
    window.location = config.url + '/app/reports/financial/' + dateStr;
  }
});
