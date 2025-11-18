<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhisperController;

Route::get('/', [WhisperController::class, 'onboarding'])->name('onboarding');
Route::get('/signin', [WhisperController::class, 'signin'])->name('signin');
Route::post('/signin', [WhisperController::class, 'processSignin'])->name('signin.process');
Route::get('/signup', [WhisperController::class, 'signup'])->name('signup');
Route::post('/signup', [WhisperController::class, 'processSignup'])->name('signup.process');

Route::get('/home', [WhisperController::class, 'home'])->name('home');
Route::get('/journal', [WhisperController::class, 'journal'])->name('journal');
Route::get('/chatrooms', [WhisperController::class, 'chatrooms'])->name('chatrooms');
Route::get('/crisis', [WhisperController::class, 'crisis'])->name('crisis');
Route::get('/profile', [WhisperController::class, 'profile'])->name('profile');
Route::get('/help', [WhisperController::class, 'help'])->name('help');
Route::get('/privacy', [WhisperController::class, 'privacy'])->name('privacy');
Route::get('/terms', [WhisperController::class, 'terms'])->name('terms');
Route::get('/contact', [WhisperController::class, 'contact'])->name('contact');

// API routes for form submissions
Route::post('/api/journal/save', [WhisperController::class, 'saveJournalEntry'])->name('api.journal.save');
Route::post('/api/affirmation/generate', [WhisperController::class, 'generateAffirmation'])->name('api.affirmation.generate');
Route::post('/api/affirmation/save', [WhisperController::class, 'saveAffirmation'])->name('api.affirmation.save');
Route::get('/api/affirmations/saved', [WhisperController::class, 'getSavedAffirmations'])->name('api.affirmations.saved');
Route::get('/api/journal/recent', [WhisperController::class, 'getRecentEntries'])->name('api.journal.recent');
Route::delete('/api/affirmation/{id}', [WhisperController::class, 'deleteAffirmation'])->name('api.affirmation.delete');
Route::delete('/api/journal/{id}', [WhisperController::class, 'deleteJournalEntry'])->name('api.journal.delete');
Route::post('/api/mood/save', [WhisperController::class, 'saveMoodEntry'])->name('api.mood.save');
Route::get('/api/chat/{groupName}/messages', [WhisperController::class, 'getChatMessages']);
Route::post('/api/chat/send', [WhisperController::class, 'sendChatMessage']);
Route::post('/api/settings/update', [WhisperController::class, 'updateSettings']);
Route::post('/api/mpesa/donate', [WhisperController::class, 'initiateMpesaDonation']);
Route::get('/api/mpesa/status/{transactionId}', [WhisperController::class, 'checkPaymentStatus']);
Route::post('/api/mpesa/webhook', [WhisperController::class, 'mpesaWebhook']);
Route::post('/logout', [WhisperController::class, 'logout'])->name('logout');