<?php

namespace App\Models;

use App\Config\Database;

class Like {
    private $db;

    public function getLikes($postId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $likeCount = $result->fetch_assoc();
        return $likeCount['like_count'];
    }

    public function addLike($postId, $userId) {
        $stmt = $this->db->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE id=id");
        $stmt->bind_param("ii", $postId, $userId);
        $stmt->execute();
    }

    public function removeLike($postId, $userId) {
        $stmt = $this->db->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $postId, $userId);
        $stmt->execute();
    }
}