<?php require_once '../../bootstrap/init.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">
        <?php require_once BASE_PATH . '/panel/layouts/top-nav.php' ?>
        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <?php require_once BASE_PATH . '/panel/layouts/sidebar.php' ?>
                </section>
                <section class="col-md-10 pb-3">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $mimeTypes = ['jpg', 'jpeg', 'png', 'gif'];
                        $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                        if (in_array($imageMime, $mimeTypes)) {
                            $image =  '/images/' . md5(microtime()) . '.' . $imageMime;
                            $imagePath = BASE_PATH .  '/assets' . $image;
                            $imageMove = move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

                            if ($imageMove) {
                                $sql = "INSERT INTO posts SET title=?,body=?,cat_id=?,image=?";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([$_POST['title'], $_POST['body'], $_POST['cat_id'], $image]);
                            }
                        }
                        redirect('panel/post');
                    }
                    ?>
                    <form action="create.php" method="post" enctype="multipart/form-data">
                        <section class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="title ...">
                        </section>
                        <section class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </section>
                        <section class="form-group">
                            <label for="cat_id">Category</label>
                            <?php
                            // select category selected
                            global $pdo;
                            $sql = "SELECT * FROM categories";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $categories = $stmt->fetchAll(); ?>
                            <select class="form-control" name="cat_id">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </section>
                        <section class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="5" placeholder="body ..."></textarea>
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </section>
                    </form>

                </section>
            </section>
        </section>

    </section>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
</body>

</html>