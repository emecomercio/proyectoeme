<?php

namespace App\Models;

use mysqli;

class DatabaseModel
{
    public $connection;

    public function __construct()
    {
        $this->connection = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }
    public function query($query)
    {
        return $this->connection->query($query);
    }

    public function prepare($query)
    {
        return $this->connection->prepare($query);
    }

    public function close()
    {
        if ($this->connection !== null) {
            $this->connection->close();
            $this->connection = null;
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}
