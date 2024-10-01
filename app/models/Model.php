<?php

namespace App\Models;

use mysqli;
use Exception;
use mysqli_sql_exception;
use InvalidArgumentException;

/**
 * @property string $table
 * 
 */



class Model
{
    private $host;
    private $database;
    private $username;
    private $password;
    private $conn;
    protected $role;

    protected $table;
    protected $primaryKey = 'id';
    protected $params = [];


    protected $select = '*';
    protected $where = [];
    protected $orderBy = [];
    protected $groupBy = [];
    protected $limit = '';
    protected $join = [];


    public function  __construct($role = '')
    {
        $this->host = $_ENV['DB_HOST'];
        $this->database = $_ENV['DB_NAME'];
        $roles = json_decode($_ENV['DB_USERS'], true);
        $this->role = empty($role) ? getUserRole() : $role;
        if (!isset($roles[$this->role])) {
            throw new InvalidArgumentException("Invalid role specified.");
        }
        $this->username = $roles[$this->role]['user'];
        $this->password = $roles[$this->role]['password'];
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                throw new mysqli_sql_exception("Error connecting to database");
            }
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            die('An error occurred while connecting to the database');
        }
    }

    public function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    protected function reset()
    {
        $this->select = '*';
        $this->where = '';
        $this->orderBy = '';
        $this->groupBy = '';
        $this->limit = '';
        $this->join = '';
    }

    private function getParamTypes($data = [])
    {
        return implode('', array_map(function ($value) {
            if (is_int($value)) return 'i';
            if (is_double($value)) return 'd';
            return 's';
        }, $data));
    }

    public function query($sql, $data = [], $params = '')
    {
        if (empty($params) && !empty($data)) {
            $params = $this->getParamTypes($data);
        }
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new mysqli_sql_exception("Failed to prepare SQL statement: " . $this->conn->error);
        }
        if ($params && count($data)) {
            $stmt->bind_param($params, ...$data);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }


    public function get()
    {
        $results = $this->handle(function () {
            $query = "SELECT {$this->select} FROM {$this->table}";

            if (!empty($this->join)) {
                $query .= ' ' . implode(' ', $this->join);
            }
            if (!empty($this->where)) {
                $query .= ' WHERE ' . implode(' ', $this->where);
            }
            if (!empty($this->groupBy)) {
                $query .= ' ' . implode(' ', $this->groupBy);
            }
            if (!empty($this->orderBy)) {
                $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
            }
            if (!empty($this->limit)) {
                $query .= ' ' . $this->limit;
            }

            $resultSet = $this->query($query, $this->params);
            $results = [];

            // Se ejecuta mientras haya resultados.
            while ($row = $resultSet->fetch_object()) {
                $results[] = $row;
            }
            return $results;
        });

        // Restablece las propiedades para futuras consultas.
        $this->reset();

        return $results;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = ?";
        $result = $this->query($sql, [$id], 'i')->fetch_assoc();

        // Verifica si se encontró el resultado
        if ($result) {
            $model = new static(); // Crea una nueva instancia del modelo actual
            foreach ($result as $key => $value) {
                $model->{$key} = $value; // Asigna cada valor a la instancia
            }
            return $model; // Devuelve la instancia del modelo
        }

        return null;
    }


    public function all()
    {
        return $this->select('*')->get();
    }

    public function select(...$columns)
    {
        $this->select =  implode(', ', $columns);
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->where[] = "$column $operator ?"; // Usar un placeholder
        $this->params[] = $value; // Guardar el valor correspondiente
        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        $this->where[] = "OR $column $operator ?";
        $this->params[] = $value;
        return $this;
    }

    public function andWhere($column, $operator, $value)
    {
        $this->where[] = "AND $column $operator ?";
        $this->params[] = $value;
        return $this;
    }

    public function join($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "JOIN $table ON $firstColumn = $secondColumn";
        return $this;
    }

    public function leftJoin($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "LEFT JOIN $table ON $firstColumn = $secondColumn";
        return $this;
    }

    public function rightJoin($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "RIGHT JOIN $table ON $firstColumn = $secondColumn";
        return $this;
    }

    public function fullJoin($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "FULL JOIN $table ON $firstColumn = $secondColumn";
        return $this;
    }

    public function limit($count)
    {
        $this->limit = "LIMIT ?";
        $this->params[] = $count; // Guardar el valor del límite
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    public function groupBy(...$columns)
    {
        $this->groupBy[] = "GROUP BY " . implode(', ', $columns);
        return $this;
    }


    protected function handle(callable $function, string $message = "An error occured")
    {
        try {
            return $function();
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            if (in_array($e->getCode(), [1044, 1142])) {
                die('You do not have permission to access this resource. You are a ' . getUserRole());
            }
            die('A database error occurred. Please try again later or contact ' . $_ENV['EMAIL'] . ' for assistance.');
        } catch (Exception $e) {
            error_log($e->getMessage());
            die($message);
        }
    }


    public function create($data = [])
    {
        return $this->handle(function () use ($data) {
            $columns = implode(',', array_keys($data));
            $values = "'" . implode("','", array_values($data)) .  "'";
            $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
            $this->query($sql);
            return $this->find($this->id());
        });
    }


    public function  update($id, $data = [])
    {
        return $this->handle(function () use ($id, $data) {
            $sets = [];
            foreach ($data as $key => $value) {
                $sets[] = " $key = '$value'";
            }
            $sql = "UPDATE $this->table SET " . implode(',', $sets) . " WHERE id = ?";
            $this->query($sql,  [$id], 'i');
            return $this->find($id);
        });
    }

    public function id()
    {
        return $this->query("SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];
    }

    public function rawQuery($sql, $params = [], $types = 's')
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $resultSet = $stmt->get_result();

        $results = [];

        while ($row = $resultSet->fetch_object()) {
            $results[] = $row;
        }
        return $results;
    }

    // Por probar
    public function hasOne($relatedModel, $foreignKey)
    {
        $related = new $relatedModel();
        $related->where($foreignKey, '=', $this->primaryKey);
        return $related->get();
    }

    public function hasMany($relatedModel, $foreignKey)
    {
        $related = new $relatedModel();
        $related->where($foreignKey, '=', $this->{$this->primaryKey});
        return $related->get();
    }
    // Por probar
    public function belongsTo($relatedModel, $foreignKey)
    {
        $related = new $relatedModel();
        return $related->find($this->{$foreignKey});
    }
}
