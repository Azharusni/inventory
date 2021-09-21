<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});

Route::apiResource('/employee',EmployeeController::class);
Route::apiResource('/supplier',SupplierController::class);
Route::apiResource('/category',CategoryController::class);
Route::apiResource('/product',ProductController::class);
Route::apiResource('/expense',ExpenseController::class);
Route::apiResource('/customer',CustomerController::class);

Route::post('/salary/paid/{id}',[SalaryController::class, 'paid']);
Route::get('/salary',[SalaryController::class, 'allSalary']);
Route::get('/salary/view/{id}',[SalaryController::class, 'viewSalary']);
Route::get('/edit/salary/{id}',[SalaryController::class, 'editSalary']);
Route::post('/salary/update/{id}',[SalaryController::class, 'updateSalary']);

Route::post('/stock/update/{id}',[ProductController::class, 'stockUpdate']);

Route::get('/getting/product/{id}',[PosController::class, 'getProduct']);

Route::get('/addToCart/{id}',[CartController::class, 'addToCart']);

Route::get('/cart/product',[CartController::class, 'CartProduct']);
Route::get('/remove/cart/{id}',[CartController::class, 'removeCart']);
Route::get('/increment/{id}',[CartController::class, 'increment']);
Route::get('/decrement/{id}',[CartController::class, 'decrement']);

//vat routes
Route::get('/vats',[CartController::class, 'Vats']);
Route::post('/orderdone',[CartController::class, 'orderDone']);

//Order Routes
Route::get('/orders',[OrderController::class, 'todayOrder']);

Route::get('/order/details/{id}',[OrderController::class, 'OrderDetails']);
Route::get('/order/orderdetails/{id}',[OrderController::class, 'OrderDetailsAll']);

Route::get('/search/order',[OrderController::class, 'SearchOrderDate']);

//Admin dashboard routes
Route::get('/today/sell',[PosController::class, 'TodaySell']);
Route::get('/today/income',[PosController::class, 'TodayIncome']);
Route::get('/today/due',[PosController::class, 'TodayDue']);
Route::get('/today/expense',[PosController::class, 'TodayExpense']);
Route::get('/today/stockout',[PosController::class, 'StockOut']);
