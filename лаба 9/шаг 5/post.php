<?php

require '../autoload.php';

use App\Models\Like;
use App\Middleware\Auth;


$likeModel = new Like();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action === 'like') {
        $likeModel->addLike($postId, $userId);
    } elseif ($action === 'unlike') {
        $likeModel->removeLike($postId, $userId);
    }
}

// Получение количества лайков для поста
$likeCount = $likeModel->getLikes($postId);


// Вывод поста, количества лайков и форм для взаимодействия
echo "<h1>Пост #$postId</h1>";
echo "<p>Количество лайков: $likeCount</p>";

?>

<form method="POST">
    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
    <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
    <button type="submit" name="action" value="like">Лайк</button>
    <button type="submit" name="action" value="unlike">Снять лайк</button>
</form>
</post>
