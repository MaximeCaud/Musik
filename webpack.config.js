var Encore = require('@symfony/webpack-encore');
var CopyWebPackPlugin = require('copy-webpack-plugin');

Encore
// directory where compiled assets will be stored
    .setOutputPath('web/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('Front/index', './assets/Front/js/index.js')
    .addEntry('Front/about', './assets/Front/js/about.js')
    .addEntry('Front/event', './assets/Front/js/event.js')
    .addEntry('Front/contact', './assets/Front/js/contact.js')
    .addEntry('Front/media', './assets/Front/js/media.js')
    .addEntry('Front/news', './assets/Front/js/news.js')
    .addEntry('Front/viewNews', './assets/Front/js/viewNews.js')

    .addEntry('Back/index', './assets/Back/js/index.js')
    .addEntry('Back/event', './assets/Back/js/event.js')
    .addEntry('Back/editevent', './assets/Back/js/editevent.js')
    .addEntry('Back/news', './assets/Back/js/news.js')
    .addEntry('Back/editnews', './assets/Back/js/editnews.js')
    .addEntry('Back/media', './assets/Back/js/media.js')
    .addEntry('Back/editmedia', './assets/Back/js/editmedia.js')

    .addEntry('FOSUserBundle/login', './assets/FOSUserBundle/js/login.js')


    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .enablePostCssLoader()
    .autoProvidejQuery()
    .addPlugin(new CopyWebPackPlugin([
        {from: './assets/images', to: 'images'}
    ]))

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

// uncomment if you use Sass/SCSS files
//.enableSassLoader()

// uncomment if you're having problems with a jQuery plugin
//.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();