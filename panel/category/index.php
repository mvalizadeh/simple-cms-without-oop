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

                    <section class="mb-2 d-flex justify-content-between align-items-center">
                        <h2 class="h4">Categories</h2>
                        <a href="create.php" class="btn btn-sm btn-success">Create</a>
                    </section>

                    <section class="table-responsive">
                        <table class="table table-striped table-">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                global $pdo;
                                $sql = "SELECT * FROM categories";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                $categories = $stmt->fetchAll();

                                foreach ($categories as $category) :
                                ?>
                                    <tr>
                                        <td><?= $category->id; ?></td>
                                        <td><?= $category->name; ?></td>
                                        <td>
                                            <a href="<?= url('/panel/category/edit.php?id=' . $category->id) ?>" class="btn btn-info btn-sm">Edit</a>
                                            <a href="<?= url('/panel/category/delete.php?id=' . $category->id) ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </section>


                </section>
            </section>
        </section>





    </section>

    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>