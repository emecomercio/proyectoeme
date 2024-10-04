<?php

namespace App\Models;

use mysqli;
use Exception;
use mysqli_sql_exception;
use InvalidArgumentException;
use stdClass;

/**
 * @property string $table
 * @property mysqli $conn
 * @property string $db_role
 * @property string $pk
 * @property array $parrams
 * @property boolean $isInstance
 * @property string $select
 * @property array $where
 * @property array $orderBy
 * @property array $groupBy
 * @property string $limit
 * @property array $join
 */



class Model
{
    private $conn;
    protected $db_role;

    protected $table;
    protected $pk = 'id';
    protected $params = [];
    protected $isInstance = false;


    protected $select = '*';
    protected $where = [];
    protected $orderBy = [];
    protected $groupBy = [];
    protected $limit = '';
    protected $join = [];

/**
 * @param array $data
 * @param string $role
 */
    public function  __construct($data = [], $role = '')
    {
        $host = $_ENV['DB_HOST'];
        $database = $_ENV['DB_NAME'];
        $roles = json_decode($_ENV['DB_USERS'], true);
        $this->db_role = empty($role) ? getUserRole() : $role;
        if (!isset($roles[$this->db_role])) {
            throw new InvalidArgumentException("Invalid role specified.");
        }
        $username = $roles[$this->db_role]['user'];
        $password = $roles[$this->db_role]['password'];
        if ($data) {
            $this->fill($data);
            $this->simplify($this);
        } else {
            try {
                $this->conn = new mysqli($host, $username, $password, $database);
                if ($this->conn->connect_error) {
                    throw new mysqli_sql_exception("Error connecting to database");
                }
            } catch (mysqli_sql_exception $e) {
                error_log($e->getMessage());
                die('An error occurred while connecting to the database');
            }
        }
    }

    public function __destruct()
    {
        if (! $this->isInstance) {
            if ($this->conn) {
                $this->conn->close();
            }
        }
    }

    public function simplify()
    {
        $this->isInstance = true;
        unset($this->conn);
        unset($this->db_role);
        unset($this->select);
        unset($this->where);
        unset($this->orderBy);
        unset($this->groupBy);
        unset($this->limit);
        unset($this->join);
        unset($this->params);
    }
/**
 * @param array $data
 */
    public function fill($data = [])
    {
        return $this->handle(function () use ($data) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            };
        });
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
   /**
    *@param array $data
    *@return string 
    */ 

    private function getParamTypes($data = [])
    {
        return implode('', array_map(function ($value) {
            if (is_int($value)) return 'i';
            if (is_double($value)) return 'd';
            return 's';
        }, $data));
    }
/**
 * @param string $sql
 * @param array $data
 * @param string $params
 * @return mysqli_result|false
 */
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


    /**
     * @return static[]
     */
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
            while ($row = $resultSet->fetch_object(static::class)) {
                $results[] = $row;
            }
            array_map(function ($result) {
                return $result->simplify();
            }, $results);

            return $results;
        });

        // Restablece las propiedades para futuras consultas.
        $this->reset();

        return $results;
    }
/**
 * @param int $id
 * @return static|null

 */
    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->pk = ?";
        $result = $this->query($sql, [$id], 'i')->fetch_assoc();

        // Verifica si se encontró el resultado
        if ($result) {
            $data = [];
            foreach ($result as $key => $value) {
                $data[$key] = $value; // Asigna cada valor a la instancia
            }

            $model = new static($data); // Crea una nueva instancia del modelo actual

            return $model; // Devuelve la instancia del modelo
        }

        return null;
    }

/**
 * @return static[]
 */
    public function all()
    {
        return $this->select('*')->get();
    }
/**
 * @param string ...$columns
 */
    public function select(...$columns)
    {
        $this->select =  implode(', ', $columns);
        return $this;
    }
/**
 * @param
 */
    public function where($column, $operator, $value)
    {
        $this->where[] = "$column $operator ?"; // Usar un placeholder
        $this->params[] = $value; // Guardar el valor correspondiente
        return $this;
    }
/**
 * @param
 */
    public function orWhere($column, $operator, $value)
    {
        $this->where[] = "OR $column $operator ?";
        $this->params[] = $value;
        return $this;
    }
/**
 * @param
 */
    public function andWhere($column, $operator, $value)
    {
        $this->where[] = "AND $column $operator ?";
        $this->params[] = $value;
        return $this;
    }
/**
 * @param
 */
    public function join($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "JOIN $table ON $firstColumn = $secondColumn";
        return $this;
    }
/**
 * @param
 */
    public function leftJoin($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "LEFT JOIN $table ON $firstColumn = $secondColumn";
        return $this;
    }
/**
 * @param
 */
    public function rightJoin($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "RIGHT JOIN $table ON $firstColumn = $secondColumn";
        return $this;
    }
/**
 * @param
 */
    public function fullJoin($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "FULL JOIN $table ON $firstColumn = $secondColumn";
        return $this;
    }
/**
 * @param
 */
    public function limit($count)
    {
        $this->limit = "LIMIT ?";
        $this->params[] = $count; // Guardar el valor del límite
        return $this;
    }
/**
 * @param
 */
    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy[] = "$column $direction";
        return $this;
    }
/**
 * @param
 */
    public function groupBy(...$columns)
    {
        $this->groupBy[] = "GROUP BY " . implode(', ', $columns);
        return $this;
    }

/**
 * @param
 */
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

/**
 * @param
 */
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

/**
 * @param
 */
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
/**
 * @param
 */
    public function id()
    {
        return $this->query("SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];
    }

    public function exists($field, $value)
    {
        $result =  $this->select($field)->where($field, '=',  $value)->limit(1)->get();
        return !empty($result);
    }


/**
 * @param
 */
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

    /**
     * 
     *
     * @param Model $relatedModel
     * @param string $fk
     * @return 
     */
    public function hasOne($relatedModel, $fk)
    {
        $related = new $relatedModel();
        $related->where($fk, '=', $this->pk);
        return $related->get();
    }

    /**
     * @template T of object
     * Obtiene una colección de instancias del modelo relacionado.
     *
     * @param class-string<T> $relatedModel El nombre de la clase del modelo relacionado.
     * @param string $fk El nombre de la clave foránea en el modelo relacionado.
     *
     * @return T[] Una colección de instancias del modelo relacionado (por ejemplo, Phone[]).
     */
    public function hasMany($relatedModel, $fk, ...$fields)
    {
        $related = new $relatedModel();
        if (!empty($fields)) {
            $related->select(...$fields);
        }
        $related->where($fk, '=', $this->{$this->pk});
        return $related->get();
    }

    /**
     * 
     *
     * @param Model $relatedModel
     * @param string $fk
     * @return Model
     */
    public function belongsTo($relatedModel, $fk)
    {
        $related = new $relatedModel();
        return $related->find($this->{$fk});
    }
}
