<?php

namespace App\Models;

use mysqli;
use Exception;
use mysqli_sql_exception;
use InvalidArgumentException;

/**
 * This class serves as a base model for interacting with the database.
 *
 * @property string $table Name of the table in the database.
 * @property mysqli $conn Connection to the database.
 * @property string $pk Primary key of the table (default is 'id').
 * @property array $bindings Parameters to bind in the prepared SQL statements.
 * @property string $select SELECT query to specify the columns to retrieve.
 * @property array $where Conditions for the SELECT query.
 * @property array $orderBy Columns and direction for sorting the results.
 * @property array $groupBy Columns to group the results.
 * @property string $limit Limit for the number of results to return.
 * @property array $join JOIN clauses to combine rows from different tables.
 * @property string $created_at Timestamp of when the record was created.
 * @property string $updated_at Timestamp of when the record was last updated.
 */
class Model
{
    private $conn = null;
    protected $table;
    protected $pk = 'id';
    protected $bindings = [];
    protected $select = '*';
    protected $where = [];
    protected $orderBy = [];
    protected $groupBy = [];
    protected $limit = '';
    protected $join = [];
    protected $created_at;
    protected $updated_at;

    public function realProduct()
    {
        return $this->handle(function () {
            $product = new Product([
                'name' => 'Celular Pro',
                'description' => 'Este celular es el mejor de la historia de los celulares.',
                'catalog_id' => 3,
                'seller_id' => 105
            ]);
            $product = $product->save();

            $variants = [];
            $variants[] = new Variant([
                'product_id' => $product->id,
                'stock' => 10,
                'current_price' => 1200,
                'last_price' => 1600,
            ]);
            $variants[] = new Variant([
                'product_id' => $product->id,
                'stock' => 15,
                'current_price' => 1300,
                'last_price' => 1300,
            ]);
            $variants[] = new Variant([
                'product_id' => $product->id,
                'stock' => 8,
                'current_price' => 1500,
                'last_price' => 1800,
            ]);
            $variants[] = new Variant([
                'product_id' => $product->id,
                'stock' => 10,
                'current_price' => 1200,
                'last_price' => 1600,
            ]);
            $variants[] = new Variant([
                'product_id' => $product->id,
                'stock' => 15,
                'current_price' => 1300,
                'last_price' => 1300,
            ]);
            $variants[] = new Variant([
                'product_id' => $product->id,
                'stock' => 8,
                'current_price' => 1500,
                'last_price' => 1800,
            ]);
            $variants[] = new Variant([
                'product_id' => $product->id,
                'stock' => 8,
                'current_price' => 5500,
                'last_price' => 7000,
            ]);
            $variants[] = new Variant([
                'product_id' => $product->id,
                'stock' => 8,
                'current_price' => 500,
                'last_price' => 700,
            ]);

            foreach ($variants as $index => &$variant) {
                $variant = $variant->save();

                $image = new Image([
                    'variant_id' => $variant->id,
                    'src' => "/uploads/dev/celular/{$index}_v1.jpg",
                    'alt' => 'Alternative Text',
                ]);
                $image->save();
                $image = new Image([
                    'variant_id' => $variant->id,
                    'src' => "/uploads/dev/celular/{$index}_v2.jpg",
                    'alt' => 'Alternative Text',
                ]);
                $image->save();
            }


            $attributes = [];

            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[0]->id,
                'name' => 'color',
                'value' =>  'azul'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[0]->id,
                'name' => 'almacenamiento',
                'value' =>  '256GB'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[0]->id,
                'name' => 'memoria',
                'value' =>  '8GB'
            ]);

            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[1]->id,
                'name' => 'color',
                'value' =>  'azul'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[1]->id,
                'name' => 'almacenamiento',
                'value' =>  '512GB'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[1]->id,
                'name' => 'memoria',
                'value' =>  '12GB'
            ]);

            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[2]->id,
                'name' => 'color',
                'value' =>  'azul'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[2]->id,
                'name' => 'almacenamiento',
                'value' =>  '512GB'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[2]->id,
                'name' => 'memoria',
                'value' =>  '16GB'
            ]);
            //////////////////////

            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[3]->id,
                'name' => 'color',
                'value' =>  'verde'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[3]->id,
                'name' => 'almacenamiento',
                'value' =>  '256GB'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[3]->id,
                'name' => 'memoria',
                'value' =>  '8GB'
            ]);

            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[4]->id,
                'name' => 'color',
                'value' =>  'verde'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[4]->id,
                'name' => 'almacenamiento',
                'value' =>  '512GB'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[4]->id,
                'name' => 'memoria',
                'value' =>  '12GB'
            ]);

            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[5]->id,
                'name' => 'color',
                'value' =>  'verde'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[5]->id,
                'name' => 'almacenamiento',
                'value' =>  '512GB'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[5]->id,
                'name' => 'memoria',
                'value' =>  '16GB'
            ]);

            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[6]->id,
                'name' => 'color',
                'value' =>  'verde'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[6]->id,
                'name' => 'almacenamiento',
                'value' =>  '512GB'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[6]->id,
                'name' => 'memoria',
                'value' =>  '20GB'
            ]);

            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[7]->id,
                'name' => 'color',
                'value' =>  'azul'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[7]->id,
                'name' => 'almacenamiento',
                'value' =>  '256GB'
            ]);
            $attributes[] = new VariantAttribute([
                'variant_id' => $variants[7]->id,
                'name' => 'memoria',
                'value' =>  '6GB'
            ]);

            foreach ($attributes as &$attribute) {
                $attribute = $attribute->save();
            }
        });
    }


    // MAGIC METHODS
    /**
     * Model Constructor
     * 
     * Initializes the model with the provided data.
     *
     * @param array $data Data to initialize the model. Default is an empty array.
     * @return void
     */
    public function  __construct($data = [])
    {
        if ($data) {
            $this->fill($data);
        }
    }

    /**
     * Closes the MySQL database connection when the object is destroyed.
     *
     * This method is called automatically when an instance of the class is 
     * destroyed. It checks if there is an active database connection and, 
     * if so, it closes the connection to free up resources.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if there is an active database connection
        if ($this->conn) {
            // Close the database connection
            $this->conn->close();
        }
    }

    /**
     * Sets the value of a property dynamically.
     *
     * This magic method is invoked when writing to inaccessible properties.
     * It checks if the property exists in the class and assigns the value to it.
     *
     * @param string $name The name of the property to set.
     * @param mixed $value The value to assign to the property.
     *
     * @throws \InvalidArgumentException If the property does not exist.
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new InvalidArgumentException("Property '$name' does not exist in " . get_class($this));
        }
    }

    // CONNECTION METHOD
    /**
     * Establishes a connection to the MySQL database using the credentials 
     * defined in the environment variables based on the user's role.
     *
     * This method checks if a connection has already been established. If not, 
     * it retrieves the database connection details from environment variables, 
     * determines the appropriate user role, and attempts to connect to the database.
     *
     * @throws \InvalidArgumentException If the user role is not valid.
     * @throws mysqli_sql_exception If there is an error connecting to the database.
     * 
     * @return void
     */
    private function connect()
    {
        if (!$this->conn) {
            try {
                $host = $_ENV['DB_HOST'];
                $database = $_ENV['DB_NAME'];
                $user = $_ENV["DB_USER"];
                $password = $_ENV["DB_PASSWORD"];
                $this->conn = new mysqli($host, $user, $password, $database);
                if ($this->conn->connect_error) {
                    throw new mysqli_sql_exception("Error connecting to database");
                }
            } catch (mysqli_sql_exception $e) {
                error_log($e->getMessage());
                die('An error occurred while connecting to the database');
            }
        }
    }

    // QUERY METHODS
    /**
     * Executes a prepared SQL statement with optional bindings.
     *
     * This method connects to the database, prepares an SQL statement, and executes
     * it with the provided bindings. If no placeholders are specified and bindings
     * are provided, the method will automatically determine the placeholder types
     * based on the binding values.
     *
     * @param string $sql The SQL statement to be executed.
     * @param array $bindings An array of values to bind to the SQL statement.
     * @param string $placeholders A string defining the types of the bound parameters. If empty, it will be determined automatically.
     * @return \mysqli_result The result set obtained from the executed statement.
     * @throws mysqli_sql_exception If the preparation of the SQL statement fails.
     */
    public function query($sql, $bindings = [], $placeholders = '')
    {
        $this->connect();
        if (empty($placeholders) && !empty($bindings)) {
            $placeholders = $this->getBindingsTypes($bindings);
        }
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new mysqli_sql_exception("Failed to prepare SQL statement: " . $this->conn->error);
        }
        if ($placeholders && count($bindings)) {
            $stmt->bind_param($placeholders, ...$bindings);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Retrieves records from the database based on the current query parameters.
     *
     * This method constructs a SQL SELECT query using the specified
     * properties like select fields, joins, where conditions, group by,
     * order by, and limit. It executes the query and returns an array
     * of records as instances of the current class.
     * @param bool $fetchToObj  Whether to fetch records as objects or arrays.
     * @return array<static|array<string,mixed>> An array of instances or associative arrays of the current class, each representing a row from the result set.
     */
    public function get($fetchToObj = true)
    {
        $results = $this->handle(function () use ($fetchToObj) {
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
            if (!empty($this->bindings)) {
                $resultSet = $this->query($query, $this->bindings);
            } else {
                $resultSet = $this->query($query);
            }
            $results = [];


            if ($fetchToObj) {
                // It executes while there are results.
                while ($row = $resultSet->fetch_assoc()) {
                    $results[] = new static($row);
                }
            } else {
                $results = $resultSet->fetch_all(MYSQLI_ASSOC);
            }

            return $results;
        });

        // Resets the properties for future queries.
        $this->reset();

        return $results;
    }

    /**
     * Retrieves all records from the database and returns them as an array of instances of the model.
     *
     * @return array<static> An array of model instances representing all records.
     */
    public function all()
    {
        return $this->select('*')->get();
    }

    /**
     * Finds an instance of the model by its primary key.
     *
     * @param mixed $pk The value of the primary key to search for.
     * @return static|null Returns an instance of the model if found, or null if not.
     */
    public function find($pk)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->pk = ?";
        $result = $this->query($sql, [$pk])->fetch_assoc();

        if ($result) {
            $model = new static();
            $model->fill($result);

            return $model;
        }

        return null;
    }

    /**
     * Find a record by a specific field and value.
     *
     * @param string $field The field to search by.
     * @param mixed $value The value to search for.
     * @return static|null Returns an instance of the model if found, or null if not.
     */
    protected function findByField($field, $value)
    {
        $sql = "SELECT * FROM users WHERE {$field} = ?";
        $result = $this->query($sql,  [$value])->fetch_assoc();
        if ($result) {
            $model = new static();
            $model->fill($result);
            return $model;
        }
        return null;
    }

    /**
     * Sets the columns to select in the queries.
     *
     * This method allows specifying the columns to be selected
     * from the current table. An exception will be thrown if no
     * columns are provided.
     *
     * @param string ...$columns Names of the columns to be selected.
     * @return $this Returns the current instance to allow method chaining.
     * @throws \InvalidArgumentException If no columns are specified.
     */
    protected function select(...$columns)
    {
        if (empty($columns)) {
            throw new InvalidArgumentException("Columns must be specified for selection.");
        }

        $this->select = implode(', ', $columns);
        return $this;
    }

    /**
     * Adds a condition to the WHERE clause of the SQL query with parameter binding.
     *
     * This method allows specifying conditions using a column, an operator,
     * and a value, with support for common SQL operators and handling `NULL` values.
     * 
     * @param string $column The name of the database column to filter.
     * @param string $operator The SQL comparison operator (e.g., '=', '!=', '>', '<', 'LIKE', 'IN').
     * @param mixed $value The value to compare the column against. Use `NULL` for comparisons with IS NULL or IS NOT NULL.
     * 
     * @throws InvalidArgumentException If an invalid SQL operator or column is provided.
     * 
     * @return $this Returns the current instance to allow method chaining.
     */
    protected function where($column, $operator, $value)
    {
        $validOperators = ['=', '<', '>', '<=', '>=', '!=', '<>', 'LIKE', 'IN', 'IS', 'IS NOT'];

        if (!in_array($operator, $validOperators)) {
            throw new InvalidArgumentException("Invalid SQL operator: $operator");
        }

        if (!is_string($column) || empty($column)) {
            throw new InvalidArgumentException("Invalid column name.");
        }

        if ($value === null) {
            $operator = ($operator === '=' ? 'IS' : 'IS NOT');
            $this->where[] = "$column $operator NULL";
        } else {
            $this->where[] = "$column $operator ?";
            $this->bindings[] = $value;
        }

        return $this;
    }

    /**
     * Adds a condition to the WHERE clause with an 'OR' logical operator and parameter binding.
     *
     * This method allows specifying conditions using a column, an operator,
     * and a value, with support for common SQL operators and handling `NULL` values.
     * It appends the condition using 'OR' to combine it with previous conditions.
     * 
     * @param string $column The name of the database column to filter.
     * @param string $operator The SQL comparison operator (e.g., '=', '!=', '>', '<', 'LIKE', 'IN').
     * @param mixed $value The value to compare the column against. Use `NULL` for comparisons with IS NULL or IS NOT NULL.
     * 
     * @throws InvalidArgumentException If an invalid SQL operator or column is provided.
     * 
     * @return $this Returns the current instance to allow method chaining.
     */
    protected function orWhere($column, $operator, $value)
    {
        $validOperators = ['=', '<', '>', '<=', '>=', '!=', '<>', 'LIKE', 'IN', 'IS', 'IS NOT'];

        if (!in_array($operator, $validOperators)) {
            throw new InvalidArgumentException("Invalid SQL operator: $operator");
        }

        if (!is_string($column) || empty($column)) {
            throw new InvalidArgumentException("Invalid column name.");
        }

        if ($value === null) {
            $operator = ($operator === '=' ? 'IS' : 'IS NOT');
            $this->where[] = "OR $column $operator NULL";
        } else {
            $this->where[] = "OR $column $operator ?";
            $this->bindings[] = $value;
        }

        return $this;
    }

    /**
     * Adds a condition to the WHERE clause with an 'AND' logical operator and parameter binding.
     *
     * This method allows specifying conditions using a column, an operator,
     * and a value, with support for common SQL operators and handling `NULL` values.
     * It appends the condition using 'AND' to combine it with previous conditions.
     * 
     * @param string $column The name of the database column to filter.
     * @param string $operator The SQL comparison operator (e.g., '=', '!=', '>', '<', 'LIKE', 'IN').
     * @param mixed $value The value to compare the column against. Use `NULL` for comparisons with IS NULL or IS NOT NULL.
     * 
     * @throws InvalidArgumentException If an invalid SQL operator or column is provided.
     * 
     * @return $this Returns the current instance to allow method chaining.
     */
    protected function andWhere($column, $operator, $value)
    {
        $validOperators = ['=', '<', '>', '<=', '>=', '!=', '<>', 'LIKE', 'IN', 'IS', 'IS NOT'];

        if (!in_array($operator, $validOperators)) {
            throw new InvalidArgumentException("Invalid SQL operator: $operator");
        }

        if (!is_string($column) || empty($column)) {
            throw new InvalidArgumentException("Invalid column name.");
        }

        if ($value === null) {
            $operator = ($operator === '=' ? 'IS' : 'IS NOT');
            $this->where[] = "AND $column $operator NULL";
        } else {
            $this->where[] = "AND $column $operator ?";
            $this->bindings[] = $value;
        }

        return $this;
    }

    /**
     * Adds an INNER JOIN clause to the query.
     *
     * This method appends an INNER JOIN to combine rows from two tables based on a related column between them.
     * The INNER JOIN returns only the rows where there is a match between the specified columns in both tables.
     *
     * @param string $table The name of the table to join.
     * @param string $firstColumn The column from the current table.
     * @param string $secondColumn The column from the joined table to compare with.
     * 
     * @throws InvalidArgumentException If the table or column names are invalid.
     * 
     * @return $this Returns the current instance for method chaining.
     */
    protected function join($table, $firstColumn, $secondColumn)
    {
        $this->validateJoin($table, $firstColumn, $secondColumn);

        $this->join[] = "JOIN $table ON $firstColumn = $secondColumn";

        return $this;
    }

    /**
     * Adds a LEFT OUTER JOIN clause to the query.
     *
     * This method appends a LEFT JOIN to the query to include all rows from the left table (the current table),
     * and the matching rows from the right table (the joined table). If no match is found, NULL values are returned 
     * for the columns from the right table.
     *
     * @param string $table The name of the table to join.
     * @param string $firstColumn The column from the current table.
     * @param string $secondColumn The column from the joined table to compare with.
     * 
     * @throws InvalidArgumentException If the table or column names are invalid.
     * 
     * @return $this Returns the current instance for method chaining.
     */
    protected function leftJoin($table, $firstColumn, $secondColumn)
    {
        $this->validateJoin($table, $firstColumn, $secondColumn);

        $this->join[] = "LEFT JOIN $table ON $firstColumn = $secondColumn";

        return $this;
    }

    /**
     * Adds a RIGHT OUTER JOIN clause to the query.
     *
     * This method appends a RIGHT JOIN to the query to include all rows from the right table (the joined table),
     * and the matching rows from the left table (the current table). If no match is found, NULL values are returned 
     * for the columns from the left table.
     *
     * @param string $table The name of the table to join.
     * @param string $firstColumn The column from the current table.
     * @param string $secondColumn The column from the joined table to compare with.
     * 
     * @throws InvalidArgumentException If the table or column names are invalid.
     * 
     * @return $this Returns the current instance for method chaining.
     */
    protected function rightJoin($table, $firstColumn, $secondColumn)
    {
        $this->validateJoin($table, $firstColumn, $secondColumn);

        $this->join[] = "RIGHT JOIN $table ON $firstColumn = $secondColumn";

        return $this;
    }

    /**
     * Sets the LIMIT clause for the query.
     *
     * This method adds a LIMIT clause to the query, which restricts the number of results 
     * returned to the specified count. It also binds the provided limit value to prevent 
     * SQL injection.
     *
     * @param int $count The number of rows to limit the query results to.
     * 
     * @return $this Returns the current instance of the model to allow for method chaining.
     */
    protected function limit($count)
    {
        if (!is_int($count) || $count <= 0) {
            throw new InvalidArgumentException("Limit must be a positive integer.");
        }

        $this->limit = "LIMIT ?";
        $this->bindings[] = $count;
        return $this;
    }

    /**
     * Adds an ORDER BY clause to the query.
     *
     * This method allows specifying the column and the direction (ascending or descending) 
     * to order the results by. The default direction is ASC (ascending).
     *
     * @param string $column The column to order by.
     * @param string $direction The direction of ordering, either 'ASC' or 'DESC'. Defaults to 'ASC'.
     * 
     * @return $this Returns the current instance of the model to allow for method chaining.
     */
    protected function orderBy($column, $direction = 'ASC')
    {
        $validDirections = ['ASC', 'DESC'];

        if (!in_array(strtoupper($direction), $validDirections)) {
            throw new InvalidArgumentException("Invalid order direction. Use 'ASC' or 'DESC'.");
        }

        $this->orderBy[] = "$column $direction";
        return $this;
    }

    /**
     * Adds a GROUP BY clause to the query.
     *
     * This method allows grouping the results by one or more columns.
     *
     * @param string ...$columns The columns to group the results by.
     * 
     * @return $this Returns the current instance of the model to allow for method chaining.
     */
    protected function groupBy(...$columns)
    {
        if (empty($columns)) {
            throw new InvalidArgumentException("At least one column must be specified for GROUP BY.");
        }

        $this->groupBy[] = "GROUP BY " . implode(', ', $columns);
        return $this;
    }

    // DATA MANIPULATION METHODS
    /**
     * Fills the object properties with the provided data.
     *
     * This method takes an associative array and sets the object's properties
     * if they exist. It also simplifies the object at the end to remove
     * unnecessary or sensitive properties.
     *
     * @param array $data An associative array of property names and values.
     * @return void
     */
    public function fill($data = [])
    {
        return $this->handle(function () use ($data) {

            foreach ($this->filterData($data, true) as $key => $value) {
                // Verify if the property exists before setting it
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }

            $this->simplify(); // Simplify at the end
        });
    }

    /**
     * Creates a new record in the database with the provided data.
     *
     * This method filters the provided data to remove any excluded properties, 
     * constructs an SQL `INSERT` statement, and executes the query to create 
     * a new record in the database. After the record is created, it retrieves 
     * the newly created instance by its ID.
     *
     * @param array $data An associative array of column-value pairs to be inserted into the database.
     * @return static Returns the newly created instance of the model.
     * 
     * @throws mysqli_sql_exception If a database-related exception occurs.
     * @throws Exception For any other general exceptions.
     */
    public function create($data = [])
    {
        return $this->handle(function () use ($data) {
            $filteredData = $this->filterData($data);
            $columns = implode(',', array_keys($filteredData));
            $placeholders = rtrim(str_repeat('?,', count($filteredData)), ',');
            $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
            $this->query($sql, array_values($filteredData));

            $idManuallySet = isset($filteredData['id']);
            if ($idManuallySet) {
                return $this->find($filteredData['id']);
            }

            return $this->find($this->id());
        });
    }

    /**
     * Saves the current model instance to the database.
     *
     * This method checks if the current instance already has an `id`. 
     * If it exists, it assumes that the record needs to be updated.
     * Otherwise, it will create a new record in the database. 
     * The method also handles any potential errors during the save process.
     *
     * @return static  Returns the saved instance of the model.
     * 
     * @throws mysqli_sql_exception If a database-related exception occurs.
     * @throws \Exception For any other general exceptions.
     */
    public function save()
    {
        return $this->handle(function () {
            $this->simplify();

            $data = get_object_vars($this);

            if (isset($data['id'])) {
                return $this->update($data['id'], $data);
            }

            return $this->create($data);
        });
    }

    /**
     * Updates an existing record in the database with the provided data.
     *
     * This method filters the provided data to remove any excluded properties,
     * constructs an SQL `UPDATE` statement, and executes the query to update 
     * the specified record in the database. After the record is updated, it 
     * retrieves the updated instance by its ID.
     *
     * @param int $id The unique identifier of the record to be updated.
     * @param array $data An associative array of column-value pairs to be updated in the database.
     * @return static Returns the updated instance of the model.
     * 
     * @throws Exception If no valid fields are provided for updating.
     * @throws mysqli_sql_exception If a database-related exception occurs.
     * @throws Exception For any other general exceptions.
     */
    public function  update($id, $data = [])
    {
        return $this->handle(function () use ($id, $data) {
            $filteredData = $this->filterData($data);

            if (empty($filteredData)) {
                throw new Exception('No valid fields to update');
            }

            $sets = [];
            $values = [];

            foreach ($filteredData as $key => $value) {
                $sets[] = "$key = ?";
                $values[] = $value;
            }
            $values[] = $id;

            $sql = "UPDATE $this->table SET " . implode(',', $sets) . " WHERE id = ?";
            $this->query($sql,  $values);
            return $this->find($id);
        });
    }

    /**
     * Permanently deletes a record from the database.
     *
     * This method constructs and executes an SQL `DELETE` statement to 
     * permanently remove a record from the database based on the provided 
     * unique identifier (ID). Once a record is deleted using this method, 
     * it cannot be recovered.
     *
     * @param int $id The unique identifier of the record to be deleted.
     * @return bool Returns true on success, false on failure.
     * 
     * @throws mysqli_sql_exception If a database-related exception occurs.
     * @throws Exception For any other general exceptions.
     */
    protected function hardDelete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        return $this->query($sql, [$id]);
    }

    // RELATIONSHIP METHODS
    /**
     * Retrieves a single related model instance based on a one-to-one relationship.
     *
     * This method queries the related model for a record that matches the foreign key 
     * provided, associating it with the current instance.
     *
     * @template T
     * @param class-string<T> $relatedModel The name of the related model class.
     * @param string $fk The foreign key used to establish the relationship.
     * 
     * @return T|null The related model instance if found, or null if not found.
     * 
     * @throws InvalidArgumentException If the provided related model is not a valid class name.
     */
    public function hasOne($relatedModel, $fk)
    {
        $this->existsRelatedModel($relatedModel);

        /**
         * @var Model
         */
        $related = new $relatedModel();
        $related->where($fk, '=', $this->pk);
        $results = $related->get();

        return !empty($results) ? $results[0] : null;
    }
    /**
     * Retrieves multiple related model instances based on a one-to-many relationship.
     *
     * This method queries the related model for records that match the foreign key 
     * provided, associating them with the current instance.
     *
     * @template T
     * @param class-string<T> $relatedModel The name of the related model class.
     * @param string $fk The foreign key used to establish the relationship.
     * @param mixed ...$fields Optional fields to select from the related model.
     * 
     * @return array<T> An array of related model instances.
     * 
     * @throws InvalidArgumentException If the provided related model is not a valid class name.
     */
    public function hasMany($relatedModel, $fk, $fields = [], $fetchToObj = true)
    {
        $this->existsRelatedModel($relatedModel);

        /**
         * @var Model
         */
        $related = new $relatedModel();

        if (!empty($fields)) {
            $related->select(...$fields);
        }

        $related->where($fk, '=', $this->{$this->pk});

        return $related->get($fetchToObj);
    }

    /**
     * Retrieves the related model instance based on a belongs-to relationship.
     *
     * This method queries the related model to find a single record that matches
     * the foreign key provided in the current instance, establishing a relationship
     * from the current model to the related model.
     *
     * @template T
     * @param class-string<T> $relatedModel The name of the related model class.
     * @param string $fk The foreign key that references the related model's primary key.
     * 
     * @return T|null An instance of the related model, or null if not found.
     * 
     * @throws InvalidArgumentException If the provided related model is not a valid class name.
     */
    public function belongsTo($relatedModel, $fk)
    {
        $this->existsRelatedModel($relatedModel);

        /**
         * @var Model
         */
        $related = new $relatedModel();

        return $related->find($this->{$fk});
    }

    // UTILITY METHODS
    /**
     * Simplifies the model by unsetting specific properties.
     *
     * This method is used to clean up the object by removing properties
     * that are not needed at certain points in the application, reducing
     * memory usage and avoiding potential conflicts.
     *
     * The following properties will be unset:
     * - db_role
     * - select
     * - where
     * - orderBy
     * - groupBy
     * - limit
     * - join
     * - bindings
     */
    public function simplify()
    {
        unset(
            $this->db_role,
            $this->select,
            $this->where,
            $this->orderBy,
            $this->groupBy,
            $this->limit,
            $this->join,
            $this->bindings
        );
    }

    /**
     * Resets the query parameters to their default values.
     *
     * This method is used to clear the current state of the query builder
     * by resetting all parameters, such as select, where, orderBy, groupBy,
     * limit, and join. After calling this method, the query builder will
     * be in its initial state, ready for a new query to be constructed.
     *
     * @return void
     */
    private function reset()
    {
        $this->select = '*';
        $this->where = '';
        $this->orderBy = '';
        $this->groupBy = '';
        $this->limit = '';
        $this->join = '';
    }

    /**
     * Generates a string of binding types for prepared statements.
     *
     * This method takes an array of values and returns a string that specifies
     * the types of the parameters for use in a prepared statement. The types are
     * represented by the following characters:
     * - 'i' for integer
     * - 'd' for double
     * - 's' for string
     *
     * @param array $bindings An array of values to determine their types.
     * @return string A string of binding types corresponding to the input values.
     */
    private function getBindingsTypes($bindings = [])
    {
        return implode('', array_map(function ($value) {
            if (is_int($value)) return 'i';
            if (is_double($value)) return 'd';
            return 's';
        }, $bindings));
    }

    /**
     * Validates the input parameters for a JOIN clause.
     *
     * This method checks if the table name and column names provided for a JOIN operation
     * are valid non-empty strings. If any of the parameters is not a valid string or is empty,
     * an InvalidArgumentException is thrown.
     *
     * @param string $table The name of the table to join.
     * @param string $firstColumn The column from the current table to be used in the JOIN condition.
     * @param string $secondColumn The column from the joined table to compare with.
     * 
     * @throws InvalidArgumentException If the table name or any of the column names are invalid or empty.
     * 
     * @return void
     */
    private function validateJoin($table, $firstColumn, $secondColumn)
    {
        if (!is_string($table) || empty($table) || !is_string($firstColumn) || empty($firstColumn) || !is_string($secondColumn) || empty($secondColumn)) {
            throw new InvalidArgumentException("Invalid table or column names.");
        }
    }

    /**
     * Validates the existence of a related model class.
     *
     * This method checks if the specified model class exists. If the class does not exist,
     * it throws an InvalidArgumentException with a descriptive error message.
     *
     * @param string $model The name of the related model class to check.
     * 
     * @throws InvalidArgumentException If the provided model class does not exist.
     */
    private function existsRelatedModel($model)
    {
        if (!class_exists($model)) {
            throw new InvalidArgumentException("The related model class '$model' does not exist.");
        }
    }

    /**
     * Filters the given data array, excluding specified properties and 
     * optionally allowing null values.
     *
     * This method removes keys from the input data array based on a predefined
     * list of excluded properties.
     *
     * @param array $data The input data array to filter.
     * @param bool $admit If true, allows null values. Defaults to false.
     * @return array The filtered array with excluded properties and values.
     */
    private function filterData(array $data, bool $admit = false): array
    {
        $excludedProperties = ['conn', 'pk', 'table'];

        return array_filter($data, function ($key) use ($excludedProperties, $data, $admit) {
            return !in_array($key, $excludedProperties) && ($admit || ($data[$key] !== null && !empty($data[$key])));
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Retrieves the last inserted ID from the database.
     *
     * This method executes a SQL query to obtain the ID of the most recently 
     * inserted record. It uses the MySQL function `LAST_INSERT_ID()` to 
     * ensure that the correct ID is retrieved, especially when multiple 
     * insert operations are performed.
     *
     * @return int|null Returns the last inserted ID as an integer, or null 
     * if no ID was found or an error occurred.
     *
     * @throws mysqli_sql_exception If a database-related exception occurs.
     */
    protected function id()
    {
        $result = $this->query("SELECT LAST_INSERT_ID() AS last_id")->fetch_assoc();

        return $result ? (int) $result['last_id'] : null;
    }


    /**
     * Checks if a record exists in the database based on the specified field and value.
     *
     * This method executes a SELECT query to determine if any record in the 
     * specified table has a value in the given field that matches the provided 
     * value. It can either return a boolean indicating existence, or the ID of 
     * the matching record if found.
     *
     * @param string $field The name of the field to check for existence.
     * @param mixed $value The value to search for in the specified field.
     * @param bool $returnId Optional flag to return the ID of the found record. Defaults to false.
     * 
     * @return bool|int Returns true if a matching record exists (or the ID if $returnId is true), false if not.
     *
     * @throws mysqli_sql_exception If a database-related exception occurs.
     */
    public function exists($field, $value, $returnId = false)
    {
        // Query with conditional field selection based on $returnId
        $select = $returnId ? 'id' : '1';
        $sql = "SELECT $select FROM $this->table WHERE $field = ? LIMIT 1";

        $result = $this->query($sql, [$value]);
        $row = $result->fetch_assoc();

        // If a record is found, return the id or true, otherwise return false
        return $row ? ($returnId ? $row['id'] : true) : false;
    }


    /**
     * Executes a raw SQL query and returns the results.
     *
     * This method prepares and executes a SQL statement, allowing for bound parameters.
     * It can fetch results as objects or associative arrays based on the provided flag.
     *
     * @template T 
     * @param string $sql The SQL query to be executed.
     * @param array $bindings An array of values to bind to the SQL statement.
     * @param string $placeholders Optional. A string specifying the types of the bound parameters.
     * @param class-string<T> $fetchToObj The name of the desired returned object type.
     * @return array<T|array<string,mixed>> An array of results, either as instances of the indicated class or associative arrays.
     * @throws mysqli_sql_exception If preparing the SQL statement fails.
     */
    protected function rawQuery($sql, $bindings = [], $placeholders = '', $fetchToObj = '')
    {
        $this->connect();
        if (empty($placeholders) && !empty($bindings)) {
            $placeholders = $this->getBindingsTypes($bindings);
        }
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new mysqli_sql_exception("Failed to prepare SQL statement: " . $this->conn->error);
        }
        if ($placeholders && count($bindings)) {
            $stmt->bind_param($placeholders, ...$bindings);
        }
        $stmt->execute();
        $resultSet = $stmt->get_result();

        $results = [];

        if (empty($fetchToObj)) {
            $results = $resultSet->fetch_all(MYSQLI_ASSOC);
        } else {
            while ($row = $resultSet->fetch_assoc()) {
                $results[] = new static($row);
            }
        }
        $this->conn = null;
        return $results;
    }

    /**
     * Handles the execution of a function, providing error handling.
     *
     * This method is designed to safely execute a callable function, wrapping it in error handling 
     * mechanisms for both database-related and general exceptions. If a specific MySQLi error occurs 
     * (e.g., permission issues), it handles that differently. All exceptions are logged, and the 
     * application dies with a user-friendly message.
     *
     * @param callable $function The function to execute within the error handling.
     * @param string $message A custom error message for general exceptions. Defaults to "An error occurred."
     * 
     * @return mixed The result of the callable function if no exceptions are thrown.
     * 
     * @throws mysqli_sql_exception If a database-related exception occurs.
     * @throws \Exception For any other general exceptions.
     */
    protected function handle(callable $function, string $message = "An error occurred.")
    {
        try {
            return $function();
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage() . " - Error at line: " . $e->getLine());

            if (in_array($e->getCode(), [1044, 1142])) {
                die('You do not have permission to access this resource. You are a ' . getUser('role') . '.');
            } // Then it is neccesary to add more error codes here...

            die('A database error occurred. Please try again later or contact ' . $_ENV['EMAIL'] . ' for assistance.');
        } catch (Exception $e) {
            error_log($e->getMessage());

            die($message . 'Please try again later or contact ' . $_ENV['EMAIL'] . ' for assistance.');
        }
    }
}
