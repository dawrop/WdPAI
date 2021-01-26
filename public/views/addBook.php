<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/0e33b4f811.js" crossorigin="anonymous"></script>
    <title>Xbook</title>
</head>

<body>
<div class="base-container">
    <?php require 'navigation.php';?>

    <main>
        <header>
            <div class="logo-homepage">
                <img src="public/img/logo.svg">
            </div>
        </header>
        <section class="book-form">
            <h1>Upload</h1>
            <form action="addBook" method="post" ENCTYPE="multipart/form-data">
                <?php if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
                <input name="title" type="text" placeholder="Title">
                <textarea name="description" rows="5" placeholder="Description"></textarea>
                <input name="genre" type="text" placeholder="Genre">
                <input name="author" type="text" placeholder="Author">
                <input type="file" name="file">
                <button type="submit">Send</button>
            </form>
        </section>
    </main>
</div>
</body>