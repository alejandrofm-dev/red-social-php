<?php
class UserRepository
{
    public static function getUserById(int $id)
    {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return new User($row['id'], $row['username'], $row['email'], $row['rol']);
    }
}