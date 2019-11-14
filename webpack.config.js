var Encore = require('@symfony/webpack-encore');
var glob = require("glob");

Encore
    .setOutputPath('public/assets/')
    .setPublicPath('/assets')
    .enableSassLoader()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .configureFilenames({
        css: 'css/[name]-[contenthash].css',
        js: 'js/[name]-[contenthash].js'
    })
    .addEntry('admin_js',
        [
            'bootstrap',
            'admin-lte/dist/js/adminlte.min.js'
        ]
            .concat([])
    )
    .addStyleEntry('admin_css',
        [
            'bootstrap/dist/css/bootstrap.min.css',
            'admin-lte/plugins/fontawesome-free/css/all.min.css',
            'admin-lte/dist/css/adminlte.min.css'
        ]
            .concat(glob.sync("./assets/scss/*.scss"))
    )
    .addStyleEntry('admin_dataTables',
        [
            'datatables.net-bs4/css/dataTables.bootstrap4.css'
        ]
    )

    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

;

module.exports = Encore.getWebpackConfig();