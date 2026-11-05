<?php
class LikeRepository
{
    public static function getLikesByPostId(int $postId): Like
    {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT COUNT(*) AS total_likes,
            EXISTS (SELECT 1 FROM likes WHERE post_id = ? AND user_id = ?) AS user_has_liked 
            FROM likes WHERE post_id = ?");
        $stmt->bind_param("iii", $postId, $userId, $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return new Like($row['total_likes'], $row['user_has_liked']);
    }

    public static function toggleLike(int $postId, int $userId): void
    {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT EXISTS (SELECT 1 FROM likes WHERE post_id = ? AND user_id = ?) AS user_has_liked FROM likes WHERE post_id = ?");
        $stmt->bind_param("iii", $postId, $userId, $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $userHasLiked = $row['user_has_liked'];
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