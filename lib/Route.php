<?php
require_once ROOT . "/lib/view.php";
class Route
{
    protected static $routes = [];

    public static function addRoute($method, $uri, $action)
    {
        static::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
        ];
    }
    public static function get(...$args)
    {
        static::addRoute("GET", ...$args);
    }

    public static function post(...$args)
    {
        static::addRoute("POST", ...$args);
    }

    public static function view($uri, $view, $data = [])
    {
        static::get($uri, function () use ($view, $data) {
            return view($view, $data);
        });
    }

    protected static function executeAction($action, $params = [])
    {
        if (is_callable($action)) {
            return call_user_func_array($action, $params); // Ejecuta la acción con los parámetros
        } else {
            return '500 - Error: La acción no es callable';
        }
    }

    protected static function extractParams($routeUri, $requestedUri)
    {
        $params = [];

        // Divide las partes de la URI
        $routeParts = explode('/', $routeUri);
        $requestedParts = explode('/', $requestedUri);

        // Itera sobre las partes para identificar y extraer parámetros
        foreach ($routeParts as $key => $part) {
            if (strpos($part, '{') === 0 && strpos($part, '}') === strlen($part) - 1) {
                // Es un parámetro dinámico ({id})
                $params[] = $requestedParts[$key]; // Agrega el valor del parámetro dinámico
            }
        }

        return $params;
    }

    // LO HIZO CHATGPT Y FUNCIONA, PENDIENTE ANALIZAR FUNCIONAMIENTO
    public static function dispatch($uri, $requestMethod)
    {
        // Itera sobre las rutas registradas
        foreach (static::$routes as $route) {
            // Divide las partes de la URI registrada y la solicitada
            $routeParts = explode('/', $route['uri']);
            $requestedParts = explode('/', $uri);

            // Verifica que tengan la misma cantidad de partes
            if (count($routeParts) !== count($requestedParts)) {
                continue; // Si no coinciden en cantidad, pasa a la siguiente ruta
            }

            $params = [];

            // Itera sobre las partes para compararlas
            $match = true;
            foreach ($routeParts as $key => $part) {
                if ($part === $requestedParts[$key]) {
                    continue;
                }

                // Si no coinciden y no es un parámetro dinámico, no hay coincidencia
                if (strpos($part, '{') === false || strpos($part, '}') === false) {
                    $match = false;
                    break;
                }

                // Es un parámetro dinámico, extrae su valor
                $params[] = $requestedParts[$key];
            }

            // Si se encontró una coincidencia, ejecuta la acción con los parámetros
            if ($match && $route['method'] === $requestMethod) {
                return static::executeAction($route['action'], $params);
            }
        }

        return '404 - Ruta no encontrada';
    }
}
