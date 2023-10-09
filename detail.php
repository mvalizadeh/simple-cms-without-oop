<?php

require_once 'bootstrap/init.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= asset('/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('/css/style.css') ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">

        <?php require_once "layouts/top-nav.php" ?>

        <section class="container my-5">
            <!-- Example row of columns -->
            <section class="row">
                <?php
                global $pdo;
                $sql = "SELECT * FROM posts WHERE id =?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_GET['id']]);
                $post = $stmt->fetch();
                if ($stmt->rowCount() < 1) {
                    echo "<section>post not found!</section>";
                    exit;
                }
                ?>
                <section class="col-md-12">
                    <h1>title</h1>
                    <h5 class="d-flex justify-content-between align-items-center">
                        <a href=""><?= $post->title ?></a>
                        <span class="date-time"><?= $post->created_at ?></span>
                    </h5>
                    <article class="bg-article p-3">
                        <img class="float-right mb-2 ml-2" style="width: 18rem;" src="<?= asset($post->image) ?>" alt="">
                        <?= $post->body ?>
                    </article>



                </section>
            </section>
        </section>

    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>