<?php

use Illuminate\Support\Facades\Route;

Route::apiResource("blog", \App\Http\Controllers\PostController::class);
