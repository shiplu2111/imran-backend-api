<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\SmtpSettingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ConsultancyInfoController;
use App\Http\Controllers\ConsultationController;
require __DIR__.'/auth.php';

Route::middleware('auth:api')->group(function () {
    Route::get('/user-profile', [UserController::class, 'show'])
        ->name('user.show');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/user-update', [UserController::class, 'update'])
        ->name('user.update');

    Route::patch('/user/change-password', [UserController::class, 'changePassword'])
        ->name('user.change-password');

});

// public routes
    Route::get('/personal-info', [PersonalInfoController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/donations', [DonationController::class, 'index']);
    Route::get('/donations/total', [DonationController::class, 'total']);
    Route::get('/donations/{donation}', [DonationController::class, 'show']);

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    // Photo Routes
    Route::get('/photos', [PhotoController::class, 'index']);
    Route::get('/photos/{id}', [PhotoController::class, 'show']);

    // Video Routes
    Route::get('/videos', [VideoController::class, 'index']);
    Route::get('/videos/{id}', [VideoController::class, 'show']);
    // Blog Routes
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blogs/{blog}', [BlogController::class, 'show']);

    // News Routes
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{news}', [NewsController::class, 'show']);

    // Consultancy Info Routes
    Route::get('/consultancy-info', [ConsultancyInfoController::class, 'index']);
    Route::get('/consultancy-info/{consultancyInfo}', [ConsultancyInfoController::class, 'show']);

    Route::post('/consultations', [ConsultationController::class, 'store']);
    //--------------------------- protected routes-----------------------------//

Route::middleware(['auth:api'])->group(function () {

    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index']);
    Route::put('/user/password', UpdatePasswordController::class);

    // SMTP Settings Routes
    Route::get('/smtp-settings', [SmtpSettingController::class, 'index']);
    Route::post('/smtp-settings', [SmtpSettingController::class, 'store']);
    Route::post('/test-email', [SmtpSettingController::class, 'testEmail']);

    //    Personal Info Routes
    Route::post('/personal-info', [PersonalInfoController::class, 'store']);
    Route::post('/personal-info/update', [PersonalInfoController::class, 'update']); // Use POST for update
    Route::delete('/personal-info', [PersonalInfoController::class, 'destroy']);
    // --- Donations (Admin Write) ---
    Route::post('/donations', [DonationController::class, 'store']);
    Route::put('/donations/{donation}', [DonationController::class, 'update']);
    Route::delete('/donations/{donation}', [DonationController::class, 'destroy']);

    // --- Messages (Admin Read Inbox & Reply) ---
    Route::get('/messages', [MessageController::class, 'index']);       // View Inbox
    Route::get('/messages/{message}', [MessageController::class, 'show']); // View Single
    Route::put('/messages/{message}', [MessageController::class, 'update']); // Mark Read
    Route::delete('/messages/{message}', [MessageController::class, 'destroy']); // Delete
    Route::post('/messages/{message}/reply', [MessageController::class, 'reply']); // Send Reply

    // Category Management Routes
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Photo Management Routes
    Route::post('/photos', [PhotoController::class, 'store']);
    Route::post('/photos/{id}', [PhotoController::class, 'update']); // Note: Using POST for update
    Route::delete('/photos/{id}', [PhotoController::class, 'destroy']);

    // Video Management Routes
    Route::post('/videos', [VideoController::class, 'store']);
    Route::post('/videos/{id}', [VideoController::class, 'update']); // Update via POST
    Route::delete('/videos/{id}', [VideoController::class, 'destroy']);

    // Blog Management Routes
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::post('/blogs/{blog}', [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);
    Route::patch('/blogs/{blog}/publish', [BlogController::class, 'togglePublish']);

    // News Management Routes
    Route::post('/news', [NewsController::class, 'store']);
    Route::put('/news/{news}', [NewsController::class, 'update']);
    Route::delete('/news/{news}', [NewsController::class, 'destroy']);
    Route::patch('/news/{news}/publish', [NewsController::class, 'togglePublish']);

    // Consultancy Info Management Routes
    Route::post('/consultancy-info', [ConsultancyInfoController::class, 'store']);
    Route::put('/consultancy-info/{consultancyInfo}', [ConsultancyInfoController::class, 'update']);
    Route::delete('/consultancy-info/{consultancyInfo}', [ConsultancyInfoController::class, 'destroy']);

    // Consultation Management Routes
    Route::get('/consultations', [ConsultationController::class, 'index']);
    Route::get('/consultations/{consultation}', [ConsultationController::class, 'show']);
    Route::delete('/consultations/{consultation}', [ConsultationController::class, 'destroy']);

    // The 2 Special Routes
    Route::patch('/consultations/{consultation}/status', [ConsultationController::class, 'updateStatus']);
    Route::patch('/consultations/{consultation}/payment', [ConsultationController::class, 'updatePaymentStatus']);
});


