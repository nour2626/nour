<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Level HTML Template by Tooplate</title>
<!--

Tooplate 2095 Level

https://www.tooplate.com/view/2095-level

-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/tooplate-style.css">                                   <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
</head>

    <body>
        <div class="tm-main-content" id="top">
            <div class="tm-top-bar-bg"></div>
            <div class="tm-top-bar" id="tm-top-bar">
                <!-- Top Navbar -->
                <div class="container">
                    <div class="row">
                        
                        <nav class="navbar navbar-expand-lg narbar-light">
                            <a class="navbar-brand mr-auto" href="#">
                                les echos
                            </a>
                            <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                                <ul class="navbar-nav ml-auto">
                                  <li class="nav-item">
                                    <a class="nav-link" href="#top">Home <span class="sr-only">(current)</span></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-4">categories</a>
                                  </li>
                                  <li class="nav-item"> <a class="nav-link" href="http://localhost/projetweb2025/View/frontoffice/view_sites.php">sites</a></li>

                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-5">Blog Entries</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-6">Contact Us</a>
                                  </li>
                                </ul>
                            </div>                            
                        </nav>            
                    </div>
                </div>
            </div>














            
            <?php
// Include the database configuration and models
include_once 'C:/xampp/htdocs/projetweb2025/Model/sites.php';
include_once 'C:/xampp/htdocs/projetweb2025/Controller/sitesController.php';
include_once 'C:/xampp/htdocs/projetweb2025/Controller/reviewsController.php';

$categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

$sitesController = new SitesController();
if ($categoryId) {
    $sitesList = $sitesController->getSitesByCategory($categoryId);
} else {
    $sitesList = $sitesController->getAllSites();
}

$reviewsController = new ReviewsController();
$errors = [];

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addComment'])) {
    $siteId = intval($_POST['site_id']);
    $contenu = trim($_POST['contenu']);

    if (empty($contenu)) {
        $errors[$siteId] = "Comment cannot be empty!";
    } else {
        $reviewsController->addReview($contenu, $siteId);
    }
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <?php
            if (!empty($sitesList)) {
                foreach ($sitesList as $site) {
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="/projetweb2025/uploads/<?php echo htmlspecialchars($site['images']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($site['nom_site']); ?>" width="100%">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($site['nom_site']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($site['description_site']); ?></p>
                                <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($site['nom_categorie']); ?></p>

                                <!-- Comment Section -->
                                <form method="POST" action="">
                                    <input type="hidden" name="site_id" value="<?php echo $site['id']; ?>">
                                    <div class="form-group">
                                        <textarea name="contenu" class="form-control" rows="2" placeholder="Write your comment..."></textarea>
                                    </div>
                                    <?php if (isset($errors[$site['id']])): ?>
                                        <p class="text-danger"><?php echo $errors[$site['id']]; ?></p>
                                    <?php endif; ?>
                                    <button type="submit" name="addComment" class="btn btn-primary btn-sm">Add Comment</button>
                                    <a href="viewcomments.php?site_id=<?php echo $site['id']; ?>" class="btn btn-info btn-sm">View Comments</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No sites found for this category.</p>";
            }
            ?>
        </div>
    </div>
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">bonjouuuuuuuuurr</span>
        </div>
    </footer>
</div>
<!-- main-panel ends -->
<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="../../assets/js/off-canvas.js"></script>
<script src="../../assets/js/template.js"></script>
<script src="../../assets/js/settings.js"></script>
<script src="../../assets/js/hoverable-collapse.js"></script>
<script src="../../assets/js/todolist.js"></script>
</body>
</html>
