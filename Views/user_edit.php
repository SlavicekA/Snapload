<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Snapload | Sign-up</title>
    <link rel="icon" type="image/x-icon" href="../Public/Images/logo_small.svg">
    <link rel="stylesheet" href="../Public/Styles/Shared/form.css">
</head>
<body>
<header>
    <img src="../Public/Images/logo.svg" alt="logo" id="logo">
</header>

<div class="wrapper">
    <main>
        <form action="/user_edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user->getId(),ENT_QUOTES); ?>">
            <p id="title">Sign-up</p>
            <section id="inputs">
                <section class="any_input">
                    <label for="email_input">E-mail</label>
                    <input name="email" placeholder="Enter your email..." id="email_input" type="email" value="<?php echo htmlspecialchars($user->getEmail(),ENT_QUOTES); ?>">
                </section>
                <section class="any_input">
                    <label for="username_input">Username</label>
                    <input name="username" placeholder="Enter your username" id="username_input" type="text" value="<?php echo htmlspecialchars($user->getUsername(),ENT_QUOTES); ?>">
                </section>
                <section class="any_input">
                    <label for="password_input">Password</label>
                    <input name="password" placeholder="Enter your password" id="password_input" type="password">
                </section>
                <section class="file_input">
                    <label for="file_upload">
                        <span id="tag">Profile picture</span>
                        <span class="uploaded_file">Click to select file</span>
                    </label>
                    <input name="profile_picture" id="file_upload" type="file" hidden>
                </section>
            </section>
            <section id="buttons">
                <button class="main_button" type="submit">Submit</button>
                <p><a href="/log_in">Log-in </a>to snapl<img alt="logo" src="../Public/Images/logo_small.svg">ad</p>
            </section>
        </form>
    </main>
</div>

</body>
</html>