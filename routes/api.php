<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('cities/{provinceId}', [ApiController::class, 'getCities']);
Route::get('companies', [ApiController::class, 'getCompanies']);
