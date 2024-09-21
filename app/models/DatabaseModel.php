<?php

namespace App\Models;

use mysqli;
use Exception;
use InvalidArgumentException;
use mysqli_sql_exception;

class DatabaseModel
{
    private $conn;
    private $roles;

    public function __construct($role = null)
    {
        $this->roles = json_decode($_ENV['DB_USERS'], true);
        if (!isset($this->roles[$role ?? getUserRole()])) {
            throw new InvalidArgumentException("Invalid role specified.");
        }
        $this->conn = $this->getConnection($role ?? getUserRole());
    }

    public function getConnection($role)
    {

        $host = 'localhost';
        $database = 'ecommerce';
        $username = $this->roles[$role]['user'] ?? 'guest';
        $password = $this->roles[$role]['password'] ?? 'guest';

        $mysqli = new mysqli($host, $username, $password, $database);

        if ($mysqli->connect_error) {
            throw new Exception("Database connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }

    public function prepare($sql)
    {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        return $stmt;
    }

    public function executeQuery($query, $params = [], $types = '')
    {
        try {
            $stmt = $this->prepare($query);

            // Si hay parámetros, los vinculamos
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            return $stmt;
        } catch (mysqli_sql_exception $e) {
            // Manejar la excepción específica de MySQLi
            error_log("MySQLi Query failed: " . $e->getMessage());
            throw $e;  // Lanzar la excepción para que pueda ser capturada más arriba
        } catch (Exception $e) {
            // Manejar otras excepciones generales
            error_log("Query failed: " . $e->getMessage());
            throw new Exception("Query failed.");
        }
    }


    public function fetchAll($query, $params = [], $types = '')
    {
        $stmt = $this->executeQuery($query, $params, $types);
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchOne($query, $params = [], $types = '')
    {
        $stmt = $this->executeQuery($query, $params, $types);
        return $stmt->get_result()->fetch_assoc();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
