<?php

use Illuminate\Support\Facades\Route;
use Company\Changelog\Controllers\ChangelogController;

Route::group(['middleware' => ['auth']], function () {
    Route::resource('changelogs', ChangeLogsController::class);
    Route::get("/changelogsfetchalldatas",[ChangeLogsController::class,"fetchalldatas"])->name("changelogs.fetchalldatas");


    Route::resource('whatsnews', WhatsNewsController::class);

});