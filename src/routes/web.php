<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeLogsController;

Route::group(['middleware' => ['auth']], function () {
    Route::resource('changelogs', ChangeLogsController::class);
    Route::get("/changelogsfetchalldatas",[ChangeLogsController::class,"fetchalldatas"])->name("changelogs.fetchalldatas");


    Route::resource('whatsnews', WhatsNewsController::class);

});