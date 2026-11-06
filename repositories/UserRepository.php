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

    public static function getAllUsers(): array
    {
        $db = DB::connect();
        $result = $db->query("SELECT * FROM users ORDER BY id");
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = new User($row['id'], $row['username'], $row['email'], $row['rol']);
        }
        return $users;
    }

    public static function deleteUser(int $id): void
    {
        $db = DB::connect();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}