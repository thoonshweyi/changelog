<?php

use Illuminate\Support\Facades\Route;
use Pro1\Changelog\Http\Controllers\WhatsNewsController;
use Pro1\Changelog\Http\Controllers\ChangeLogsController;

// Route::group(['middleware' => ['auth']], function () {
    Route::resource('changelogs', ChangeLogsController::class);
    Route::get("/changelogsfetchalldatas",[ChangeLogsController::class,"fetchalldatas"])->name("changelogs.fetchalldatas");


    Route::resource('whatsnews', WhatsNewsController::class);

// });