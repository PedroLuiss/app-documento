<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;
use App\Http\Controllers\Api\V2\Auth\LoginController;
use App\Http\Controllers\Api\V2\Auth\LogoutController;
use App\Http\Controllers\Api\V2\Auth\RegisterController;
use App\Http\Controllers\Api\V2\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V2\Auth\ResetPasswordController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v2')->middleware('json.api')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/logout', LogoutController::class)->middleware('auth:api');
    Route::post('/register', RegisterController::class);
    Route::post('/password-forgot', ForgotPasswordController::class);
    Route::post('/password-reset', ResetPasswordController::class)->name('password.reset');

});


Route::middleware(['auth:api','json.api'])->group(function () {

     /**----------------------------------------------------ROUTER DOCUMETN---------------------------------------------------- */
     Route::get('/document/list', [DocumentController::class, 'list_document'])->name('document.listdocument');
     Route::get('/document/tipo/list', [DocumentController::class, 'list_tipo'])->name('document.listdocumenttipo');
     Route::get('/document/proceso/list', [DocumentController::class, 'list_proceso'])->name('document.listdocumentproceso');
     Route::post('/document/store', [DocumentController::class, 'store'])->name('document.store');
     Route::get('/document/edit/{id}', [DocumentController::class, 'edit'])->name('employee.editemployee');
     Route::delete('/document/delet/{id}', [DocumentController::class, 'delete_document'])->name('employee.deletemployee');
     /**----------------------------------------------------END ROUTER DOCUMETN---------------------------------------------------- */
});


