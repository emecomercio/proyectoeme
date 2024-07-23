<?php
require_once(MODELS . "DatabaseModel.php");
class UserModel extends DatabaseModel
{

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $result = $this->connection->query($query); # Hago la quey$query a la bd
        // Transformo la quey$query a un array de arrays asociativos
        // Se puede recorrer con foreach o así: $result[1]["fullname"]
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function userExists($email, $password)
    {
        $usersTable = $this->getUsers();

        foreach ($usersTable as $row) {
            if (password_verify($password, $row['password_hash']) && $row['email'] == $email) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function getUserById($id)
    {
        $usersTable = $this->getUsers();
        foreach ($usersTable as $row) {
            if ($row['id'] == $id) {
                return $row;
            } #algun else
        }
    }
    public function addUser($user_type, $fullname, $password, $email, $birthdate) #completar con los valores de la usersTable
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (user_type, fullname, email, password_hash, birthdate) VALUES (?, ?, ?, ?, ?)"; #se crea la plantilla para la query
        $preparation = $this->connection->prepare($query); #se prepara la query
        $preparation->bind_param("sssss", $user_type, $fullname, $email, $password_hash, $birthdate); #se pasan los parametros a la query
        return $preparation->execute(); #se ejecuta la query
    }

    public function updateUser($id, $user_type, $fullname, $password, $email, $birthdate)
    {
        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET user_type = ?, fullname = ?, email = ?, password_hash = ?, birthdate = ? WHERE id = ?";
            $preparation = $this->connection->prepare($query);
            $preparation->bind_param("sssssi", $user_type, $fullname, $email, $password_hash, $birthdate, $id);
            return $preparation->execute();
        } else {
            $query = "UPDATE users SET user_type = ?, fullname = ?, email = ?, birthdate = ? WHERE id = ?";
            $preparation = $this->connection->prepare($query);
            $preparation->bind_param("ssssi", $user_type, $fullname, $email, $birthdate, $id);
            return $preparation->execute();
        }
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id = $id";
        return $this->connection->query($query);
    }
}
