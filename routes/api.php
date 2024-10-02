
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/api/{category}', [ApiController::class, 'getByCategory']);
