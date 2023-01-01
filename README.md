<p align="center">
<a href="https://packagist.org/packages/wpcommander/framework"><img src="https://img.shields.io/packagist/dt/wpcommander/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/wpcommander/framework"><img src="https://img.shields.io/packagist/v/wpcommander/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/wpcommander/framework"><img src="https://img.shields.io/packagist/l/wpcommander/framework" alt="License"></a>
</p>

## About WpCommander

WpCommander is a wordpress plugin framework that makes web development easy and enjoyable. Its expressive syntax and range of features help developers create high-quality applications with ease.

1. [A straightforward and fast routing system](#routing)
2. [A robust dependency injection container](#dependency-injection)
3. [Middleware Declaration](#middleware)
3. [Controller Declaration](#controller)
4. [Developer-friendly enqueue declaration]()
5. [Global Functions]()
6. Database Query Builder ( upcoming )

### Installation

1. Create plugin with wpcommander

   ```
   composer create-project wpcommander/wpcommander
   ```

2. Setup plugin name and other information, After running this command `npm install` will automatically executed

   ```
   php artisan app:setup
   ```

## Routing

1. WpCommander most basic routes are defined by a URI and a closure, which allows you to easily specify routes and behavior without the need for complex routing configuration files.

   ```php
	use PluginNameSpace\Bootstrap\Route;

	Route::get( '/hello-world', function () {
		wp_send_json( [
			'message' => 'Hello World'
		] );
	} );

   ```

2. All the WpCommander routes can be found in the routes directory, which your application's RouteServiceProvider automatically loads. The routes/api.php file contains routes for the rest API interface.

	```php
	use PluginNameSpace\App\Http\Controllers\UserController;

	Route::get( '/user', [UserController::class, 'index'] );
	```


3. Available Router Methods

	You can use the router to register routes that are capable of responding to any HTTP verb.

	```php
	Route::get( $uri, $callback );
	Route::post( $uri, $callback );
	```

## Dependency Injection

In your route's callback function, you can specify the types of dependencies that your route requires by using type hints. These dependencies will be automatically resolved and passed into the callback by the WpCommander service container. For instance, you can type a hint in the ```WP_REST_Request``` class to have the current HTTP request automatically passed into your route callback.

```php
use WP_REST_Request;

Route::get( '/users', function ( WP_REST_Request $wpRestRequest ) {
    // ...
} );
```

## Middleware

1. To create a new middleware, use the make:middleware Artisan command:

	```
	php artisan make:middleware EnsureIsUserAdmin
	```
2. This command will place a new EnsureIsUserAdmin class within your ```app/Http/Middleware``` directory.
	```php
	<?php

	namespace PluginNameSpace\App\Http\Middleware;

	use WpCommander\Contracts\Middleware;
	use WP_REST_Request;

	class EnsureIsUserAdmin implements Middleware
	{
		/**
		* Handle an incoming request.
		*
		* @param  \WP_REST_Request  $wp_rest_request
		* @return bool
		*/
		public function handle( WP_REST_Request $wp_rest_request )
		{
			return current_user_can( 'manage_options' );
		}
	}
	```

3. Register the middleware to Inside the middleware array inside the ```app/config.php``` file

	```php
	'middleware'      => [
		'admin' => EnsureIsUserAdmin::class
	]
	```
4. Now You can apply middleware to all routes within a group. The middleware will be executed in the order in which they are listed in the middleware array.

	```php
	Route::group(['middleware' => ['admin'], 'prefix' => 'user'], function() {
		Route::get('/', [UserController::class, 'get']);
		Route::post('/', [UserController::class, 'create']);
	});
	```

## Controller
1. To create a new controller, use the ```make:controller``` Artisan command

	```
	php artisan make:controller UserController
	```
2. Controller class example
	```php
	<?php

	namespace PluginNameSpace\App\Http\Controllers;

	class UserController extends Controller
	{
		public function show( $id )
		{
			return wp_send_json( get_user_by( "id", $id ), 200 );
		}
	}
	```
3. To create a route to this controller method, you can use the following approach
	```php
	use PluginNameSpace\App\Http\Controllers\UserController;

	Route::get( '/user/{id}', [UserController::class, 'show'] );
	```

## License

The WpCommander is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).