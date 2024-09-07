<?php

namespace App\Models;

use Exception;

class UserModel extends DatabaseModel
{
    public function all()
    {
        $query = "SELECT * FROM users";
        $preparation = $this->prepare($query);
        $preparation->execute();
        return $preparation->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function allActive()
    {
        $query = "SELECT * FROM users WHERE active = 1";
        $preparation = $this->prepare($query);
        $preparation->execute();
        return $preparation->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function allInactive()
    {
        $query = "SELECT * FROM users WHERE active = 0";
        $preparation = $this->prepare($query);
        $preparation->execute();
        return $preparation->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $preparation = $this->prepare($query);
        $preparation->bind_param("i", $id);
        $preparation->execute();
        return $preparation->get_result()->fetch_assoc();
    }

    public function create(array $data = [])
    {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $document_number = $data['document-number'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username,email, password_hash, document_number) VALUES (?,?,?,?)";
        $preparation = $this->prepare($query);
        $preparation->bind_param("ssss", $username, $email, $password_hash, $document_number);
        return $preparation->execute();
    }

    public function activate($id)
    {
        $query = "UPDATE users SET active = 1 WHERE id = ?";
        $preparation = $this->prepare($query);
        $preparation->bind_param("i", $id);
        return $preparation->execute();
    }

    public function desactivate($id)
    {
        $query = "UPDATE users SET active = 0 WHERE id = ?";
        $preparation = $this->prepare($query);
        $preparation->bind_param("i", $id);
        return $preparation->execute();
    }

    public function updateUsername($id, $username)
    {
        $query = "UPDATE users SET username = ? WHERE id = ?";
        $preparation = $this->prepare($query);
        $preparation->bind_param("si", $username, $id);
        return $preparation->execute();
    }

    public function updatePhoneNumber($id, $phone_number)
    {
        $query = "UPDATE users SET phone_number = ? WHERE id = ?";
        $preparation = $this->prepare($query);
        $preparation->bind_param("si", $phone_number, $id);
        return $preparation->execute();
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

    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function getRole($id)
    {
        $query = "SELECT role FROM users WHERE id = ?";
        $this->fetchOne($query, [$id], 'i');
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
        $preparation = $this->prepare($query);
        $preparation->bind_param("s", $email);
        $preparation->execute();
        return $preparation->get_result()->fetch_assoc();
    }
}
