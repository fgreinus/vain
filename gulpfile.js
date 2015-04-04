var elixir = require('laravel-elixir');

elixir.extend('sourcemaps', false);

var scripts_include = [
    /*
     |--------------------------------------------------------------------------
     | Vendor Javascript
     |--------------------------------------------------------------------------
     */
    './bower_components/jquery/dist/jquery.js',
    './bower_components/bootstrap/dist/js/bootstrap.js',
    './bower_components/toastr/toastr.js',
    './bower_components/bootstrap-select/dist/js/bootstrap-select.js',

    /*
     |--------------------------------------------------------------------------
     | Module Javascript
     |--------------------------------------------------------------------------
     */
    './resources/assets/js/app.js',
    './resources/assets/js/modal.js',
    './resources/assets/js/notify.js',
    './resources/assets/js/pjax.js',
    './resources/assets/js/core.js',

    './modules/Forum/Resources/assets/js/*.js',
    './modules/Site/Resources/assets/js/*.js',
    './modules/User/Resources/assets/js/*.js',
];

var scripts_admin_include = [
    /*
     |--------------------------------------------------------------------------
     | Vendor Javascript
     |--------------------------------------------------------------------------
     */
    './bower_components/admin-lte/dist/js/app.js',

    /*
     |--------------------------------------------------------------------------
     | Module Javascript
     |--------------------------------------------------------------------------
     */
    './modules/User/Resources/assets/js/admin/*.js',
];

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    // compile less
    mix.less(['app.less', 'admin.less'], 'public/static/css');

    // concat scripts
    mix.scripts(scripts_include, 'public/static/js/app.js', './');

    mix.scripts(scripts_admin_include, 'public/static/js/admin.js', './');

    // copy fonts
    mix.copy('./bower_components/bootstrap/dist/fonts', 'public/static/fonts');
    //mix.copy('./bower_components/bootstrap-material-design/dist/fonts', 'public/static/fonts');

    // copy admin statics
    mix.copy('./bower_components/admin-lte/plugins', 'public/static/plugins');

    // versioning files
    mix.version([
        'public/static/css/app.css',
        'public/static/css/admin.css',
        'public/static/js/app.js',
        'public/static/js/admin.js']);
});