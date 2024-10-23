<?php

namespace Lib;

class ErrorHandler
{
    public static $isApi;

    public static function handle(callable $callback, string $message = "An error occured")
    {
        try {
            return $callback();
        } catch (\mysqli_sql_exception $e) {
            return static::handleDatabaseError($e);
        } catch (\Exception $e) {
            return static::handleException($e, $message);
        }
    }

    private static function handleDatabaseError(\mysqli_sql_exception $e)
    {
        error_log("[{$e->getCode()}] " . $e->getMessage() . " - Error at line: " . $e->getLine());

        $errorMessages = [
            1044 => "You do not have permission to access this resource.",
            1062 => "Duplicate entry.",
            1452 => "Foreign key constraint fails.",
            1054 => "Unknown column.",
            1364 => "Field does not have a default value.",
            1064 => "SQL syntax error.",
            1146 => "Table does not exist.",
            1366 => "Incorrect value for field.",
            1451 => "Cannot delete or update a parent row.",
            1048 => "Required field missing."
        ];

        $message = $errorMessages[$e->getCode()] ?? 'A database error occurred.';

        return static::respondWithError($message, 400);
    }

    protected static function handleException(\Exception $e, string $message = "An error occurred")
    {
        $redColor = "\033[31m";
        $resetColor = "\033[0m";
        $error = $e->getMessage();
        $line = $e->getLine();
        $code = $e->getCode();
        $file = $e->getFile();
        $backtrace = $e->getTrace();

        error_log(
            $redColor . "[{$code}] " . $error
                . "\n" . "Stack Trace: "
                . "\n" . "Error in: " . $file . " at line " . $line
                . "\n" . $backtrace
                . $resetColor
        );


        return static::respondWithError(!empty($error) ? $error : $message, 500);
    }

    protected static function respondWithError(string $message, int $statusCode = 500)
    {
        if (static::$isApi) {
            http_response_code($statusCode);
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => $message,
                'statusCode' => $statusCode
            ]);
        } else {
            http_response_code($statusCode);
            include $_ENV["ROOT"] . "/views/errors/error.php";
        }
        exit;
    }
}
