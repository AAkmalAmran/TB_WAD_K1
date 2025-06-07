<?php

use App\Http\Controllers\API\AspirasiApiController;
use Illuminate\Support\Facades\Route;

Route::get('aspirasis', [AspirasiApiController::class, 'index']);