<?php
class LikeRepository
{
    public static function getLikesByPostId(int $postId): Like
    {
        $db = DB::connect();
        $userId = isset($_SESSION['user']) ? $_SESSION['user']->getId() : 0;
        $stmt = $db->prepare("SELECT COUNT(*) AS total_likes,
            COALESCE(SUM(user_id = ?), 0) AS user_has_liked
            FROM likes WHERE post_id = ?");
        $stmt->bind_param("ii", $userId, $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return new Like((int) $row['total_likes'], (bool) $row['user_has_liked']);
    }

    public static function getLikesByCommentId(int $commentId): Like
    {
        $db = DB::connect();
        $userId = isset($_SESSION['user']) ? $_SESSION['user']->getId() : 0;
        $stmt = $db->prepare("SELECT COUNT(*) AS total_likes,
            COALESCE(SUM(user_id = ?), 0) AS user_has_liked
            FROM comment_likes WHERE comment_id = ?");
        $stmt->bind_param("ii", $userId, $commentId);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return new Like((int) $row['total_likes'], (bool) $row['user_has_liked']);
    }

    public static function toggleCommentLike(int $commentId, int $userId): void
    {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT 1 FROM comment_likes WHERE comment_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $commentId, $userId);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $stmt = $db->prepare("DELETE FROM comment_likes WHERE comment_id = ? AND user_id = ?");
        } else {
            $stmt = $db->prepare("INSERT INTO comment_likes (comment_id, user_id) VALUES (?, ?)");
        }
        $stmt->bind_param("ii", $commentId, $userId);
        $stmt->execute();
    }

    public static function toggleLike(int $postId, int $userId): void
    {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT 1 FROM likes WHERE post_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $postId, $userId);
        $stmt->execute();
        $userHasLiked = $stmt->get_result()->num_rows > 0;
        if ($userHasLiked) {
            $stmt = $db->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $postId, $userId);
            $stmt->execute();
        } else {
            $stmt = $db->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $postId, $userId);
            $stmt->execute();
        }
    }
}