<?php

class PostRepository
{
    public static function getPosts()
    {
        $db = DB::connect();
        $posts = [];
        $stmt = $db->prepare("SELECT * FROM posts");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post($row['id'], $row['user_id'], $row['caption'], $row['image_url'], $row['created_at']);
        }
        return $posts;
    }

    public static function addPost($userId, $caption, $imageUrl = "default.png")
    {
        $db = DB::connect();
        $stmt = $db->prepare("INSERT INTO posts (user_id, caption, image_url) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $caption, $imageUrl);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public static function deletePost(int $id): void
    {
        $db = DB::connect();
        $stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public static function updateImage($id, $image)
    {
        $db = DB::connect();
        $stmt = $db->prepare("UPDATE posts SET image_url=? WHERE id=?");
        $stmt->bind_param("si", $image, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}