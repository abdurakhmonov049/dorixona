<?php
session_start();
error_reporting(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'includes/config.php';

// Agar foydalanuvchi tizimga kirmagan bo‘lsa, uni login sahifasiga yo‘naltirish
if (strlen($_SESSION['alogin']) == "") {
      header("Location: index.php");
      exit;
}

if (isset($_POST['submit'])) {
      // Fayl yuklanganini tekshirish
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Fayl haqida ma'lumotlar
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Ruxsat etilgan kengaytmalarni tekshirish
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($fileExtension, $allowedExtensions)) {
                  echo '<script>alert("Faqat JPG, JPEG, PNG va GIF fayllar ruxsat etilgan.")</script>';
                  echo "<script>window.location.href ='add-header-image.php'</script>";
                  exit;
            }

            // Faylni yuklash uchun papka
            $uploadFolder = "uploads/";
            if (!is_dir($uploadFolder)) {
                  mkdir($uploadFolder, 0777, true); // Papkani yaratish
            }

            // Fayl nomini unikallashtirish (hash + vaqt)
            $newFileName = hash('md5', time() . $fileName) . '.' . $fileExtension;
            $destinationPath = $uploadFolder . $newFileName;

            
            // Faylni papkaga ko‘chirish
            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                  // Fayl muvaffaqiyatli yuklandi
                  $fileUrl = $destinationPath; // Faylning nisbiy yo‘li

                  // Ma'lumotlar bazasiga saqlash
                  $sql = "INSERT INTO tblimageadd (header_image) VALUES (:header_image)";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':header_image', $fileUrl, PDO::PARAM_STR);

                  if ($query->execute()) {
                        echo '<script>alert("Image added successfully!")</script>';
                        echo "<script>window.location.href ='add-header-image.php'</script>";
                  } else {
                        echo '<script>alert("Something went wrong while saving to the database.")</script>';
                  }
            } else {
                  echo '<script>alert("Something went wrong while uploading the file.")</script>';
            }
      } else {
            echo '<script>alert("Please select a valid file.")</script>';
      }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Image qo'shish</title>
      <link rel="stylesheet" href="css/bootstrap.css" media="screen">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
      <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
      <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
      <link rel="stylesheet" href="css/prism/prism.css" media="screen"> <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
      <link rel="stylesheet" href="css/main.css" media="screen">
      <script src="js/modernizr/modernizr.min.js"></script>
      <style>
            .errorWrap {
                  padding: 10px;
                  margin: 0 0 20px 0;
                  background: #fff;
                  border-left: 4px solid #dd3d36;
                  -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                  padding: 10px;
                  margin: 0 0 20px 0;
                  background: #fff;
                  border-left: 4px solid #5cb85c;
                  -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
      </style>
</head>

<body class="top-navbar-fixed">
      <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php require_once 'includes/topbar.php'; ?>

            <div class="content-wrapper">
                  <div class="content-container">


                        <?php require_once 'includes/leftbar.php'; ?>


                        <div class="main-page">
                              <div class="container-fluid">
                                    <div class="row page-title-div">
                                          <div class="col-md-6">
                                                <h2 class="title">Header Image</h2>
                                          </div>

                                    </div>

                                    <div class="row breadcrumb-div">
                                          <div class="col-md-6">
                                                <ul class="breadcrumb">
                                                      <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a>
                                                      </li>
                                                      <li><a href="add-header-image.php">header-image</a></li>
                                                      <li class="active">Add image</li>
                                                </ul>
                                          </div>

                                    </div>

                              </div>


                              <section class="section">
                                    <div class="container-fluid">

                                          <div class="row">
                                                <div class="col-md-8 col-md-offset-2">
                                                      <div class="panel">
                                                            <div class="panel-heading">
                                                                  <div class="panel-title">
                                                                        <h5>Image add</h5>
                                                                  </div>
                                                            </div>

                                                            <div class="panel-body">
                                                                  <form method="post" action="add-header-image.php"
                                                                        enctype="multipart/form-data">
                                                                        <div class="form-group has-success">
                                                                              <label for="success"
                                                                                    class="control-label">Bosh rasm
                                                                                    qo'shish</label>
                                                                              <div>
                                                                                    <input type="file" name="image"
                                                                                          class="form-control"
                                                                                          required="required">
                                                                              </div>
                                                                        </div>

                                                                        <div class="form-group has-success">
                                                                              <div>
                                                                                    <button type="submit" name="submit"
                                                                                          class="btn btn-success btn-labeled">Submit<span
                                                                                                class="btn-label btn-label-right"><i
                                                                                                      class="fa fa-check"></i></span></button>
                                                                              </div>
                                                                        </div>

                                                                  </form>


                                                            </div>
                                                      </div>
                                                </div>
                                                <!-- /.col-md-8 col-md-offset-2 -->
                                          </div>
                                          <!-- /.row -->




                                    </div>
                                    <!-- /.container-fluid -->
                              </section>
                              <!-- /.section -->

                        </div>
                        <!-- /.main-page -->

                  </div>
                  <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

      </div>
      <!-- /.main-wrapper -->

      <!-- ========== COMMON JS FILES ========== -->
      <script src="js/jquery/jquery-2.2.4.min.js"></script>
      <script src="js/jquery-ui/jquery-ui.min.js"></script>
      <script src="js/bootstrap/bootstrap.min.js"></script>
      <script src="js/pace/pace.min.js"></script>
      <script src="js/lobipanel/lobipanel.min.js"></script>
      <script src="js/iscroll/iscroll.js"></script>

      <!-- ========== PAGE JS FILES ========== -->
      <script src="js/prism/prism.js"></script>

      <!-- ========== THEME JS ========== -->
      <script src="js/main.js"></script>



      <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>