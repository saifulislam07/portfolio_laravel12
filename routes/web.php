<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController as FrontendProjectController;
use App\Http\Controllers\GalleryController as FrontendGalleryController;
use App\Http\Controllers\ContactController as FrontendContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/projects', [FrontendProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [FrontendProjectController::class, 'show'])->name('projects.show');
Route::get('/contact', [FrontendContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [FrontendContactController::class, 'store'])->name('contact.store');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index']);

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/clear-cache', function() {
        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:clear');
        \Artisan::call('route:clear');
        return redirect()->back()->with('success', 'System cache cleared successfully!');
    })->name('clear-cache');
    
    Route::resource('projects', ProjectController::class);
    Route::delete('projects/image/{image}', [ProjectController::class, 'deleteImage'])->name('projects.deleteImage');
    
    Route::resource('skills', SkillController::class);
    Route::resource('hobbies', \App\Http\Controllers\Admin\HobbyController::class);
    
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages/mark-read/{message}', [MessageController::class, 'show'])->name('messages.mark-read');
    Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect /dashboard to /admin/dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
