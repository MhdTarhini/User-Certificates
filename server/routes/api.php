<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificatesController;

Route::group(["prefix" => "guest"], function(){
    Route::post("login", [AuthController::class, "login"]);
    Route::post("register", [AuthController::class, "register"]);
});

Route::group(["middleware" => "auth:api"], function(){
    Route::post("logout", [AuthController::class, "logout"]);

    Route::group(["prefix" => "certificate"], function(){
        Route::get("certificate_types", [CertificatesController::class, "getCertificateTypes"]);
        Route::post("add_certificate", [CertificatesController::class, "addCertificate"]);
});

});
