<?php

namespace Lib;

use Error;
use Exception;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionUnionType;

class Route
{
    public static $routes = [];


    public static function get($uri, $callback, $middleware = [])
    {
        $uri = trim($uri, '/');
        self::$routes['GET'][$uri] =  ['callback' => $callback, 'middleware' => $middleware];
    }

    public static function post($uri, $callback, $middleware = [])
    {
        $uri = trim($uri, '/');
        self::$routes['POST'][$uri] = ['callback' => $callback, 'middleware' => $middleware];
    }

    public static function dispatch()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $isApi = (strpos($uri, 'api/') === 0);
        ErrorHandler::$isApi = $isApi;

        ErrorHandler::handle(function () use ($uri) {
            $method = $_SERVER['REQUEST_METHOD'];

            // Verificar si hay rutas definidas para el método actual
            if (!isset(self::$routes[$method])) {
                self::sendNotFound();
                return;
            }

            foreach (self::$routes[$method] as $route => $routeData) {
                $callback = $routeData['callback'];
                $middleware = $routeData['middleware'];


                if ($route === $uri) {
                    return self::executeMiddleware($middleware, $callback);
                }

                // Extraer parámetros solo si la ruta contiene placeholders
                if (strpos($route, '{') !== false) {
                    $params = self::extractParams($uri, $route);

                    if (!empty($params)) {
                        return self::executeMiddleware($middleware, $callback, $params);
                    }
                }
            }

            // Si ninguna ruta coincide, enviar 404
            self::sendNotFound();
        });
    }

    private static function executeMiddleware($middleware, $callback, $params = [])
    {
        foreach ($middleware as $m) {
            $result = call_user_func($m);
            if ($result  === false) {
                return;
            }
        }

        return self::executeCallback($callback, $params);
    }

    private static function executeCallback($callback, $params = [])
    {
        // Si el callback es una función anónima o método estático
        if (is_callable($callback)) {
            return call_user_func_array($callback, $params);
        }

        // Si el callback es un array [Clase, método]
        if (is_array($callback) && method_exists($callback[0], $callback[1])) {
            // Inyección de dependencias al instanciar la clase
            $object = self::resolveDependencies($callback[0]);
            return call_user_func_array([$object, $callback[1]], $params);
        }

        // Si no es válido, enviar 404
        self::sendNotFound();
    }

    private static function resolveDependencies($class)
    {
        // Crear un objeto ReflectionClass para la clase especificada
        $reflection = new ReflectionClass($class);

        // Obtener el constructor de la clase
        $constructor = $reflection->getConstructor();
        if (!$constructor) {
            return new $class; // Si no hay constructor, instanciar la clase directamente
        }

        // Arreglo para almacenar las dependencias
        $dependencies = [];

        // Recorrer los parámetros del constructor
        foreach ($constructor->getParameters() as $parameter) {
            // Obtener el tipo del parámetro
            $type = $parameter->getType();

            // Verificar si el parámetro tiene un tipo y es una clase
            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                // Obtener el nombre de la clase
                $dependencyClass = $type->getName();
                // Resolver recursivamente las dependencias
                $dependencies[] = self::resolveDependencies($dependencyClass);
            } elseif ($type instanceof ReflectionUnionType) {
                // Si es un tipo de unión, manejarlo aquí si es necesario
                // Por simplicidad, podemos lanzar un error o ignorarlo
                throw new Exception("Tipos de unión no son soportados en este momento.");
            }
        }

        // Instanciar la clase con las dependencias
        return $reflection->newInstanceArgs($dependencies);
    }


    private static function sendNotFound()
    {
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
    }


    public static function extractParams($uri, $route)
    {
        $params = [];
        preg_match_all(
            "/{([a-zA-Z0-9_]+)}/",
            $route,
            $matches
        );
        $route = str_replace(
            $matches[0],
            '([a-zA-Z0-9_]+)',
            $route
        );
        $route = "#^" . $route . "$#";
        if (preg_match($route, $uri, $matches)) {
            $params = array_slice($matches, 1);
        }
        return $params;
    }
}
