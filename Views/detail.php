<?php 
    $loggedIn = false;
    if (isset($_SESSION['user_id'])) {
        $loggedIn = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Snapload | Mountain Lake</title>
    <link rel="icon" type="image/x-icon" href="../Public/Images/logo_small.svg">
    <link rel="stylesheet" href="../Public/Styles/detail.css">
</head>
<body>
<header class="<?php echo ($loggedIn) ? 'logged_header' : ''; ?>">
    <div id="logo">
        <img src="Public/Images/logo.svg" alt="logo">
    </div>
    <?php if ($loggedIn): ?>
        <div id="actions_main">
            <a id="upload_btn" href="">Upload</a>
            <a id="my_posts_btn" href="">My posts</a>
        </div>
    <?php endif; ?>
    <div id="search_form">
        <form>
            <input placeholder="Search.." id="search_input" type="text">
            <button id="search_button" type="submit"><img alt="search_icon" src="Public/Images/search.svg"></button>
        </form>
    </div>
    <?php if ($loggedIn): ?>
        <div id="actions_secondary">
            <a id="edit_user__btn" href="" title="Edit user"><img alt="edit_user_icon" src="../Public/Images/edit_user_icon.svg"></a>
            <a id="all_users_btn" href="" title="All users"><img alt="all_users_icon" src="../Public/Images/all_users_icon.svg"></a>
            <a id="log_out_btn" href="" title="Log-out"><img alt="log_out_icon" src="../Public/Images/log_out_icon.svg"></a>
        </div>
    <?php endif; ?>
    <div id="user_card">
        <?php if ($loggedIn): ?>
            <img alt="profile_picture" src="../Public/Images/Uploads/<?php echo($_SESSION["avatar_guid"] . ".webp") ?>">
            <p><?php echo($_SESSION["username"]) ?></p>
        <?php else: ?>
            <a href="/log_in" id="log_in">Log-in</a>
        <?php endif; ?>
    </div>
</header>
<main>
    <img src="../Public/Images/detail_placeholder.jpg">
    <div id="menu">
        <div id="user">
            <img src="../Public/Images/profile_picture_placeholder.jpg">
            <p>John_Wick</p>
        </div>
        <p id="post_title">
            Mountain lake
        </p>
        <button id="like_button"><img alt="like_icon" src="../Public/Images/like_button.svg"></button>
    </div>
</main>
</body>
</html>