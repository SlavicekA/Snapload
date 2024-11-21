<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Snapload | Sign-up</title>
    <link rel="icon" type="image/x-icon" href="../Common/Images/logo_small.svg">
    <link rel="stylesheet" href="../Common/Styles/Shared/form.css">
</head>
<body>
<header>
    <img src="../Common/Images/logo.svg" alt="logo" id="logo">
</header>

<div class="wrapper">
    <main>
        <form>
            <p id="title">Upload</p>
            <section id="inputs">
                <section class="any_input">
                    <label for="post_name_input">Post name</label>
                    <input placeholder="Enter name of the post" id="post_name_input" type="text">
                </section>
                <section class="file_input">
                    <label for="file_upload">
                        <span id="tag">Picture</span>
                        <span class="uploaded_file">Click to select file</span>
                    </label>
                    <input id="file_upload" type="file" hidden>
                </section>
            </section>
            <section id="buttons">
                <button class="main_button" type="submit">Submit</button>
                <p>snapl<img alt="logo" src="../Common/Images/logo_small.svg">ad</p>
            </section>
        </form>
    </main>
</div>

</body>
</html>