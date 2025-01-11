<?php

namespace Libs\Database;

use Helpers\HTTP;
use PDOException;

class UsersTable
{

    private $db = null;
    public function __construct($db)
    {
        $this->db = $db->connect();
    }
    public function insert($data)
    {
        try {
            $query = "INSERT INTO users ( name , email , phone , address , password , role_id , created_at ) VALUES (
            :name , :email , :phone , :address , :password ,:role_id , NOW())";

            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getAll()

    {
        try {
            $statement = $this->db->query("SELECT users.* , roles.name AS role ,  roles.value FROM users LEFT JOIN  roles ON users.role_id= roles.id");
            return $statement->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function findByEmailAndPassword($email, $password)
    {
        $statement = $this->db->prepare("SELECT users.* , roles.name as role , roles.value FROM  users LEFT JOIN roles ON users.role_id = roles.id WHERE users.email = :email ");
        $statement->execute([
            "email" => $email,

        ]);
        $row = $statement->fetch();
        if ($row) {
            if (password_verify($password, $row->password)) {
                return $row ?? false;
            } else {
                HTTP::redirect("/_actions/login.php", "password=incorrect");
            }
        }
    }
    public function updatePhoto($id, $photo)
    {
        $statement = $this->db->prepare("UPDATE  users SET photo=:photo WHERE id = :id ");
        $statement->execute([
            "id" => $id,
            "photo" => $photo,
        ]);
        return $statement->rowCount();
    }
    public function suspend($id)
    {

        try {
            $statement = $this->db->prepare("UPDATE users SET  suspensed = 1 WHERE id = :id ");
            $statement->execute([
                "id" => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function unsuspend($id)
    {

        try {
            $statement = $this->db->prepare("UPDATE users SET  suspensed = 0 WHERE id = :id ");
            $statement->execute([
                "id" => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function delete($id)
    {

        try {
            $statement = $this->db->prepare(" DELETE FROM users WHERE id = :id ");
            $statement->execute([
                "id" => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function changeRole($id, $role)
    {

        try {
            $statement = $this->db->prepare("UPDATE users SET role_id = :role WHERE id = :id ");
            $statement->execute([
                "id" => $id,
                "role" => $role
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}