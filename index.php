<?php
error_reporting(0);
require_once 'includes/config.php';
require_once 'functions/func.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pharmacy Online</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Pharmacy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link active" href="admin-login.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php $sql = "SELECT * from tblimageadd";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $result) { ?>
            <!-- Header - set the background image for the header in the line below-->
            <header class="py-5 bg-image-full"
                style="background-image: url('<?php echo htmlspecialchars($result->header_image) ?>')">
            </header>
        <?php }
    }
    ?>
    <!-- Content section-->
    <section class="py-5">
        <div class="container my-5">
            <div class="row">
                <?php $sql = "SELECT * from tblnotice";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                        <div class="col-lg-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($result->noticeTitle) ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars(shortText($result->noticeDetails, 20)) ?>
                                    </p>
                                    <small><?php echo htmlspecialchars($result->postingDate) ?></small>
                                    <a href="view.php?id=<?= $result->id ?>" class="btn btn-primary m-3">To'liq ma'lumot</a>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white"> Pharmacy Online website</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>