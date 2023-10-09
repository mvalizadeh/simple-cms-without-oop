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

            <section class="row">
                <section class="col-12">
                    <h1>name</h1>
                    <hr>
                </section>
            </section>
            <section class="row">
                <?php
                // select posts from selected category
                global $pdo;
                $sql = "SELECT * FROM posts WHERE cat_id=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_GET['id']]);
                $posts = $stmt->fetchAll();
                ?>
                <?php foreach ($posts as $post) : ?>
                    <section class="col-md-4">
                        <section class="mb-2 overflow-hidden" style="max-height: 15rem;"><img class="img-fluid" src="<?= asset($post->image) ?>" alt=""></section>
                        <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                        <p><?= substr($post->body, 0, 20) ?></p>
                        <p><a class="btn btn-primary" href="<?= url('/detail.php?id=' . $post->id) ?>" role="button">View details »</a></p>
                    </section>
                <?php endforeach; ?>
            </section>

            <section class="row">
                <section class="col-12">
                    <h1>Category not found</h1>
                </section>
            </section>

        </section>
    </section>

    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>