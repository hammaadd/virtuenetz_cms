<?php

/**
 * Register System routes before all user routes.
 */
App::before(function ($request) {
    /*
     * Combine JavaScript and StyleSheet assets
     */
    Route::any('combine/{file}', [\System\Classes\SystemController::class, 'combine']);

    /*
     * Resize image assets
     */
    Route::get('resize/{file}', [\System\Classes\SystemController::class, 'resize']);
});

Route::get('clear-cache', function () {
	
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    dd("Done");
});

Route::get('install-plugin', function () {
    Artisan::call('plugin:install vdlp.redirect');
    dd("Done");
});