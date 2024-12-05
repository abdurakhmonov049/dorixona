
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
    <title>Post o'qish</title>
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

    <!-- Content section-->
    <section class="py-5">
        <div class="container my-5">
            <div class="row">
                <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                $sql = "SELECT * from tblnotice WHERE id=$id";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo htmlspecialchars($result->noticeTitle) ?></h3>
                                    <p class="card-text"><?php echo htmlspecialchars($result->noticeDetails) ?>
                                    </p> Post Yaratildi:
                                    <small style="background-color: #4bd786">  <?php echo htmlspecialchars($result->postingDate) ?></small>
                                    <a href="index.php" class="btn btn-success m-lg-2">Orqaga qaytish</a>
                                </div>
                    <?php }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
