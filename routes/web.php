<?php

/*
|--------------------------------------------------------------------------
| Rutas de web
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas web para su aplicación. Estas
| RouteServiceProvider carga las rutas dentro de un grupo que
| contiene el grupo de middleware "web".
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/','IndexController@index');

Route::match(['get', 'post'], '/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Ruta de filtrado de productos
Route::match(['get', 'post'],'/products-filter', 'ProductsController@filter');

// Categoria lista de paginas
Route::get('/products/{url}','ProductsController@products');

// Detalle del producto
Route::get('/product/{id}','ProductsController@product');

// Pagina de carrito
Route::match(['get', 'post'],'/cart','ProductsController@cart');

// Ruta de agregar al carrito
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addtocart');

// Ruta de eliminar del carrito
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');

// Actualizar cantidad de producto del carrito
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

// Obtenga el precio del atributo del producto
Route::any('/get-product-price','ProductsController@getProductPrice');

// Aplicar cupon
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

// Registo/Login de usuarios
Route::get('/login-register','UsersController@userLoginRegister');

Route::match(['get','post'],'forgot-password','UsersController@forgotPassword');

// Formulario de registro de los usuarios
Route::post('/user-register','UsersController@register');

// Confirmar Cuenta
Route::get('confirm/{code}','UsersController@confirmAccount');

// Formulario de inicio de sesión de los usuarios
Route::post('user-login','UsersController@login');

// Salir de la sesion
Route::get('/user-logout','UsersController@logout');

// Buscar productos
Route::post('/search-products','ProductsController@searchProducts');

// Verificar si el usuario existe
Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');

// Verificar pincode
Route::post('/check-pincode','ProductsController@checkPincode');

// Verificar suscripcion de email
Route::post('/check-subscriber-email','NewsletterController@checkSubscriber');

// Añadir Email a la suscripcion
Route::post('/add-subscriber-email','NewsletterController@addSubscriber');

// Todas las rutas despues del login
Route::group(['middleware'=>['frontlogin']],function(){
	// Pagina de cuenta de usuarios
	Route::match(['get','post'],'account','UsersController@account');
	// Verificar contraseña actual del usuario
	Route::post('/check-user-pwd','UsersController@chkUserPassword');
	// Actualziar contraseña de usuario
	Route::post('/update-user-pwd','UsersController@updatePassword');
	// Verificar pagina
	Route::match(['get','post'],'checkout','ProductsController@checkout');
	// Pagina de revisión de pedidos
	Route::match(['get','post'],'/order-review','ProductsController@orderReview');
	// Realizar pedido
	Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
	// Pagina de gracias
	Route::get('/thanks','ProductsController@thanks');
	// Pagina de paypal
	Route::get('/paypal','ProductsController@paypal');
	// Pagina de pedidos de usuarios
	Route::get('/orders','ProductsController@userOrders');
	// Pagina de productos pedidos por el usuario
	Route::get('/orders/{id}','ProductsController@userOrderDetails');
	// Pagina de gracias Paypal
	Route::get('/paypal/thanks','ProductsController@thanksPaypal');
	// Pagina de cancelar Paypal
	Route::get('/paypal/cancel','ProductsController@cancelPaypal');
	// Pagina de lista de compras
	Route::match(['get','post'],'wish-list','ProductsController@wishList');
	// Borrar producto de la lista de compras
	Route::get('/wish-list/delete-product/{id}','ProductsController@deleteWishlistProduct');

	// Rutas payumoney
	Route::get('payumoney','PayumoneyController@payumoneyPayment');
});
	Route::post('/payumoney/response','PayumoneyController@payumoneyResponse');
	Route::get('/payumoney/thanks','PayumoneyController@payumoneyThanks');
	Route::get('/payumoney/fail','PayumoneyController@payumoneyFail');
	Route::get('/payumoney/verification/{id}','PayumoneyController@payumoneyVerification');
	Route::get('/payumoney/verify','PayumoneyController@payumoneyVerify');

	// Paypal IPN
	Route::post('/paypal/ipn','ProductsController@ipnPaypal');

Route::group(['middleware' => ['adminlogin']], function () {
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get', 'post'],'/admin/update-pwd','AdminController@updatePassword');

	// Ruta de categorias de administrador
	Route::match(['get', 'post'], '/admin/add-category','CategoryController@addCategory');
	Route::match(['get', 'post'], '/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get', 'post'], '/admin/delete-category/{id}','CategoryController@deleteCategory');
    Route::get('/admin/view-categories','CategoryController@viewCategories');

	// Ruta de productos de administrados
	Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');

	Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');

	Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');

	Route::get('/admin/view-products','ProductsController@viewProducts');

	Route::get('/admin/export-products','ProductsController@exportProducts');

	Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');

	Route::get('/admin/delete-product-video/{id}','ProductsController@deleteProductVideo');

	Route::match(['get', 'post'], '/admin/add-images/{id}','ProductsController@addImages');

	Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteProductAltImage');

	// Ruta de atributos de administrador
	Route::match(['get', 'post'], '/admin/add-attributes/{id}','ProductsController@addAttributes');

	Route::match(['get', 'post'], '/admin/edit-attributes/{id}','ProductsController@editAttributes');

	Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');

	// Ruta de cupones de administrador
	Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
	Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
	Route::get('/admin/view-coupons','CouponsController@viewCoupons');
	Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

	// Ruta de banners de administrador
	Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
	Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
	Route::get('admin/view-banners','BannersController@viewBanners');
    Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');

    // Ruta de galeria de administrador
    Route::match(['get','post'],'/admin/add-gallery','GalleryController@addGallery');

    Route::get('admin/view-gallery','GalleryController@viewGallery');

    Route::get('/admin/delete-gallery/{id}','GalleryController@deleteGallery');

	Route::match(['get','post'],'/admin/edit-gallery/{id}','GalleryController@editGallery');

    // Ruta de noticias de administrador

	Route::get('admin/view-news','NewsController@viewNewsAdmin');

	Route::match(['get','post'],'/admin/add-news','NewsController@addNews');

	Route::get('/admin/delete-new/{id}','NewsController@deleteNew');

	Route::match(['get','post'],'/admin/edit-news/{id}','NewsController@editNews');

	// Ruta de FAQ de administrador
	Route::get('admin/view-faq','FaqController@viewFaqAdmin');

	Route::match(['get','post'],'/admin/add-faq','FaqController@addFaqs');

	Route::get('/admin/delete-faq/{id}','FaqController@deleteFaq');

    Route::match(['get','post'],'/admin/edit-faq/{id}','FaqController@editFaqs');

    Route::get('/admin/export-faqs','FaqController@exportFaqs');

    Route::post('/admin/import-faqs','FaqController@importFaqs');


	// Ruta de ordenes de administrador
	Route::get('/admin/view-orders','ProductsController@viewOrders');

	// Ruta de graficos de órdenes de administrador
	Route::get('/admin/view-orders-charts','ProductsController@viewOrdersCharts');

	// Ruta de detalles de la orden de administrador
	Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');

	// Factura de pedido
	Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');

	// Factura PDF
    Route::get('/admin/view-pdf-invoice/{id}','ProductsController@viewPDFInvoice');

    // Factura PDF Correo
	Route::get('/user/view-pdf-invoice/{id}','ProductsController@viewPDFInvoiceUser');

	// Actualizar el estado de la orden
	Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');

	// Ruta de usuarios de administrador
    Route::get('/admin/view-users','UsersController@viewUsers');

    // Borrar usuario en administador

	Route::get('/admin/delete-users/{id}','UsersController@deleteUsers');
	
	// Actualizar estado usuario en administador

	Route::match(['get','post'],'/admin/update-status-users/{id}','UsersController@statusUsers');

    // Actualizar de usuario a cliente en administrador

    Route::match(['get','post'],'/admin/edit-client-page/{id}','UsersController@UpdateClient');

    // Ver columna de usuarios Cliente

    Route::get('/admin/view-user-client','UsersController@viewUpdateClient');

	// Ruta de gráficos de usuarios en administrador
    Route::get('/admin/view-users-charts','UsersController@viewUsersCharts');

    // Ruta de los graficos en administrador
	Route::get('/admin/view-users-charts-dashboard','UsersController@viewUsersChartsDashboard');

	// Ruta de los paises del los usuarios en administrador
	Route::get('/admin/view-users-countries-charts','UsersController@viewUsersCountriesCharts');

	// Ruta de exportar usuarios
	Route::get('/admin/export-users','UsersController@exportUsers');

	// Ruta de administrador/subadministrador
	Route::get('/admin/view-admins','AdminController@viewAdmins');

	// ruta de añadir administrador/subadministrador
	Route::match(['get','post'],'/admin/add-admin','AdminController@addAdmin');

	// Ruta de editar adminsitrador/subadministrador
	Route::match(['get','post'],'/admin/edit-admin/{id}','AdminController@editAdmin');

	// Ruta de añadir CMS
	Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');

	// Ruta de editar CMS
	Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');

	// Ruta de ver paginas CMS
	Route::get('/admin/view-cms-pages','CmsController@viewCmsPages');

	// Ruta de borrar CMS
	Route::get('/admin/delete-cms-page/{id}','CmsController@deleteCmsPage');

	// Obtener consultas
	Route::get('/admin/get-enquiries','CmsController@getEnquiries');

	// Ver consultas
	Route::get('/admin/view-enquiries','CmsController@viewEnquiries');

	// Rutas de divisas
	// Ruta de añadir divisa
	Route::match(['get','post'],'/admin/add-currency','CurrencyController@addCurrency');

	// Ruta de editar divisa
	Route::match(['get','post'],'/admin/edit-currency/{id}','CurrencyController@editCurrency');

	// Ruta de eliminar divisa
	Route::get('/admin/delete-currency/{id}','CurrencyController@deleteCurrency');

	// Ruta de ver divisas
	Route::get('/admin/view-currencies','CurrencyController@viewCurrencies');

	// Ver los gastos de envio
	Route::get('/admin/view-shipping','ShippingController@viewShipping');

	// Actualizar los gastos de envio
	Route::match(['get','post'],'/admin/edit-shipping/{id}','ShippingController@editShipping');

	// Ver suscriptores en el boletin
	Route::get('admin/view-newsletter-subscribers','NewsletterController@viewNewsletterSubscribers');

	// Actualizar el estado del boletin
	Route::get('admin/update-newsletter-status/{id}/{status}','NewsletterController@updateNewsletterStatus');

	// Eliminar el boletin del email
	Route::get('admin/delete-newsletter-email/{id}','NewsletterController@deleteNewsletterEmail');

	// Exportar email al boletin
	Route::get('/admin/export-newsletter-emails','NewsletterController@exportNewsletterEmails');
});


Route::get('/logout','AdminController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Mostrar página de contacto
Route::match(['get','post'],'/page/contact','CmsController@contact');

// Mostrar página de publicación (for Vue.js)
Route::match(['get','post'],'/page/post','CmsController@addPost');

// Mostrar página de CMS
Route::match(['get','post'],'/page/{url}','CmsController@cmsPage');

// Ver galeria

Route::get('Gallery','GalleryController@Gallery');


// Ver noticias

Route::get('News','NewsController@news');

// Ver quienes somos

Route::get('About','AboutUsController@About');

// Ver FAQS

Route::get('Faqs','FaqController@Faq');
