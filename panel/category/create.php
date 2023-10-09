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
                    global $pdo;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (!empty($_POST['name'])) {
                            $sql = "INSERT INTO categories SET name=?";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$_POST['name']]);
                            if ($stmt->rowCount() == 1) {
                                redirect('panel/category');
                            }
                        } else {
                            $failMsg = "category name cannot be empty";
                        }
                    }
                    ?>
                    <form action="create.php" method="post">
                        <section class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name ...">
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </section>

                    </form>
                    <?php if (isset($failMsg)) echo "<div class='alert alert-danger'>$failMsg</div>" ?>
                </section>
            </section>
        </section>

    </section>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
</body>

</html>