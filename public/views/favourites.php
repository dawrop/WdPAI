<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/0e33b4f811.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/popup.js" defer></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
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
                    <div class="dimness" id="bookInfo<?= $book->getId() ?>" onclick="hideBook('bookInfo<?= $book->getId() ?>')">
                        <div class="bookInfo" >
                            <div class="bookImg">
                                <img src="public/img/uploads/<?= $book->getImage() ?>">
                            </div>
                            <form class="bookContent" action="removeBookFromFav" method="post">
                                <input name="remove" type="hidden" value="<?= $book->getId() ?>">
                                <a>Title: <?= $book->getTitle() ?></a>
                                <a>Description: <?= $book->getDescription() ?></a>
                                <a>Genre: <?= $book->getGenre() ?></a>
                                <a>Author: <?= $book->getAuthor() ?></a>
                                <button type="submit">Remove from favourites</button>
                            </form>
                        </div>
                    </div>

                    <div class="book" onclick="showBook('bookInfo<?= $book->getId() ?>')">
                        <img src="public/img/uploads/<?= $book->getImage() ?>">
                    </div>
                <?php endforeach; ?>

            </section>
        </main>
    </div>

</body>

<template id="bookTemplate">
    <div>
        <div class="dimness" id="" onclick="">
            <div class="bookInfo" >
                <div class="bookImg">
                    <img src="">
                </div>
                <form class="bookContent">
                    <a class="bookContentTitle">title</a>
                    <a class="bookContentDesc">description</a>
                    <a class="bookContentGenre">genre</a>
                    <a class="bookContentAuthor">author</a>
                    <button type="submit">Add to favourites</button>
                </form>
            </div>
        </div>

        <div class="book" onclick="" >
            <img src="">
        </div>
    </div>
</template>