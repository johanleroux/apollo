const elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');
elixir.config.sourcemaps = false;

elixir((mix) => {
  mix.less([
    'bootstrap.less',
    'app.less'
  ], 'resources/assets/css/app.css')
  .styles([
    '../../../node_modules/admin-lte/plugins/datatables/dataTables.bootstrap.css',
    '../../../node_modules/ionicons/dist/css/ionicons.css',
    '../../../node_modules/icheck/skins/square/blue.css',
    '../../../node_modules/toastr/build/toastr.css',
    '../../../node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
    '../../../node_modules/flatpickr/dist/flatpickr.min.css',
    '../../../node_modules/sweetalert/dist/sweetalert.css',
    'app.css',
  ], 'public/css/app.css')
  .webpack('app.js')
  .copy([
    'node_modules/font-awesome/fonts',
    'node_modules/ionicons/dist/fonts',
    'node_modules/bootstrap-less/fonts'
  ], 'public/fonts')
  .copy([
    'node_modules/icheck/skins/square/blue.png'
  ], 'public/css')
  .copy([
    'resources/assets/img'
  ], 'public/img');
});
