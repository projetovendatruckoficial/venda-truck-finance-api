<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\CompanyController;
use App\Http\Controllers\Api\Admin\SimulationStatusController;
use App\Http\Controllers\Api\Admin\SimulationController;
use App\Http\Controllers\Api\Admin\SettingController;
use App\Http\Controllers\Api\Admin\SimulationTypeController;
use App\Http\Controllers\Api\Admin\VehicleTypeController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\VehicleConsultationController;
use App\Http\Controllers\Api\Admin\CpfConsultationController;
use App\Http\Controllers\Api\Admin\CnpjConsultationController;





Route::prefix('v1')->group(function () {

    Route::get('status', function () {
        return response()->json(['status' => 'API V1 Venda Truck Finance is alive!'], 200);
    });

    Route::post('login', [AuthController::class, 'login']);
    
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::get('reset-password/{token}', function (Request $request, $token) {
        $email = $request->query('email');
        return redirect("http://localhost:8000/?token={$token}&email={$email}");
    })->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::get('/verify-token', [AuthController::class, 'verifyToken']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
        Route::post('register', [AuthController::class, 'register']);

        Route::apiResource('companies', CompanyController::class);
        Route::apiResource('simulation-statuses', SimulationStatusController::class);
        Route::apiResource('simulations', SimulationController::class);
        Route::apiResource('settings', SettingController::class);
        Route::apiResource('simulation-types', SimulationTypeController::class);
        Route::apiResource('vehicle-types', VehicleTypeController::class);
        Route::apiResource('customers', CustomerController::class);

        Route::post('vehicle/consult/credits', [VehicleConsultationController::class, 'checkCredits']);
        Route::post('cpf/consult/credits', [CpfConsultationController::class, 'checkCredits']);
        Route::post('cnpj/consult/credits', [CnpjConsultationController::class, 'checkCredits']);




    });
});
