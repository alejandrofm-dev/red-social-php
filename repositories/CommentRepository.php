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
}