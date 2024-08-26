<?php

namespace App\Models;

class UserModel extends DatabaseModel
{

    public function all()
    {
        try {
            $query = "SELECT * FROM users";
            $preparation = $this->prepare($query);
            $preparation->execute();
            return $preparation->get_result()->fetch_all(MYSQLI_ASSOC);
        } finally {
            $this->close();
        }
    }

    public function allActive()
    {
        try {
            $query = "SELECT * FROM users WHERE active = 1";
            $preparation = $this->prepare($query);
            $preparation->execute();
            return $preparation->get_result()->fetch_all(MYSQLI_ASSOC);
        } finally {
            $this->close();
        }
    }

    public function allInactive()
    {
        try {
            $query = "SELECT * FROM users WHERE active = 0";
            $preparation = $this->prepare($query);
            $preparation->execute();
            return $preparation->get_result()->fetch_all(MYSQLI_ASSOC);
        } finally {
            $this->close();
        }
    }

    public function find($id)
    {
        try {
            $query = "SELECT * FROM users WHERE id = ?";
            $preparation = $this->prepare($query);
            $preparation->bind_param("i", $id);
            $preparation->execute();
            return $preparation->get_result()->fetch_assoc();
        } finally {
            $this->close();
        }
    }

    public function create($username, $email, $password)
    {
        try {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username,email, password_hash) VALUES (?,?,?)";
            $preparation = $this->prepare($query);
            $preparation->bind_param("sss", $username, $email, $password_hash);
            return $preparation->execute();
        } finally {
            $this->close();
        }
    }

    public function activate($id)
    {
        try {
            $query = "UPDATE users SET active = 1 WHERE id = ?";
            $preparation = $this->prepare($query);
            $preparation->bind_param("i", $id);
            return $preparation->execute();
        } finally {
            $this->close();
        }
    }

    public function desactivate($id)
    {
        try {
            $query = "UPDATE users SET active = 0 WHERE id = ?";
            $preparation = $this->prepare($query);
            $preparation->bind_param("i", $id);
            return $preparation->execute();
        } finally {
            $this->close();
        }
    }

    public function updateUsername($id, $username)
    {
        try {
            $query = "UPDATE users SET username = ? WHERE id = ?";
            $preparation = $this->prepare($query);
            $preparation->bind_param("si", $username, $id);
            return $preparation->execute();
        } finally {
            $this->close();
        }
    }

    public function updatePhoneNumber($id, $phone_number)
    {
        try {
            $query = "UPDATE users SET phone_number = ? WHERE id = ?";
            $preparation = $this->prepare($query);
            $preparation->bind_param("si", $phone_number, $id);
            return $preparation->execute();
        } finally {
            $this->close();
        }
    }

    public function existsEmail($email)
    {
        $query = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $this->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_row()[0];
        return $count > 0;
    }

    public function existsUsername($username)
    {
        $query = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $this->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_row()[0];
        return $count > 0;
    }


    public function validatePassword($email, $password)
    {
        $user = $this->getUserByEmail($email);
        return password_verify($password, $user['password_hash']);
    }


    public function register($username, $email, $password)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username,email, password_hash) VALUES (?,?,?)";
        $preparation = $this->prepare($query);
        $preparation->bind_param("sss", $username, $email, $password_hash);
        return $preparation->execute();
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $preparation = $this->connection->prepare($query);
        $preparation->bind_param("s", $email);
        $preparation->execute();
        return $preparation->get_result()->fetch_assoc();
    }

    // Lo de abajo no se usa aun
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
