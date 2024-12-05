<?php
error_reporting(0);
require_once 'includes/config.php';
require_once 'functions/func.php';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullName'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $message = $_POST['msg'];
    $sql = "INSERT INTO contacts(fullName, email, phone_number, message) VALUES(:fullName, :email, :phone_number, :message)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':fullName', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':message', $message);
    if ($stmt->execute()) {
        echo "<script>alert('Your message has been sent');</script>";
        echo "<script>window.location.href ='contact.php'</script>";

    } else {
        echo "<script>alert('Something went wrong');</script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Contact</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
</head>

<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Pharmacy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page"
                                        href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link active" href="admin-login.php">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>


</header>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 100%; max-width: 360px;">
        <h4 class="text-center mb-3">Contact Us</h4>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name" required
                       name="fullName">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required
                       name="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter your phone number" required
                       name="phone_number">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="3" placeholder="Enter your message" required
                          name="msg"></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="submit">Send Message</button>
            </div>
        </form>
    </div>
</div>


<!-- footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white"> Pharmacy Online website </p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>

</html>