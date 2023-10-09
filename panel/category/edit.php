<?php require_once '../../bootstrap/init.php' ?>
<?php
if (!isset($_GET['id'])) {
    redirect('/panel/category');
}
?>
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
                    // select category selected
                    global $pdo;
                    $sql = "SELECT * FROM categories WHERE id=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$_GET['id']]);
                    $category = $stmt->fetch();
                    ?>
                    <?php
                    //update category
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $sql = "UPDATE categories SET name=? WHERE id=?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$_POST['name'],$_GET['id']]);
                        redirect('/panel/category');
                    }
                    ?>
                    <form action="" method="post">
                        <section class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $category->name; ?>">
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
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