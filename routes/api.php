<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\NotifsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TechnicalController;
use App\Http\Controllers\AdminsController;

// Auth
Route::put("/update/password",[AuthController::class,"changePassword"]);
Route::post("/login",[AuthController::class,"login"]);
Route::post("/register",[AuthController::class,"register"]);
Route::post("/logout",[AuthController::class,"logout"]);
Route::post("/search/email",[UserController::class,"searchMail"]);
Route::post("/login/admin",[AdminsController::class,"login"]);
Route::post("/register/admin",[AdminsController::class,"register"]);
Route::put("/update/password/admin",[AdminsController::class,"changePassword"]);
Route::post("/logout/admin",[AdminsController::class,"logout"]);
Route::post("/search/email/admin",[AdminsController::class,"searchMail"]);

// User
Route::get("/get/users",[UserController::class,"retrieveAll"]);
Route::get("/get/user/{id}",[UserController::class,"retrieve"]);
Route::put("/update/user",[UserController::class,"modify"]);
Route::put("/update/profile/user",[UserController::class,"changeProfile"]);
Route::delete("/delete/user/{id}",[UserController::class,"destroy"]);

// Address
Route::get("/get/address/{id}",[AddressController::class,"retrieve"]);
Route::get("/get/address",[AddressController::class,"retrieveAll"]);
Route::put("/update/address",[AddressController::class,"update"]);
Route::post("/add/address",[AddressController::class,"add"]);
Route::delete("/delete/address/{id}",[AddressController::class,"destroy"]);

// Services
Route::get("/get/services/{id}",[ServicesController::class,"retrieve"]);
Route::get("/get/services",[ServicesController::class,"retrieveAll"]);
Route::put("/update/services",[ServicesController::class,"update"]);
Route::post("/add/services",[ServicesController::class,"add"]);
Route::delete("/delete/services/{id}",[ServicesController::class,"destroy"]);

// Orders
Route::post("/add/order",[OrdersController::class,"add"]);
Route::get("/get/orders",[OrdersController::class,"retrieveAll"]);
Route::get("/get/order/owner/{id}",[OrdersController::class,"retrieveOwner"]);
Route::get("/get/order/customer/{id}",[OrdersController::class,"retrieveCustomer"]);
Route::put("/update/order/status",[OrdersController::class,"updateStatus"]);
Route::delete("/delete/order/{id}",[OrdersController::class,"destroy"]);

// Notification
Route::get("/get/notif/{id}",[NotifsController::class,"retrieve"]);
Route::post("/add/notif",[NotifsController::class,"send"]);
Route::delete("/delete/notif/{id}",[NotifsController::class,"destroy"]);

// Report
Route::get("/get/report/{id}",[ReportController::class,"retrieve"]);
Route::post("/add/report",[ReportController::class,"add"]);

// Feedbacks
Route::get("/get/feedbacks",[FeedbackController::class,"retrieve"]);
Route::post("/send/feedback",[FeedbackController::class,"send"]);
Route::delete("/delete/feedback/{id}",[FeedbackController::class,"destroy"]);

// Technicals
Route::get("/get/technicals",[TechnicalController::class,"retrieve"]);
Route::post("/send/technical",[TechnicalController::class,"send"]);
Route::delete("/delete/technical/{id}",[TechnicalController::class,"destroy"]);

// Admin
Route::get("/get/admin/{id}",[AdminsController::class,"retrieve"]);
Route::put("/update/profile/admin",[AdminsController::class,"changeProfile"]);
Route::delete("/delete/admin/{id}",[AdminsController::class,"destroy"]);




