<?php

use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Agent\ClientController;
use App\Http\Controllers\Agent\UserController;
use App\Http\Controllers\Agent\WalletController;
use App\Http\Controllers\Admin\KitController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\PaymentController;

Route::namespace('Panel')->prefix('panel')->middleware(['RemoveArabicAndNoneEnglishNumbers', 'auth:web'])->group(function () {

    Route::get('/', function () {
        return redirect('/panel/' . auth()->user()->role);
    });
    Route::get('/change_password', [\App\Http\Controllers\UserController::class, "change_password"])->name('agent.change_password.index');
    Route::post('/change_password', [\App\Http\Controllers\UserController::class, "change_password_store"])->name('agent.change_password.store');
});
Route::namespace('Panel')->prefix('panel/agent')->middleware(['RemoveArabicAndNoneEnglishNumbers', 'auth:web', 'IsAgent'])->group(function () {
    Route::get('/', [PanelController::class, "index"]);

    Route::get('/users', [UserController::class, "index"])->name('agent.users.index');
    Route::get('/users/{user}/login_as', [UserController::class, "login_as"])->name('agent.users.login_as');
    Route::get('/login_up', [UserController::class, "login_up"])->name('agent.users.login_up');
    Route::get('/users/details/{user}', [UserController::class, "details"])->name('agent.users.details');
    Route::get('/users/create', [UserController::class, "create"])->name('agent.users.create');
    Route::get('/users/edit/{user}', [UserController::class, "edit"])->name('agent.users.edit');
    Route::post('/users/{user}/update', [UserController::class, "update"])->name('agent.users.update');
    Route::post('/users/save', [UserController::class, "save"])->name('agent.users.save');
    Route::delete('/users/{user}/destroy', [UserController::class, "destroy"])->name('agent.users.destroy');

    Route::get('/clients', [ClientController::class, "index"])->name('agent.clients.index');
    Route::get('/clients/{client}/details', [ClientController::class, "details"])->name('agent.clients.details');
    Route::get('/clients/{client}/order', [ClientController::class, "orderIndex"])->name('agent.clients.order.index');
    Route::post('/clients/{client}/order/sendPaymentURL', [ClientController::class, "sendPaymentURL"])->name('agent.clients.order.sendPaymentURL');
    Route::post('/clients/{client}/order/pay', [ClientController::class, "pay"])->name('agent.clients.order.pay');

    Route::get('/{client}/{product}/get_kits', [ClientController::class, "getKits"])->name('agent.clients.get_kits');
    Route::get('/clients/create', [ClientController::class, "create"])->name('agent.clients.create');
    Route::get('/clients/{client}/edit', [ClientController::class, "edit"])->name('agent.clients.edit');

    Route::post('/clients/personal', [ClientController::class, "savePersonal"])->name('agent.clients.save.personal');
    Route::post('/clients/company', [ClientController::class, "saveCompany"])->name('agent.clients.save.company');

    Route::post('/clients/{client}/personal', [ClientController::class, 'updatePersonal'])->name('agent.clients.update.personal');
    Route::post('/clients/{client}/company', [ClientController::class, 'updateCompany'])->name('agent.clients.update.company');

    Route::delete('/clients/{client}/destroy', [ClientController::class, "destroy"])->name('agent.clients.destroy');
    Route::get('/wallet', [WalletController::class, "index"])->name('agent.wallet.index');

    Route::post('/agent_store', [UserController::class, "store"])->name('agent.store');

    Route::get('/kits', [KitController::class, 'index'])->name('product.kits.index');
    Route::get('/kits/create', [KitController::class, 'create'])->name('product.kits.create');
    Route::post('/kits/save', [KitController::class, 'store'])->name('product.kits.store');
    Route::get('/kits/{kit}/edit', [KitController::class, 'edit'])->name('product.kits.edit');
    Route::post('/kits/{kit}/update', [KitController::class, "update"])->name('product.kits.update');
    Route::delete('/kits/{id}/destroy', [KitController::class, "destroy"])->name('product.kits.delete');


    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/products/{product}/update', [ProductController::class, "update"])->name('product.update');
    Route::delete('/products/{product}/destroy', [ProductController::class, "destroy"])->name('product.delete');
});

Route::prefix('payment')->middleware(['RemoveArabicAndNoneEnglishNumbers'])->group(function () {
    // authorized
    Route::middleware('auth')->group(function () {
        Route::get('request/{amount}', [PaymentController::class, "request"])->name('payment.request');
        Route::get('request/{amount}/{transaction}', [PaymentController::class, "requestByTransaction"])->name('payment.request.transactionId');
        Route::get('{transaction}', [PaymentController::class, 'show'])->name('payment.show');
    });
});

Route::namespace('Panel')->prefix('panel/admin')->middleware(['RemoveArabicAndNoneEnglishNumbers', 'auth:web', 'IsAdmin'])->group(function () {
    Route::get('/', [PanelController::class, "index"]);
});
