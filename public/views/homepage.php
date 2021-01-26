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
            <section class="content">
                <?php foreach ($books as $book): ?>
                        <div class="book">
                            <img src="public/img/uploads/<?= $book->getImage() ?>">
                        </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>

    <div class="popupWindow" id="showBook">
        <div class="">

        </div>
    </div>

</body>