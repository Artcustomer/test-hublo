const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .addEntry('app', './assets/app.js')
    .enableVueLoader()
    .enableStimulusBridge('./assets/controllers.json')
    .splitEntryChunks() 
    .enableSingleRuntimeChunk() 
;

module.exports = Encore.getWebpackConfig();
