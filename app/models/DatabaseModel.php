<?php

namespace App\Models;

use mysqli;
use Exception;
use InvalidArgumentException;

class DatabaseModel
{
    private $conn;
    private $roles;

    public function __construct($role)
    {
        $this->roles = json_decode($_ENV['DB_USERS'], true);

        if (!isset($this->roles[$role])) {
            throw new InvalidArgumentException("Invalid role specified.");
        }
        $this->conn = $this->getConnection($role);
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
        } catch (Exception $e) {
            // Manejar la excepción de forma centralizada
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
