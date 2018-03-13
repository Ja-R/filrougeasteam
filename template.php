<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?= $title ?> </title>
    <link rel="stylesheet" type="text/css" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/css/fontawesome-all.css">

</head>

<body>
    <nav>
        <a href='index.html' class="backSuperlab">
            <i class="fas fa-arrow-left"></i>
            superLab.be
        </a>
        <!-- <h1>Bienvenue visiteur</h1> -->
        <div class="header-nav-dash">
            <!-- a varier -->
            <a href="blogadmin.php" class="dashboard-btn">Dashboard</a>
            <div class="header__btn-login">

                <i class="far fa-lg fa-user-circle"></i>
            </div>
        </div>
    </nav>
    <header>
        <h1 class="header__title">superBlog</h1>
    </header>
    <main>

        <?= $content ?>

    <footer>
        <p>now get the fuck out of here.</p>
    </footer>

    <script src="assets/js/blog.js"></script>
</body>

</html>
