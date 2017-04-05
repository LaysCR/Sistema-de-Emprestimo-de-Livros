const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/assets/js/app.js', 'public/js')
  //  .sass('resources/assets/sass/app.scss', 'public/css');
  // MIX APP ESSENTIAL CSS FILES
  mix.less('resources/assets/less/bootstrap.less', 'public/css/bootstrap.css');
  mix.less('resources/assets/less/adminlte.less', 'public/css/adminlte.css');
  mix.less('resources/assets/less/app.less', 'public/css/app.css');

  // MIX APP CSS PLGUINS
  mix.combine([
      'node_modules/sweetalert/dist/sweetalert.css',
      'node_modules/select2/dist/css/select2.css',
      'node_modules/toastr/build/toastr.css',
      'node_modules/admin-lte/plugins/datepicker/datepicker3.css'
  ], 'public/css/plugins.css');

  // MIX APP ESSENTIAL JS FILES
  mix.js([
      'node_modules/admin-lte/plugins/jQuery/jquery-2.2.3.min.js',
      'node_modules/bootstrap/dist/js/bootstrap.min.js',
      'node_modules/admin-lte/dist/js/app.min.js',
      'resources/assets/js/app.js'
  ], 'public/js/app.js');

  // MIX APP JS PLUGINS
  mix.js([
      'node_modules/toastr/build/toastr.min.js',
      'node_modules/sweetalert/dist/sweetalert.min.js',
      'node_modules/select2/dist/js/select2.js',
      'node_modules/admin-lte/plugins/datepicker/bootstrap-datepicker.js',
      'node_modules/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js',
      'node_modules/admin-lte/plugins/chartjs/Chart.min.js'
  ], 'public/js/plugins.js');

  // COPY FONTS FILES
  mix.copy("node_modules/bootstrap/fonts", "public/fonts");

  mix.copy("node_modules/font-awesome/fonts", "public/fonts");
