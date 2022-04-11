<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is maintenance / demo mode via the "down" command we
| will require this file so that any prerendered template can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

// de forma geral aqui é feita a conexão aplicativo ao cliente

$app = require_once __DIR__.'/../bootstrap/app.php';

// Cria a nova instância do aplicativo laravel que está no '/../bootstrap/app.php'

// O tapmétodo passa a coleção para o retorno de chamada fornecido, 
// permitindo que você "toque" na coleção em um ponto específico e faça 
// algo com os itens, sem afetar a coleção em si.

$kernel = $app->make(Kernel::class); // resolução dos problemas via classe e instancia as classes principais

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();
// dd($request,$response,'aqui');


$kernel->terminate($request, $response);
