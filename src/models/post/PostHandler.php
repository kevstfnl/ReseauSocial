<?php
class PostHandler extends Database
{
    public static function create(Post $post)
    {
        $userId = $post->getAuthorId();
        $message = $post->getMessage();
        $query = "INSERT INTO posts (user_id, message) VALUES (:user_id, :message)";
        self::request($query, [":user_id" => $userId, ":message" => $message]);
    }
    public static function delete($messageId)
    {
        self::request("DELETE FROM posts WHERE id = :id", [":id" => $messageId]);
    }
    public static function update($messageId, $message)
    {
        self::request("UPDATE posts SET message = :message WHERE id = :id", ["message" => $message, "id" => $messageId]);
    }
    public static function getRecentUserPost($userId)
    {
        return self::request(
            "SELECT 
                posts.id AS post_id, posts.message, posts.created_at,
                COUNT(CASE WHEN reviews.positive = 1 THEN 1 END) AS likes_count,
                COUNT(CASE WHEN reviews.positive = 0 THEN 1 END) AS dislikes_count,
                (COUNT(CASE WHEN reviews.positive = 1 THEN 1 END) - COUNT(CASE WHEN reviews.positive = 0 THEN 1 END)) AS review_score
            FROM posts LEFT JOIN reviews ON posts.id = reviews.post_id WHERE posts.user_id = :userId GROUP BY posts.id
            ORDER BY posts.created_at DESC LIMIT 10", ["userId" => $userId]
        )->fetchAll();
    }
    public static function getPopularUserPost($userId)
    {
        return self::request(
            "SELECT posts.* WHERE user_id = :userId, 
                (COUNT(CASE WHEN reviews.positive = 1 THEN 1 END) - COUNT(CASE WHEN reviews.positive = 0 THEN 1 END)) AS score
            FROM posts LEFT JOIN reviews ON posts.id = reviews.post_id
            GROUP BY posts.id ORDER BY score DESC LIMIT 10", ["userId" => $userId]
        )->fetchAll();
    }
    public static function getRecentPost()
    {
        return self::request(
            "SELECT 
                posts.id AS post_id, posts.message, posts.created_at,
                users.first_name AS user_first_name, users.last_name AS user_last_name,
                COUNT(CASE WHEN reviews.positive = 1 THEN 1 END) AS likes_count,
                COUNT(CASE WHEN reviews.positive = 0 THEN 1 END) AS dislikes_count,
                (COUNT(CASE WHEN reviews.positive = 1 THEN 1 END) - COUNT(CASE WHEN reviews.positive = 0 THEN 1 END)) AS review_score
            FROM posts LEFT JOIN reviews ON posts.id = reviews.post_id
            LEFT JOIN users ON posts.user_id = users.id
            GROUP BY posts.id ORDER BY posts.created_at DESC LIMIT 10"
        )->fetchAll();
    }

    public static function getReview(int $userId, int $postId) {
        return self::request("SELECT * FROM reviews WHERE user_id = :userId AND post_id = :postId", [":userId" => $userId, ":postId" => $postId]);
    }
}
