<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Snapload | Upload</title>
    <link rel="icon" type="image/x-icon" href="../Public/Images/logo_small.svg">
    <link rel="stylesheet" href="../Public/Styles/Shared/form.css">
</head>
<body>
<header>
    <img src="../Public/Images/logo.svg" alt="logo" id="logo">
</header>

<div class="wrapper">
    <main>
        <form action="/upload" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($post->getId(),ENT_QUOTES); ?>">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($post->getUserId(),ENT_QUOTES); ?>">
            <p id="title">Upload</p>
            <section id="inputs">
                <section class="any_input">
                    <label for="post_name_input">Post name</label>
                    <input name="name" placeholder="Enter name of the post" id="post_name_input" type="text">
                </section>
                <section class="file_input">
                    <label for="file_upload">
                        <span id="tag">Picture</span>
                        <span class="uploaded_file">Click to select file</span>
                    </label>
                    <input name="picture" id="file_upload" type="file" hidden>
                </section>
            </section>
            <section id="buttons">
                <button class="main_button" type="submit">Submit</button>
                <p>snapl<img alt="logo" src="../Public/Images/logo_small.svg">ad</p>
            </section>
        </form>
    </main>
</div>

</body>
</html>