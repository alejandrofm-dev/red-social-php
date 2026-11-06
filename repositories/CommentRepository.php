<?php
class CommentRepository
{
    public static function getCommentsByPostId(int $postId): array
    {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT * FROM comments WHERE post_id = ?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = new Comment($row['id'], $row['user_id'], $row['comment'], $row['created_at']);
        }
        return $comments;
    }

    public static function addComment(int $postId, int $userId, string $comment): void
    {
        $db = DB::connect();
        $stmt = $db->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $postId, $userId, $comment);
        $stmt->execute();
    }
}