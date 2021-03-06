<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('inicio');
// Route::get('/',function(){
// 	return view('layouts.construccion');
// });
Route::get('pagar/','PaymentsController@pay')->name('pagar');
Route::get('pagar/completado','PaymentsController@execute')->name('execute');
 Route::get('pagos/updateAndStore','PaymentsController@updateAndStore');
 Route::get('pagos/{shopping_cart_id}','PaymentsController@create');// poner primero
// //que una resource
 Route::resource('pagos','PaymentsController',['online'=>['store']]);
 Route::resource('in_shopping_carts','InShoppingCartsController',['only'=>['store','update','destroy']]);
 Route::get('articles/image/{fileName}','ArticlesController@images');
Route::put('producto/{id}','ArticlesController@update')->name('updateProduct');
 Route::resource('producto','ArticlesController');


 Route::get('/home', 'HomeController@index');
 Route::resource('remisiones','RemisionesController');
 Route::resource('compras','ShoppingCartsController',['only'=>['show']]);
 Route::get('carrito/productos','ShoppingCartsController@products')->name('cart.products');
 Route::get('configuraciones/image/{fileName}','ImagesPage@images');
 Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

 Route::get('/home', 'HomeController@index');
 //NUEVAS RUTAS*****************************************************************
 Route::post('search/','ArticlesController@searching');
 // Route::get('productos/{section_id}','SectionsController@articles');
 Route::get('productos/serie/{id}','SectionsController@serie');
// //MARCAS .......
 Route::get('marca/{id_marca}','BrandsController@articles'); // ver productos por una marca
 Route::get('marca/serie/{id}','BrandsController@serie');
 Route::post('marca/series','BrandsController@series');
 Route::get('marca/linea/{id_linea}','BrandsController@brandLine');
 //Lineas
 Route::get('lineas/','LinesController@index');
 Route::get('lineas/{id}','LinesController@products');
 //productos - articulos
 Route::get('products/list','SectionsController@listProducts');
 Route::get('productos/{section_id}','SectionsController@articles');
 Route::get('productos/linea/{id_linea}','SectionsController@productsLine');
 Route::post('productos/series/','SectionsController@series');

 Route::get('/home', 'HomeController@index');
 //Route::post('buscar/','ArticlesController@searching');
 //PDF--------------PDF--------------------PDF------------------------------PDF----
 Route::get('cotizacion/','PDFController@quotation');
 //Route::get('prueba/','ServiceController@pdf');
 //soap
 Route::get('soap/obtenerParidad','ArticlesController@obtenerParidad');


Route::resource('users','UserController');
Route::get('/home', 'HomeController@index')->name('home');
 //Route::resource('/slider','SlidersController');
 ///////////////routes para el panel//////////////////////////////////////////////////////////////77

 Route::middleware(['auth'])->group(function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard')->middleware('permission:dashboard');
   Route::get('orders','OrdersController@index')->name('orders.index')->middleware('permission:orderes.index');
   Route::get('orders/create','OrdersController@create')->name('orders.create');
   Route::post('orders','OrdersController@store')->name('orders.store');
   Route::get('orders/{order}','OrdersController@show');
   Route::put('orders/{order}','OrdersController@update');
 });
 Route::namespace('admin')->middleware(['auth'])->group(function(){
   	Route::get('utilities/filtro','UtilityController@categoryFilter');
   	Route::resource('slider','SlidersController');
   	Route::resource('utilities','UtilityController');
   	Route::resource('products','ProductsController');
   	Route::get('another-provider','ProductsController@anotherProvider');
    Route::resource('quotations','QuotationController');
    Route::get('correo','QuotationController@email');
 });

 // menu items------------------------------------------------------------------
 Route::middleware(['auth'])->group(function(){
   Route::get('/item-products','ItemProductsController@index');
   Route::get('/brand-products/{brand}','BrandProductsController@index');
   Route::get('/items-brands','ItemsBrandsController@index');
   Route::get('/section-products/{section}','SectionProductsController@index');
 });

 // productos de linea de seccion
Route::middleware(['auth'])->group(function(){
  Route::get('/section-line-products','SectionLineProductsController@index');
});

// productos de serie de seccion
Route::middleware(['auth'])->group(function(){
  Route::get('/section-series-products','SectionSeriesProductsController@index');
});


Route::get('storage-link',function(){
  if(file_exists(public_path('storage'))) {

      return 'The "public/storage" directory already exists.';
  }
  app('files')->link(
      storage_path('app/public'), public_path('storage')
  );
  return 'The [public/storage] directory has been linked.';
});
Route::get('/queue-work', function() {
				$status = Artisan::call('queue:work');
				return '<h1>Comando ejecutado</h1>';

      });
Auth::routes();
