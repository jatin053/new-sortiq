<?php

use App\Http\Controllers\Api\ApiDocumentationController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\ClientLogoController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\FresherHiringController;
use App\Http\Controllers\Api\InternshipApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('docs', [ApiDocumentationController::class, 'index'])->name('api.docs');
Route::apiResource('blogs', BlogController::class)->only(['index', 'show']);
Route::apiResource('reviews', ReviewController::class)->only(['index', 'show']);
Route::apiResource('client-logos', ClientLogoController::class)->only(['index', 'show']);
Route::apiResource('videos', VideoController::class)->only(['index', 'show']);
Route::get('contact-messages', [ContactMessageController::class, 'describe'])->name('api.contact-messages.describe');
Route::post('contact-messages', [ContactMessageController::class, 'store'])->name('api.contact-messages.store');
Route::post('fresher-hirings', [FresherHiringController::class, 'store'])->name('api.fresher-hirings.store');
Route::post('internship-applications', [InternshipApplicationController::class, 'store'])->name('api.internship-applications.store');