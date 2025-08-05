<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Database migration commands
Route::get('/migration-fresh', function () {
    $exitCode = Artisan::call('migrate:fresh');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

Route::get('/migrate-rollback', function () {
    $exitCode = Artisan::call('migrate:rollback');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Cache commands
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

Route::get('/config-clear', function () {
    $exitCode = Artisan::call('config:clear');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Route commands
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

Route::get('/route-list', function () {
    $exitCode = Artisan::call('route:list');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Storage commands
Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Queue commands
Route::get('/queue-work', function () {
    $exitCode = Artisan::call('queue:work --stop-when-empty');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

Route::get('/queue-restart', function () {
    $exitCode = Artisan::call('queue:restart');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Maintenance mode
// Route::get('/down', function () {
//     $exitCode = Artisan::call('down');
//     $output = Artisan::output();
//     return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
// });

Route::get('/up', function () {
    $exitCode = Artisan::call('up');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Database seeding
Route::get('/seed', function () {
    $exitCode = Artisan::call('db:seed');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Package discovery
Route::get('/package-discover', function () {
    $exitCode = Artisan::call('package:discover');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Optimize
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Schedule test
Route::get('/schedule-run', function () {
    $exitCode = Artisan::call('schedule:run');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Key generation
Route::get('/key-generate', function () {
    $exitCode = Artisan::call('key:generate');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Custom command execution with parameters
Route::get('/run-command/{command}', function ($command) {
    try {
        $exitCode = Artisan::call($command);
        $output = Artisan::output();
        return "Command: $command <br> Exit Code: $exitCode <br> Output: <pre>$output</pre>";
    } catch (\Exception $e) {
        return "Error executing command: " . $e->getMessage();
    }
});
