<?php

/**
 * Demo Extension Routes
 *
 * These routes are automatically registered when your extension is enabled.
 * All routes are automatically prefixed with: /extensions/{extension-id}
 *
 * For this extension, routes will be: /extensions/demo/*
 *
 * MIDDLEWARE:
 * - 'web' middleware is automatically applied
 * - 'auth' middleware is automatically applied (user must be logged in)
 *
 * ROUTE NAMING:
 * It's good practice to name your routes with your extension ID as a prefix
 * Example: 'demo.dashboard' instead of just 'dashboard'
 */

use Illuminate\Support\Facades\Route;

/**
 * ========================================
 * EXAMPLE 1: Simple Route with Closure
 * ========================================
 *
 * URL: /extensions/demo
 * Route Name: demo.index
 */
Route::get('/', function () {
    return view('extension.demo::index', [
        'title' => 'Demo Extension Dashboard',
        'message' => 'Welcome to the Demo Extension!'
    ]);
})->name('demo.index');

/**
 * ========================================
 * EXAMPLE 2: Route with View Only
 * ========================================
 *
 * URL: /extensions/demo/about
 * Route Name: demo.about
 */
Route::view('/about', 'extension.demo::about')->name('demo.about');

/**
 * ========================================
 * EXAMPLE 3: Route with Controller
 * ========================================
 *
 * NOTE: You would create a Controllers folder and add your controller classes
 *
 * URL: /extensions/demo/dashboard
 * Route Name: demo.dashboard
 */
// Route::get('/dashboard', [\App\Extensions\Installed\Demo\Controllers\DashboardController::class, 'index'])
//     ->name('demo.dashboard');

/**
 * ========================================
 * EXAMPLE 4: Route with Parameters
 * ========================================
 *
 * URL: /extensions/demo/logs/123
 * Route Name: demo.logs.show
 */
Route::get('/logs/{id}', function ($id) {
    return view('extension.demo::log-detail', [
        'logId' => $id
    ]);
})->name('demo.logs.show');

/**
 * ========================================
 * EXAMPLE 5: POST Route (for forms)
 * ========================================
 *
 * URL: POST /extensions/demo/settings
 * Route Name: demo.settings.save
 */
Route::post('/settings', function (\Illuminate\Http\Request $request) {
    // Validate the request
    $validated = $request->validate([
        'setting_name' => 'required|string|max:255',
        'setting_value' => 'required|string',
    ]);

    // Save settings
    $manager = app(\App\Extensions\ExtensionManager::class);
    $settings = $manager->getSettings('demo');
    $settings[$validated['setting_name']] = $validated['setting_value'];
    $manager->updateSettings('demo', $settings);

    // Redirect back with success message
    return redirect()->route('demo.index')
        ->with('success', 'Settings saved successfully!');
})->name('demo.settings.save');

/**
 * ========================================
 * EXAMPLE 6: Route Group with Middleware
 * ========================================
 *
 * Add additional middleware to specific routes
 */
Route::middleware(['role:superadmin'])->group(function () {
    // Only superadmins can access these routes

    Route::get('/admin', function () {
        return view('extension.demo::admin');
    })->name('demo.admin');

    Route::get('/admin/settings', function () {
        $manager = app(\App\Extensions\ExtensionManager::class);
        $settings = $manager->getSettings('demo');

        return view('extension.demo::admin-settings', [
            'settings' => $settings
        ]);
    })->name('demo.admin.settings');
});

/**
 * ========================================
 * EXAMPLE 7: API-style JSON Response
 * ========================================
 *
 * URL: /extensions/demo/api/status
 * Route Name: demo.api.status
 */
Route::get('/api/status', function () {
    return response()->json([
        'status' => 'ok',
        'extension' => 'demo',
        'version' => '1.0.0',
        'enabled' => true,
    ]);
})->name('demo.api.status');

/**
 * ========================================
 * EXAMPLE 8: Resource Routes
 * ========================================
 *
 * Create CRUD routes for a resource
 */
// Route::resource('items', \App\Extensions\Installed\Demo\Controllers\ItemController::class)
//     ->names([
//         'index' => 'demo.items.index',
//         'create' => 'demo.items.create',
//         'store' => 'demo.items.store',
//         'show' => 'demo.items.show',
//         'edit' => 'demo.items.edit',
//         'update' => 'demo.items.update',
//         'destroy' => 'demo.items.destroy',
//     ]);

/**
 * ========================================
 * BEST PRACTICES
 * ========================================
 *
 * 1. Always name your routes with extension prefix (demo.*)
 * 2. Use proper HTTP verbs (GET, POST, PUT, DELETE)
 * 3. Validate all POST/PUT requests
 * 4. Check permissions for sensitive routes
 * 5. Return appropriate responses (views, JSON, redirects)
 * 6. Handle errors gracefully
 * 7. Log important actions
 * 8. Use CSRF protection (automatic with 'web' middleware)
 */

/**
 * ========================================
 * ACCESSING YOUR ROUTES
 * ========================================
 *
 * In Blade views:
 * <a href="{{ route('demo.index') }}">Dashboard</a>
 *
 * In controllers/code:
 * return redirect()->route('demo.index');
 *
 * Generating URLs:
 * $url = route('demo.index');
 *
 * With parameters:
 * $url = route('demo.logs.show', ['id' => 123]);
 */
