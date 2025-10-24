<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController
{
    static function main()
    {
        Route::add(
            '/',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->index();
            },
            'get'
        );

        Route::add(
            '/inicio2',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->index2();
            },
            'get'
        );

        Route::add(
            '/demo-proveedores',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->demo();
            },
            'get'
        );

        /**
         * Ejercicios Iterativas
         */
        Route::add(
            '/iterativas3',
            function () {
                $controlador = new \Com\Daw2\Controllers\IterativasController();
                $controlador->iterativas3();
            },
            'get'
        );
        Route::add(
            '/iterativas3',
            function () {
                $controlador = new \Com\Daw2\Controllers\IterativasController();
                $controlador->doIterativas3();
            },
            'post'
        );

        /**
         * Errores
         */
        Route::pathNotFound(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error404();
            }
        );

        Route::methodNotAllowed(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error405();
            }
        );
        Route::run();
    }
}
