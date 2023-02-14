## This Documentation is not up to date. We are working with new Documentation.



<p align="center">
<a href="https://packagist.org/packages/wpcommander/wpcommander"><img src="https://img.shields.io/packagist/dt/wpcommander/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/wpcommander/wpcommander"><img src="https://img.shields.io/packagist/v/wpcommander/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/wpcommander/wpcommander"><img src="https://img.shields.io/packagist/l/wpcommander/framework" alt="License"></a>
</p>

## About WpCommander

WpCommander is a wordpress plugin framework that makes web development easy and enjoyable. Its expressive syntax and range of features help developers create high-quality applications with ease.

1. [A straightforward and fast routing system](#routing)
2. [A robust dependency injection container](#dependency-injection)
3. [Middleware Declaration](#middleware)
4. [Controller Declaration](#controller)
5. [Service Provider Declaration](#service-provider)
6. [Views](#views)
7. [Developer-friendly enqueue declaration](#enqueue-declaration)
8. [Usable utils methods](#utils-methods)
9. [Production Build](#production-build)
10. Database Query Builder ( Up Coming )

## Installation

1. Create plugin with wpcommander

   ```
   composer create-project wpcommander/wpcommander plugin-name
   ```
2. Go to the plugin directory
   ```
   cd plugin-name
   ```
3. Setup plugin name and other information, After running this command `npm install` will automatically executed

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

2. All the WpCommander routes can be found in the routes directory, which your application's RouteServiceProvider automatically loads. The `routes/api.php` file contains routes for the rest API interface.

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

1. To create a new middleware, use the `make:middleware` Artisan command:

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


## Service Provider

1. To create a new service provider, use the ```make:provider``` Artisan command

	```
	php artisan make:provider AdminMenuServiceProvider
	```
2. Service provider class example
	```php
	<?php

	namespace PluginNameSpace\App\Http\Providers;

	use WpCommander\Contracts\ServiceProvider;

	class AdminMenuServiceProvider extends ServiceProvider
	{
		public function boot()
		{
			//
		}
	}
	```
3. Register the service to Inside the providers array inside the `app/config.php` file
	```php
	use PluginNameSpace\App\Http\Providers\AdminMenuServicePro;

	'providers'       => [
        AdminMenuServiceProvider::class
    ]

## Views
The `resources/views` directory contains views, which allow you to separate your application logic from your presentation logic.

1. View Render
	````php
	use PluginNameSpace\Bootstrap\View;
	
	$users = get_users([]);

	View::render('admin', compact('users'));
	````

2. View response for api
	```php
	use PluginNameSpace\Bootstrap\View;

	View::send('admin', [
		'users' => get_users([])
	]);
	```
	
## Enqueue declaration
In enqueues directory, you will get 2 files. one for admin enqueue and another one for frontend enqueue.

1. For example, now we are declaring an admin script.

	```php
	<?php

	use PluginNameSpace\Bootstrap\Application;
	use PluginNameSpace\Bootstrap\Utils;

	/**
	* @var Application $application
	*/

	wp_enqueue_script( 'myplugin', Utils::asset('js/script.js'), [], Utils::version() );
	```

## Utils methods

How to use utils methods

```php
use PluginNameSpace\Bootstrap\Utils;

$url = 'https://domain.com'
$url = Utils::url_add_params($url, ['key' => 'value', 'key1' => 'value1']);
```
| Available Methods | Example |
| ------------------------ | ---------------------------------------------------- |
| `asset()` | Get asset URL |
| `version()` | Get your plugin current version |
| `json_encode_for_attr()` | JSON encoding for HTML attribute. you can use it for passing data from PHP to js with data- attribute |
| `url_add_params()` | You can add params to the URL using this method. If you use this method `? And &` will not conflict. |
| `is_admin_page` | Using the method you can check the admin's current page inside any hook. no matter whether the wp is fully loaded or not. |
| `import_elementor_demo()` | You can import Elementor demo in wp post. The specialty of this method is that your demo will import the `SVG correctly`. |

## Tailwind Css Config

You need to add a class to the parent element of the element or component you want to style with tailwindcss. For using this approach, tailwind CSS will not conflict with WordPress er default style and you don't need to add the prefix for every tailwind class.

1. For configuration, the parent class goes to the `postcss.config.js` file.

```js
const parent_selector = '.parent-selector'
```

2. Example

```html

<div class="parent-selector">
	<button type="button" disabled="" class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-indigo-500 hover:bg-indigo-400 transition ease-in-out duration-150 cursor-pointer">
		Submit
	</button>
</div>
```

## Production Build

1. For correction your text-domain go `Gruntfile.js` file and check it.
	```js
	const projectConfig = {
		text_domain: 'plugin-text-domain'
	};
	```
2. To build a production zip, use the `npm run build` command.

	```
	npm run build
	```
3. After complete running the command you will get your production zip and files inside to `../dist/` directory

## License

The WpCommander is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
