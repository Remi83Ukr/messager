<?php
require 'log.php';
require 'path.php';

if (isset($_SESSION['id']) && isset($_SESSION['guest_id'])) {
    $queryPost = selectAll('posts', ['user_id' => $_SESSION['guest_id']]);
    $queryUsers = selectUsers('customers', ['id' => $_SESSION['id']]);
} else {
    $queryPost = selectAll('posts', ['user_id' => $_SESSION['id']]);
    $queryUsers = selectUsers('customers', ['id' => $_SESSION['id']]);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/css/main.css">
    <title>Login</title>
</head>
<body>

<div class="wrapper">
    <div class="caption-wrapper">
        <div class="logo">
            <?php if (isset($_SESSION['id'])): ?>
            <img class="active_face"
                 id="faces"
                 data-id="<?=$_SESSION['id']; ?>"
                 src="images/faces/<?=$_SESSION['login']; ?>.png"
                 alt="faces">
            <span><?php echo "Hello " . $_SESSION['login'] . " !"; ?></span>
            <a class="view_posts" href="view.php?guest_id=<?=$_SESSION['id']; ?>">view posts</a>
        </div>
        <div class="buttons">
            <a href="" id="create" class="primary">Create post</a>
            <a href="<?php echo BASE_URL . 'logout.php'; ?>" class="secondary">Logout</a>
        </div>
        <?php endif; ?>
    </div>
    <div class="wrapper-customers">
        <div class="customers">
            <h3>Customers list</h3>
            <?php if ($queryUsers): ?>
                <?php foreach ($queryUsers as $key => $value): ?>
                    <div class="users_item">
                        <img class="faces"
                             id="faces"
                             data-id="<?=$value['id']; ?>"
                             src="images/faces/<?=$value['login']; ?>.png"
                             alt="faces">
                        <p class="content"><?=$value['login']; ?></p>
                        <a class="view_posts" href="view.php?guest_id=<?=$value['id']; ?>">view posts</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="posts">
            <?php if ($queryPost): ?>
                <?php foreach ($queryPost as $key => $value): ?>
                <div class="post_item">
                    <h3 class="caption"><?=$value['caption']; ?></h3>
                    <p class="content"><?=$value['content']; ?></p>
                    <?php if (($_SESSION['id'] - $_SESSION['guest_id']) === 0) : ?>
                        <div class="btn">
                            <a href="#" id="edit"
                               data-id="<?=$value['id']; ?>"
                               class="edit">edit</a>
                            <a href="delete.php?del_id=<?=$value['id']; ?>"
                               id="delete"
                               data-id="<?=$value['id']; ?>"
                               class="delete">delete</a>
                        </div>
                    <?php else: ?>
                        <div class="btn">
                            <a href="#" id="edit"
                               data-id="<?=$value['id']; ?>" disabled="true"
                               class="edit disabled">edit</a>
                            <a href="delete.php?del_id=<?=$value['id']; ?>"
                               id="delete" data-id="<?=$value['id']; ?>" disabled="true"
                               class="delete disabled">delete</a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="info">
            <h3>Info</h3>
            <p>This is an educational version of the blog. It was created using the PHP programming language and the MySQL database. On the front side, the jQuery library and Ajax requests were used. The software environment was docker.</p>
        </div>
    </div>
</div>

<div id="post_popup" class="post_popup" style="display: none">
    <form id="form" action="public.php" method="post">
        <input type="text" id="post_id" name="post_id" style="display: none">
        <label for="caption" class="label">Caption</label>
        <input type="text" name="caption" id="caption" placeholder="Create caption" required>
        <label for="content" class="label">Content</label>
        <textarea name="content" id="content" cols="30" rows="30"></textarea>
        <div id="notice" class="notice hide"></div>
        <div class="buttons">
            <button id="submit_form" type="submit" class="primary">Create</button>
            <button class="secondary" id="close">Close</button>
    </form>
        </div>
</div>
<br type="_moz">


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="./js/jquery.popupoverlay.js"></script>
<script src="./js/post.js"></script>
</body>
</html>